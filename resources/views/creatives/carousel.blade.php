<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <title>{{ $creative->creative_type->name }}</title>
    <style>
        .header {
            background-color: #e63946;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .gradient_bg {
            min-height: 100vh;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .carousel1 {
            position: relative;
            margin: 0 auto;
            perspective: 800px;
            transform: translateY(-50%);
        }

        .carousel1-content {
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transform: translateZ(-182px) rotateY(0);
            animation: carousel1 10s infinite cubic-bezier(1, 0.015, 0.295, 1.225) forwards;
        }

        .carousel1-item {
            position: absolute;
            border-radius: 6px;
        }

        .carousel1-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .carousel1-item:nth-child(1) {
            transform: rotateY(0deg) translateZ(182px);
        }

        .carousel1-item:nth-child(2) {
            transform: rotateY(120deg) translateZ(182px);
        }

        .carousel1-item:nth-child(3) {
            transform: rotateY(240deg) translateZ(182px);
        }

        @keyframes carousel1 {

            0%,
            17.5% {
                transform: translateZ(-182px) rotateY(0);
            }

            27.5%,
            45% {
                transform: translateZ(-182px) rotateY(-120deg);
            }

            55%,
            72.5% {
                transform: translateZ(-182px) rotateY(-240deg);
            }

            82.5%,
            100% {
                transform: translateZ(-182px) rotateY(-360deg);
            }
        }
    </style>
</head>

<body>
    @php
        $images = json_decode($creative->image, true);
        $countImages = count($images);
    @endphp
    <div class="gradient_bg w-full">
        <div class="w-full">
            <div id="remove3" class="header bg-[#2D3A43]">Create creative with AI</div>

            <div class="flex flex-col items-center">
                <div class="min-h-[420px]">
                    <div class="container p-4 rounded ">
                        <div id="remove4" class="text-center mb-5">
                            <h2 class="text-3xl font-bold text-white">Generated Ads {{ $creative->creative_type->name }}
                            </h2>
                        </div>
                        <div class="mt-4 flex justify-content-center flex-column items-center">
                            <div class="carousel1 w-80">
                                <div class="carousel1-content p-5">
                                    @foreach ($images as $image)
                                        <div class="carousel1-item flex justify-center">
                                            <img class="creativeImage" src="{{ asset('uploads/' . $image) }}"
                                                alt="Creative Image" style="height: 300px; width: 250px;">
                                            <a href="{{ $creative->landing_url }}" target="_blank"
                                                class="rounded-md px-4 border-[#3276ceb2] text-white py-1 mt-2  bg-blue-500 text-sm hover:scale-105 transition ease-in-out duration-150 absolute bottom-5">
                                                {{ $creative->cta_name ?? 'Click' }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="remove" class="flex flex-col items-start text-white mt-2">
                        <div class="checkbox-group">
                            <h3>Select Dimensions:</h3>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="1" /> 250x300
                            </label><br>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="2" /> 320x480
                            </label><br>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="3" /> 300x300
                            </label><br>
                            <label class="cursor-pointer">
                                <input type="checkbox" name="options" value="4" /> 250x250
                            </label>
                        </div>

                        <div id="remove2" class="mt-4 d-flex justify-content-center">
                            <button class="bg-blue-600 text-white px-7 py-1.5 text-md rounded-lg"
                                id="download-btn">Download as HTML</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById("download-btn").addEventListener("click", function() {
            const selectedOptions = document.querySelectorAll('input[name="options"]:checked');

            if (selectedOptions.length === 0) {
                alert("Please select at least one dimension.");
                return;
            }

            const zip = new JSZip();

            selectedOptions.forEach((option) => {
                const selectedValue = option.value;
                let dimensions = {};

                switch (selectedValue) {
                    case "1":
                        dimensions = {
                            width: "300px",
                            height: "250px"
                        };
                        break;
                    case "2":
                        dimensions = {
                            width: "480px",
                            height: "320px"
                        };
                        break;
                    case "3":
                        dimensions = {
                            width: "300px",
                            height: "300px"
                        };
                        break;
                    case "4":
                        dimensions = {
                            width: "250px",
                            height: "250px"
                        };
                        break;
                }

                // Clone the current HTML structure
                let pageContent = document.documentElement.outerHTML;

                // Update dimensions for images
                pageContent = pageContent.replace(
                    /(<img[^>]*class="creativeImage"[^>]*style=")([^"]*)(")/g,
                    (match, p1, p2, p3) => {
                        return `${p1}height: ${dimensions.height}; width: ${dimensions.width}; object-fit: cover;${p3}`;
                    }
                );

                // Remove elements with specific IDs
                ["remove", "remove2", "remove3", "remove4"].forEach((id) => {
                    const regex = new RegExp(`<div id="${id}".*?>.*?<\\/div>`, "gs");
                    pageContent = pageContent.replace(regex, "");
                });

                // Generate a unique filename based on the dimension
                const fileName = `index_${dimensions.width}x${dimensions.height}.html`;
                zip.file(fileName, pageContent);
            });

            // Generate the ZIP file and trigger download
            zip.generateAsync({
                type: "blob"
            }).then(function(content) {
                saveAs(content, "creative_dimensions.zip");
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

</body>

</html>
