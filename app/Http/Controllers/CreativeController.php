<?php

namespace App\Http\Controllers;

use Log;
use ZipArchive;
use App\Models\Creative;
use App\Models\CreativeType;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
    
class CreativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): mixed
    {
        // $creatives = Creative::where('user_id', Auth::id())->with('creative_type')->orderByDesc('id')->paginate(10);
        //$creatives = Creative::with('creative_type')->orderByDesc('id')->paginate(10);
        $creatives = Creative::where('user_id', Auth::id())->with('creative_type')->orderByDesc('id')->paginate(10);
        // dd($creatives);
        return view("creatives_test.list", compact('creatives'));
    }

    // Update the create method with the same five modifiers
    public function create(Request $request)
    {
        $creative_types = CreativeType::all();
        $imageUrls = [];
        $failedStyles = [];

        if ($request->has('question')) {
            $question = $request->input('question');
            $baseUrl = 'https://image.pollinations.ai/prompt/';

            // Alternative fallback API if needed
            $fallbackUrl = 'https://ai.shabox.mobi/ai/imagegenerate';

            // Updated with five style modifiers
            $modifiers = ['realistic art', 'digital painting', 'abstract style', 'watercolor painting', 'oil painting'];

            foreach ($modifiers as $modifier) {
                $modifiedQuestion = $question . ', ' . $modifier; // Append modifier to prompt
                $encodedPrompt = urlencode($modifiedQuestion);
                $fullUrl = $baseUrl . $encodedPrompt;

                $success = false;
                $retryCount = 0;
                $maxRetries = 3;

                // Retry logic
                while (!$success && $retryCount < $maxRetries) {
                    try {
                        $response = Http::timeout(60)->get($fullUrl);

                        if ($response->successful()) {
                            $imageData = $response->body();

                            if ($imageData) {
                                $fileName = 'generated_image_' . str_replace(' ', '_', $modifier) . '_' . time() . '.png';
                                $filePath = public_path('images/' . $fileName);

                                File::ensureDirectoryExists(public_path('images'));
                                file_put_contents($filePath, $imageData);

                                $imageUrls[] = [
                                    'url' => asset('images/' . $fileName),
                                    'style' => ucfirst($modifier)
                                ];

                                $success = true;
                            }
                        } else {
                            // If it's a server error (5xx), retry
                            if ($response->status() >= 500) {
                                $retryCount++;
                                // Wait a bit before retrying (exponential backoff)
                                sleep(pow(2, $retryCount));
                                Log::warning("Retry attempt $retryCount for style: $modifier. API returned status: " . $response->status());
                            } else {
                                // Client error (4xx), don't retry
                                throw new \Exception('API returned client error: ' . $response->status());
                            }
                        }
                    } catch (\Exception $e) {
                        $retryCount++;
                        Log::error("Error generating image for style '$modifier': " . $e->getMessage());

                        // If all retries failed, try the fallback API
                        if ($retryCount >= $maxRetries) {
                            try {
                                // Attempt to use fallback API
                                $fallbackResponse = Http::timeout(60)->get($fallbackUrl, ['question' => $modifiedQuestion]);

                                if ($fallbackResponse->successful()) {
                                    // The fallback API might return base64, check the response format
                                    $base64Image = $fallbackResponse->body();
                                    $imageData = base64_decode($base64Image);

                                    if ($imageData) {
                                        $fileName = 'fallback_image_' . str_replace(' ', '_', $modifier) . '_' . time() . '.png';
                                        $filePath = public_path('images/' . $fileName);

                                        File::ensureDirectoryExists(public_path('images'));
                                        file_put_contents($filePath, $imageData);

                                        $imageUrls[] = [
                                            'url' => asset('images/' . $fileName),
                                            'style' => ucfirst($modifier) . ' (Fallback)'
                                        ];

                                        $success = true;
                                    }
                                } else {
                                    throw new \Exception('Fallback API also failed: ' . $fallbackResponse->status());
                                }
                            } catch (\Exception $fallbackException) {
                                Log::error("Fallback API also failed for style '$modifier': " . $fallbackException->getMessage());
                                $failedStyles[] = $modifier;
                                break; // Exit the retry loop
                            }
                        }
                    }
                }

                // If all attempts failed for this style
                if (!$success) {
                    $failedStyles[] = $modifier;
                }
            }
        }

        return view('creatives_test.index', [
            'imageUrls' => $imageUrls,
            'question' => $request->input('question', ''),
            'creative_types' => $creative_types,
            'failedStyles' => $failedStyles
        ]);
    }

    public function generateAiImages(Request $request)
    {
        $question = $request->input('question');
        $imageUrls = [];
        $failedStyles = [];

        if (!$question) {
            return response()->json(['error' => 'No prompt provided'], 400);
        }

        $baseUrl = 'https://image.pollinations.ai/prompt/';

        // Alternative fallback API if needed
        $fallbackUrl = 'https://ai.shabox.mobi/ai/imagegenerate';

        // Updated with five style modifiers
        $modifiers = ['realistic art', 'digital painting', 'abstract style', 'watercolor painting', 'oil painting'];

        foreach ($modifiers as $modifier) {
            $modifiedQuestion = $question . ', ' . $modifier; // Append modifier to prompt
            $encodedPrompt = urlencode($modifiedQuestion);
            $fullUrl = $baseUrl . $encodedPrompt;

            $success = false;
            $retryCount = 0;
            $maxRetries = 3;

            // Retry logic
            while (!$success && $retryCount < $maxRetries) {
                try {
                    $response = Http::timeout(60)->get($fullUrl);

                    if ($response->successful()) {
                        $imageData = $response->body();

                        if ($imageData) {
                            $fileName = str_replace(' ', '_', $modifier) . '_' . time() . '.png';
                            $filePath = public_path('images/' . $fileName);

                            File::ensureDirectoryExists(public_path('images'));
                            file_put_contents($filePath, $imageData);

                            $imageUrls[] = [
                                'url' => asset('images/' . $fileName),
                                'style' => ucfirst($modifier)
                            ];

                            $success = true;
                        }
                    } else {
                        // If it's a server error (5xx), retry
                        if ($response->status() >= 500) {
                            $retryCount++;
                            // Wait a bit before retrying (exponential backoff)
                            sleep(pow(2, $retryCount));
                            Log::warning("Retry attempt $retryCount for style: $modifier. API returned status: " . $response->status());
                        } else {
                            // Client error (4xx), don't retry
                            throw new \Exception('API returned client error: ' . $response->status());
                        }
                    }
                } catch (\Exception $e) {
                    $retryCount++;
                    Log::error("Error generating image for style '$modifier': " . $e->getMessage());

                    // If all retries failed, try the fallback API
                    if ($retryCount >= $maxRetries) {
                        try {
                            // Attempt to use fallback API
                            $fallbackResponse = Http::timeout(60)->get($fallbackUrl, ['question' => $modifiedQuestion]);

                            if ($fallbackResponse->successful()) {
                                // The fallback API might return base64, check the response format
                                $base64Image = $fallbackResponse->body();
                                $imageData = base64_decode($base64Image);

                                if ($imageData) {
                                    $fileName = 'fallback_image_' . str_replace(' ', '_', $modifier) . '_' . time() . '.png';
                                    $filePath = public_path('images/' . $fileName);

                                    File::ensureDirectoryExists(public_path('images'));
                                    file_put_contents($filePath, $imageData);

                                    $imageUrls[] = [
                                        'url' => asset('images/' . $fileName),
                                        'style' => ucfirst($modifier) . ' (Fallback)'
                                    ];

                                    $success = true;
                                }
                            } else {
                                throw new \Exception('Fallback API also failed: ' . $fallbackResponse->status());
                            }
                        } catch (\Exception $fallbackException) {
                            Log::error("Fallback API also failed for style '$modifier': " . $fallbackException->getMessage());
                            $failedStyles[] = $modifier;
                            break; // Exit the retry loop
                        }
                    }
                }
            }

            // If all attempts failed for this style
            if (!$success) {
                $failedStyles[] = $modifier;
            }
        }

        // If all styles failed
        if (empty($imageUrls)) {
            return response()->json([
                'error' => 'All image generation attempts failed',
                'failedStyles' => $failedStyles
            ], 500);
        }

        // Return successful images, plus info about any failed ones
        $response = ['images' => $imageUrls];
        if (!empty($failedStyles)) {
            $response['failedStyles'] = $failedStyles;
            $response['warning'] = 'Some image styles failed to generate';
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        // This method remains unchanged
        Validator::make($request->all(), [
            'content' => 'nullable|max:50',
            'cta_url' => 'required',
            'creative_type_id' => 'required',
            'image.*' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:51200',
            'video.*' => 'nullable|mimes:mp4,mov,avi,wmv|max:102400',
            'creative_name' => 'required|max:50',
            'ctaButton' => 'required|in:click,buy_now,play,watch',
            'generated_image' => 'nullable',
            'prompt' => 'nullable|string',
            'selected_images_json' => 'nullable|string',
        ]);

        $filePaths = [];
        $videoFilePaths = [];

        // Handle uploaded image files
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $key => $file) {
                $imageName = strtotime('now') . $key . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $imageName);
                $filePaths[] = $imageName;
            }
        }

        // Handle selected AI-generated images
        if ($request->has('selected_images_json') && !empty($request->selected_images_json)) {
            try {
                $selectedImages = json_decode($request->selected_images_json, true);

                if (is_array($selectedImages)) {
                    foreach ($selectedImages as $index => $selectedImage) {
                        try {
                            // Parse the URL to get the filename
                            $urlPath = parse_url($selectedImage['url'], PHP_URL_PATH);
                            $fileName = basename($urlPath);

                            // Determine the source path
                            $sourcePath = public_path('images/' . $fileName);

                            if (File::exists($sourcePath)) {
                                // Create a new filename for the copied version
                                $newFileName = 'ai_' . time() . '_' . $index . '_' . rand(1000, 9999) . '.png';
                                $destPath = public_path('uploads/' . $newFileName);

                                // Ensure the uploads directory exists
                                File::ensureDirectoryExists(public_path('uploads'));

                                // Copy the file
                                if (File::copy($sourcePath, $destPath)) {
                                    $filePaths[] = $newFileName;
                                    Log::info('Successfully copied AI image: ' . $newFileName);
                                } else {
                                    Log::error('Failed to copy AI image from ' . $sourcePath . ' to ' . $destPath);
                                }
                            } else {
                                Log::error('Source AI image not found at: ' . $sourcePath);
                            }
                        } catch (\Exception $e) {
                            Log::error('Exception processing selected image: ' . $e->getMessage());
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error processing selected images JSON: ' . $e->getMessage());
            }
        }

        // Handle uploaded video files
        if ($request->hasFile('video')) {
            foreach ($request->file('video') as $key => $file) {
                $videoName = strtotime('now') . $key . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $videoName);
                $videoFilePaths[] = $videoName;
            }
        }

        // Create and save the creative
        $creative = new Creative;
        $creative->user_id = Auth::id();
        $creative->creative_type_id = $request->creative_type_id;
        $creative->content = $request->content;
        $creative->landing_url = $request->landing_url ?? $request->cta_url;
        $creative->tracking_url = $request->tracking_url;
        $creative->image = $filePaths ? json_encode($filePaths) : null;
        $creative->video = $videoFilePaths ? json_encode($videoFilePaths) : null;
        $creative->creative_name = $request->creative_name;
        $creative->cta_name = $request->ctaButton;
        dd($creative);
        $creative->save();

        return redirect()->route('creative.index')->with('success', 'Creative created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $creative = Creative::findOrFail($id);
        return view('creatives_test.edit', compact('creative'));
    }

    public function show($id) {
        $creative = Creative::with('creative_type')->find($id);
        // dd($creative->creative_type_id);
        // $creative = CreativeType::with('creatives')->find($id);
        // dd($creative->creative_type->id);
        if ($creative->creative_type_id == 1 ) {
            // dd($creative);
            return view('creatives.carousel', compact('creative'));
        } elseif ($creative->creative_type_id == 2) {
            // dd($creative);
            return view('creatives.scratch', compact('creative'));
        } elseif ($creative->creative_type_id == 3) {
            // dd($creative);
            return view('creatives.videoCanvas', compact('creative'));
        } elseif ($creative->creative_type_id == 4) {
            // dd($creative);
            return view('creatives.videoWithImageCarousel', compact('creative'));
        } elseif ($creative->creative_type_id == 5) {
            // dd($creative);
            return view('creatives.videoWithImageSlider', compact('creative'));
        } elseif ($creative->creative_type_id == 6) {
            // dd($creative);
            return view('creatives.interactiveImageSlider', compact('creative'));
        } elseif ($creative->creative_type_id == 7) {
            // dd($creative);
            return view('creatives.imageHoverAnimation', compact('creative'));
        } elseif ($creative->creative_type_id == 8) {
            return view('creatives.cricketGamification', compact('creative'));
        } elseif ($creative->creative_type_id == 9) {
            return view('creatives.footballGamification', compact('creative'));
        } elseif ($creative->creative_type_id == 10) {
            return view('creatives.scratchToReveal', compact('creative'));
        } elseif ($creative->creative_type_id == 11) {
            return view('creatives.3DRotatingCube', compact('creative'));
        } elseif ($creative->creative_type_id == 12) {
            return view('creatives.NewExpandableImage', compact('creative'));
        } elseif ($creative->creative_type_id == 13) {
            return view('creatives.countDown', compact('creative'));
        } elseif ($creative->creative_type_id == 14) {
            return view('creatives.scratchToRevealVideo', compact('creative'));
        } elseif ($creative->creative_type_id == 15) {
            return view('creatives.videoImageExpandOnHover', compact('creative'));
        } elseif ($creative->creative_type_id == 16) {
            return view('creatives.productSlider', compact('creative'));
        } elseif ($creative->creative_type_id == 17) {
            return view('creatives.locationBasedAds', compact('creative'));
        } elseif ($creative->creative_type_id == 18) {
            return view('creatives.responsive3DRotatingCube', compact('creative'));
        } elseif ($creative->creative_type_id == 19) {
            return view('creatives.storiesAds', compact('creative'));
        } elseif ($creative->creative_type_id == 20) {
            return view('creatives.creativeSwiper', compact('creative'));
        } elseif ($creative->creative_type_id == 21) {
            return view('creatives.creativeImageAnimation', compact('creative'));
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $creative = Creative::findOrFail($id);
            // Delete the associated files
            if ($creative->main_asset) {
                $mainAssets = json_decode($creative->main_asset, true);
                foreach ($mainAssets as $asset) {
                    File::delete(public_path('storage/' . $asset));
                }
            }
            if ($creative->logo_asset) {
                File::delete(public_path('storage/' . $creative->logo_asset));
            }
            if ($creative->cta_asset) {
                File::delete(public_path('storage/' . $creative->cta_asset));
            }

            // Delete the creative
            $creative->delete();

            DB::commit();
            return redirect()->route('creative.index')->with('success', 'Creative deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('creative.index')->with('error', 'An error occurred while deleting the creative.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'width' => 'required|integer',
            'height' => 'required|integer',
            'main_asset.*' => 'nullable|file|mimes:jpg,png,svg,webp',
            'logo_asset' => 'nullable|file|mimes:jpg,png,svg,webp',
            'cta_asset' => 'nullable|file|mimes:jpg,png,svg,webp',
        ]);
        try {
            DB::beginTransaction();

            $creative = Creative::findOrFail($id);
            $creative->width = $request->width;
            $creative->height = $request->height;
            // Handle file uploads
            if ($request->hasFile('main_asset')) {
                $filePaths = [];
                foreach ($request->file('main_asset') as $file) {
                    // Store each file and get its storage path
                    $path = $file->store('uploads', 'public');
                    $filePaths[] = $path; // Save the path to the array
                }
                $creative->main_asset = json_encode($filePaths);
            }

            if ($request->hasFile('logo_asset')) {
                $creative->logo_asset = $request->file('logo_asset')->store('uploads', 'public');
            }

            if ($request->hasFile('cta_asset')) {
                $creative->cta_asset = $request->file('cta_asset')->store('uploads', 'public');
            }

            $creative->save();
            DB::commit();
            return redirect()->back()->with('success', 'Ad updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the creative.');
        }
    }
}
