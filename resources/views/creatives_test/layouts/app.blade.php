<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- for logo icon --}}
    <link rel="icon" href="{{ asset('img/icon.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.es5.min.js"></script>
    <title>@yield('title', 'Toucan Creative')</title>

    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        .loader {
            width: 80px;
            aspect-ratio: 1;
            border: 15px solid #ddd;
            border-radius: 50%;
            position: relative;
            transform: rotate(45deg);
        }

        .loader::before {
            content: "";
            position: absolute;
            inset: -15px;
            border-radius: 50%;
            border: 15px solid #1E90FF;
            animation: l18 5s forwards linear;
        }

        @keyframes l18 {
            0% {
                clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0)
            }

            25% {
                clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0)
            }

            50% {
                clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%)
            }

            75% {
                clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%)
            }

            100% {
                clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0)
            }
        }




        .dashboard {
            width: 100%;
            min-height: 100vh;
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .scroll-container {
            height: fit-content;
            overflow: scroll;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .nav {
            width: 100%;
            background: #2D3A43;
            margin: auto;
        }

        .contain {
            max-width: 1200px;
            margin: auto;
        }

        .chat_box {
            color: #fff;
            padding: 10px 15px;
        }

        .gradient_bg {
            background: rgb(11, 34, 64);
            background: radial-gradient(circle, rgba(11, 34, 64, 1) 0%, rgba(9, 14, 22, 1) 65%);
        }

        .gradient_border {
            position: relative;
            padding: 10px 45px;
            background: white;
            border-radius: 25px;
            z-index: 1;
        }

        .gradient_border::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 25px;
            padding: 2px;
            background: linear-gradient(45deg, #0d2c56, #4b525c, #0d2c56, #4b525c);
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: -1;
        }

        .upload-box input[type="file"] {
            outline: none;
        }

        .row-wrapper {
            display: flex;
            align-items: center;
            padding: 5px 15px;
            border: 2px solid transparent;
            border-image: linear-gradient(45deg, #0d2c56, #4b525c, #0d2c56, #4b525c) 1;
        }

        table th,
        table td {
            text-align: left;
        }

        @media (0px < width < 720px) {
            .contain {
                padding: 0rem 0.5rem;
            }
        }


        ::-webkit-scrollbar {}

        ::-webkit-scrollbar-track {
            background: #eee;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        #fontSizeInput::placeholder {
            color: white;
            opacity: 1;
        }

        .wrapper {
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

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

        .main {
            background-color: #eee;
            width: 100%;
            position: relative;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        }

        .scroll {
            overflow-y: auto;
            scroll-behavior: smooth;
            height: 600px;
            padding: 10px;
        }

        .msg {
            width: 100%;
            background-color: #fff;
            font-size: 16px;
            padding: 4px;
            border-radius: 5px;
            font-weight: 500;
            color: #3e3c3c;
            margin-bottom: 10px;
        }

        .remove-btn {
            color: red;
            margin-left: 10px;
        }


        .checkbox-wrapper-13 input[type=checkbox] {
            --active: #275EFE;
            --active-inner: #fff;
            --focus: 2px rgba(39, 94, 254, .3);
            --border: #BBC1E1;
            --border-hover: #275EFE;
            --background: #fff;
            --disabled: #F6F8FF;
            --disabled-inner: #E1E6F9;
            -webkit-appearance: none;
            -moz-appearance: none;
            height: 21px;
            outline: none;
            display: inline-block;
            vertical-align: top;
            position: relative;
            margin: 0;
            cursor: pointer;
            border: 1px solid var(--bc, var(--border));
            background: var(--b, var(--background));
            transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
        }

        .checkbox-wrapper-13 input[type=checkbox]:after {
            content: "";
            display: block;
            left: 0;
            top: 0;
            position: absolute;
            transition: transform var(--d-t, 0.3s) var(--d-t-e, ease), opacity var(--d-o, 0.2s);
        }

        .checkbox-wrapper-13 input[type=checkbox]:checked {
            --b: var(--active);
            --bc: var(--active);
            --d-o: .3s;
            --d-t: .6s;
            --d-t-e: cubic-bezier(.2, .85, .32, 1.2);
        }

        .checkbox-wrapper-13 input[type=checkbox]:disabled {
            --b: var(--disabled);
            cursor: not-allowed;
            opacity: 0.9;
        }

        .checkbox-wrapper-13 input[type=checkbox]:disabled:checked {
            --b: var(--disabled-inner);
            --bc: var(--border);
        }

        .checkbox-wrapper-13 input[type=checkbox]:disabled+label {
            cursor: not-allowed;
        }

        .checkbox-wrapper-13 input[type=checkbox]:hover:not(:checked):not(:disabled) {
            --bc: var(--border-hover);
        }

        .checkbox-wrapper-13 input[type=checkbox]:focus {
            box-shadow: 0 0 0 var(--focus);
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch) {
            width: 21px;
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):after {
            opacity: var(--o, 0);
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):checked {
            --o: 1;
        }

        .checkbox-wrapper-13 input[type=checkbox]+label {
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
            margin-left: 4px;
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch) {
            border-radius: 7px;
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):after {
            width: 5px;
            height: 9px;
            border: 2px solid var(--active-inner);
            border-top: 0;
            border-left: 0;
            left: 7px;
            top: 4px;
            transform: rotate(var(--r, 20deg));
        }

        .checkbox-wrapper-13 input[type=checkbox]:not(.switch):checked {
            --r: 43deg;
        }

        .checkbox-wrapper-13 * {
            box-sizing: inherit;
        }

        .checkbox-wrapper-13 *:before,
        .checkbox-wrapper-13 *:after {
            box-sizing: inherit;
        }





        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .main {
                width: 100%;
                max-width: 100%;
            }

            .scroll {
                max-height: 300px;
            }

            .form-control {
                width: 75%;
            }

            .icon2 {
                font-size: 20px;
            }
        }

        @media (max-width: 576px) {
            .form-control {
                width: 70%;
            }

            .icon2 {
                font-size: 18px;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/browser-image-compression@1.0.13/dist/browser-image-compression.js"></script>
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @livewireStyles
</head>

<body>

    @yield('content')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".d-flex").style.opacity = "1";
        });
    </script>

    <script>
        let selectedValue = null;

        $(document).ready(function() {
            $('#assetTypeDropdown').change(function() {
                selectedValue = $(this).val();
                console.log(selectedValue);

                $('#selectedTemplate').show();
                $('#selectedTemplate').text(`You have selected the template`);

                // $('#selectedTemplate').text("You have selected a template");
            })
            $('#image').change(function() {
                var imageValue = $(this).val();
            });


            const savedPrompt = sessionStorage.getItem('Prompt');
            if (savedPrompt !== null) {
                document.getElementById('question').value = savedPrompt;
            }
        });

        // My Vanila JS
        let inputText = true;
        const fileInput = document.getElementById('image');
        const fileInput2 = document.getElementById('video');
        const fileList = document.getElementById('file-list');
        const fileList2 = document.getElementById('file-list2');
        const inputTextSection = document.getElementById('inputTextSection');
        const scrollContainer = document.getElementById('scroll-container');
        const contentText = document.getElementById('contentText')

        document.addEventListener("DOMContentLoaded", function() {
            let urlParams = new URLSearchParams(window.location.search);

            if (urlParams.has('question')) {
                document.querySelector('#selectTemplateContainer').classList.add('d-none');
                document.querySelector('#promtBoxContainer').classList.remove('d-none');
                document.querySelector('#userSelectedCommand').classList.remove('d-none');
                document.querySelector('#dynamicTextOnUserSelectedCommand').innerText =
                    "Please Generate Image with our AI"
                document.querySelector('#promtBox').classList.remove('d-none')

                let newUrl = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
                document.querySelector('#submitPrompt').innerText = 'Regenerate'
            }
        });

        //If user want to select Template
        document.querySelector('#userChoseSelectTemplate').addEventListener('click', () => {
            document.querySelector('#selectTemplateContainer').classList.remove('d-none');
            document.querySelector('#promtBoxContainer').classList.add('d-none');
            document.querySelector('#selectTemplate').classList.remove('d-none');
            document.querySelector('#userSelectedCommand').classList.remove('d-none');
            document.querySelector('#dynamicTextOnUserSelectedCommand').innerText = "Please Select Your Template"
        })

        //If user want to generate image with AI
        document.querySelector('#userChoseGenerateImage').addEventListener('click', () => {
            document.querySelector('#selectTemplateContainer').classList.add('d-none');
            document.querySelector('#promtBoxContainer').classList.remove('d-none');
            document.querySelector('#userSelectedCommand').classList.remove('d-none');
            document.querySelector('#dynamicTextOnUserSelectedCommand').innerText =
                "Please Generate Image with our AI"
            document.querySelector('#promtBox').classList.remove('d-none')
        })

        // Remove Image from UI
        function removeImage(imageId) {
            let imageDiv = document.getElementById(imageId);
            if (imageDiv) {
                imageDiv.remove();
            }
        }

        //Submit the Promt
        document.querySelector('#submitPrompt').addEventListener('click', () => {
            const prompt = document.getElementById('question').value;
            sessionStorage.setItem('Prompt', prompt);

            if (document.querySelector('#generatedImage')) {
                document.querySelector('#generatedImage').classList.add('d-none');
            }

            document.querySelector('#imageLoading').classList.remove('d-none');

            setTimeout(() => {
                loadingMSG.innerText = "Generating."
            }, 100)
            setTimeout(() => {
                loadingMSG.innerText = "Generating.."
            }, 2000)
            setTimeout(() => {
                loadingMSG.innerText = "Generating..."
            }, 3000)
            setTimeout(() => {
                loadingMSG.innerText = "Processing"
            }, 5000)
            setTimeout(() => {
                loadingMSG.innerText = "Processing."
            }, 5500)
            setTimeout(() => {
                loadingMSG.innerText = "Processing.."
            }, 6000)
            setTimeout(() => {
                loadingMSG.innerText = "Processing..."
            }, 6500)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait"
            }, 8000)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait."
            }, 8500)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait.."
            }, 9500)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait..."
            }, 10000)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait.."
            }, 11000)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait."
            }, 12000)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait.."
            }, 13000)
            setTimeout(() => {
                loadingMSG.innerText = "Please wait"
            }, 14000)

        })



        // Update the character count
        function updateCharCount() {
            let textarea = document.getElementById("question");
            let submitButton = document.getElementById("submitPrompt");
            let charCount = document.getElementById("charCount");

            let length = textarea.value.length;
            charCount.textContent = `${length} / 30 characters required`;

            // Enable button only if at least 20 characters are entered
            submitButton.disabled = length < 30;
        }

        // for image generated  ..................................
        document.addEventListener('DOMContentLoaded', function() {
            // Array to store all selected images
            let selectedImages = [];

            const generateImageUploadBtn = document.getElementById('userChoseGenerateImageUpload');
            if (generateImageUploadBtn) {
                generateImageUploadBtn.addEventListener('click', function() {
                    document.getElementById('promtBoxContainer2').classList.remove('d-none');
                    document.getElementById('inputSection').classList.add('d-none');
                });
            }

            const submitPromptBtn = document.getElementById('submitPrompt2');
            if (submitPromptBtn) {
                submitPromptBtn.addEventListener('click', function() {
                    const aiImageError = document.querySelector('#aiImageError')
                    aiImageError.classList.add('d-none')
                    const question = document.getElementById('question2').value.trim();

                    if (question.length < 30) {
                        // Improved alert with styling
                        showStyledAlert('Please enter at least 30 characters for better results');
                        return;
                    }

                    document.getElementById('imageLoading2').classList.remove('d-none');
                    document.getElementById('loadingMSG2').innerText = 'Generating...';

                    fetch('/ai/imagegenerate', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                question: question
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('imageLoading2').classList.add('d-none');

                            // Determine which container to use based on selectedValue
                            let targetContainer;
                            if (selectedValue == 22) {
                                targetContainer = document.getElementById('generatedImage3');
                                targetContainer.classList.remove('d-none');
                            } else {
                                targetContainer = document.getElementById('generatedImage2');
                                targetContainer.classList.remove('d-none');
                            }

                            targetContainer.innerHTML = '';

                            // Reset selected images array when new images are generated
                            selectedImages = [];

                            if (data.images && data.images.length) {
                                // Add the prompt to a hidden field
                                addPromptToForm(question);

                                // Hide the next button initially
                                document.getElementById('next_btn').classList.add('d-none');

                                // Display the first generated image in the ImagePreview container
                                if (data.images[0] && document.getElementById('ImagePreview')) {
                                    updatePreviewImage(data.images[0].url);
                                    setupPreviewOverlays();
                                }

                                // Create a grid container for images
                                const gridContainer = document.createElement('div');
                                gridContainer.className =
                                    'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4';
                                targetContainer.appendChild(gridContainer);

                                data.images.forEach((image, index) => {
                                    // Use a different image card creation function for selectedValue 22
                                    const imageCard = selectedValue == 22 || selectedValue ==
                                        23 ?
                                        createImageCardWithDownload(image, index) :
                                        createImageCard(image, index);
                                    gridContainer.appendChild(imageCard);
                                });

                                document.querySelector('#aiImageError').classList.remove('d-none');
                                const aiImageErrorMSG = document.querySelector('#aiImageErrorMsg');

                                console.log(selectedValue);

                                document.querySelector('#submitPrompt2').innerText = 'Regenerate'

                                if (selectedValue == 1) {
                                    aiImageErrorMSG.innerText = "Please select 3 Images*";
                                } else if (selectedValue == 2) {
                                    aiImageErrorMSG.innerText = "Please select 2 Images*";
                                } else if (selectedValue == 3) {
                                    aiImageErrorMSG.innerText = "Please select 1 Video*";
                                } else if (selectedValue == 4) {
                                    aiImageErrorMSG.innerText = "Please select between 3-5 Images*";
                                } else if (selectedValue == 5) {
                                    aiImageErrorMSG.innerText = "Please select between 3-5 Images*";
                                } else if (selectedValue == 6) {
                                    aiImageErrorMSG.innerText = "Please select 2 Images*";
                                } else if (selectedValue == 7) {
                                    aiImageErrorMSG.innerText = "Please select 4 Images*";
                                } else if (selectedValue == 8) {
                                    aiImageErrorMSG.innerText = "Please select 1 Images*";
                                } else if (selectedValue == 9) {
                                    aiImageErrorMSG.innerText = "Please select 1 Image*";
                                } else if (selectedValue == 10) {
                                    aiImageErrorMSG.innerText = "Please select 2 Images*";
                                } else if (selectedValue == 11) {
                                    aiImageErrorMSG.innerText = "Please select 6 Images*";
                                } else if (selectedValue == 12) {
                                    aiImageErrorMSG.innerText = "Please select 5 Image*";
                                } else if (selectedValue == 13) {
                                    aiImageErrorMSG.innerText = "Please select 1 Images*";
                                } else if (selectedValue == 14) {
                                    aiImageErrorMSG.innerText = "Please select 1 Image*";
                                } else if (selectedValue == 15) {
                                    aiImageErrorMSG.innerText = "Please select 1 Image*";
                                } else if (selectedValue == 16) {
                                    aiImageErrorMSG.innerText = "Please select 6 Images*";
                                } else if (selectedValue == 17) {
                                    aiImageErrorMSG.innerText = "Please select 1 Images*";
                                } else if (selectedValue == 18) {
                                    aiImageErrorMSG.innerText = "Please select 6 Images*";
                                } else if (selectedValue == 19) {
                                    aiImageErrorMSG.innerText = "Please select 1 Video*";
                                } else if (selectedValue == 20) {
                                    aiImageErrorMSG.innerText = "Please select 5 Images*";
                                } else if (selectedValue == 21) {
                                    aiImageErrorMSG.innerText = "Please select 4 Images*";
                                } else if (selectedValue == 22) {
                                    aiImageErrorMSG.innerText = "Click download button to save images";
                                    aiImageErrorMSG.style.color = "green";
                                } else {
                                    aiImageErrorMSG.innerText = "";
                                }
                            } else {
                                targetContainer.innerHTML =
                                    '<div class="bg-transparent gradient_border chat_box flex flex-col items-center animate__animated animate__fadeInRight p-4">Failed to generate images. Please try again with a different prompt.</div>';
                            }
                        })
                        .catch(error => {
                            console.error('Error generating images:', error);
                            document.getElementById('imageLoading2').classList.add('d-none');

                            // Determine which container to use based on selectedValue for error message
                            let targetContainer;
                            if (selectedValue == 22) {
                                targetContainer = document.getElementById('generatedImage3');
                                targetContainer.classList.remove('d-none');
                            } else {
                                targetContainer = document.getElementById('generatedImage2');
                                targetContainer.classList.remove('d-none');
                            }

                            targetContainer.innerHTML =
                                '<div class="bg-transparent gradient_border chat_box flex flex-col items-center animate__animated animate__fadeInRight p-4">Error generating images. Please try again.</div>';
                        });
                });
            }

            // Function to create a special image card with download button for selectedValue 22
            function createImageCardWithDownload(image, index) {
                const imageDiv = document.createElement('div');
                imageDiv.className =
                    'bg-transparent gradient_border chat_box flex flex-col items-center animate__animated animate__fadeInRight relative group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-lg';
                imageDiv.dataset.imageIndex = index;
                imageDiv.dataset.imageUrl = image.url;
                imageDiv.dataset.imageStyle = image.style || `Style ${index + 1}`;
                imageDiv.style.animationDelay = `${0.1 * index}s`;

                // Image container with hover effect
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative w-full overflow-hidden';

                const img = document.createElement('img');
                img.src = image.url;
                img.className = 'w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105';
                img.crossOrigin = 'anonymous'; // Add cross-origin attribute for external images
                imgContainer.appendChild(img);

                // Style label
                const styleLabel = document.createElement('div');
                styleLabel.className =
                    'absolute top-2 right-2 bg-blue-500 text-white px-2 py-1 rounded-md text-xs font-semibold opacity-80';
                styleLabel.textContent = image.style || `Style ${index + 1}`;
                imgContainer.appendChild(styleLabel);

                // Card content container
                const cardContent = document.createElement('div');
                cardContent.className = 'w-full p-3';

                // Style name
                const styleName = document.createElement('div');
                styleName.className = 'text-sm font-medium text-gray-700 mb-2';
                styleName.textContent = image.style || `Style ${index + 1}`;
                cardContent.appendChild(styleName);

                // Dimension selection container
                const dimensionContainer = document.createElement('div');
                dimensionContainer.className = 'flex flex-wrap gap-2 mb-3';

                // Use image-specific dimensions if available, otherwise use defaults based on selectedValue
                let dimensions;

                if (image.dimensions && Array.isArray(image.dimensions)) {
                    // Use image-specific dimensions
                    dimensions = image.dimensions;
                } else if (selectedValue == 22) {
                    dimensions = [{
                            size: '600x600',
                            label: '600×600'
                        },
                        {
                            size: '1000x1000',
                            label: '1000×1000'
                        },
                        {
                            size: '1920x1080',
                            label: '1920×1080'
                        }
                    ];
                } else {
                    dimensions = [{
                            size: '728x90',
                            label: '728×90'
                        },
                        {
                            size: '336x280',
                            label: '336×280'
                        },
                        {
                            size: '300x250',
                            label: '300×250'
                        },
                        {
                            size: '300x50',
                            label: '300×50'
                        },
                        {
                            size: '160x600',
                            label: '160×600'
                        },
                        {
                            size: '468x60',
                            label: '468×60'
                        },
                        {
                            size: '320x100',
                            label: '320×100'
                        },
                        {
                            size: '320x50',
                            label: '320×50'
                        },
                        {
                            size: '468x60',
                            label: '468×60'
                        },
                        {
                            size: '320x480',
                            label: '320×480'
                        },
                        {
                            size: '970x90',
                            label: '970×90'
                        },
                        {
                            size: '250x250',
                            label: '250×250'
                        },
                        {
                            size: '200x200',
                            label: '200×200'
                        }
                    ];
                }

                // Create checkbox for each dimension
                dimensions.forEach(dim => {
                    const dimWrapper = document.createElement('div');
                    dimWrapper.className = 'flex items-center';

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = `dim-${index}-${dim.size}`;
                    checkbox.className = 'mr-1 dimension-checkbox';
                    checkbox.dataset.dimension = dim.size;
                    checkbox.dataset.imageIndex = index;

                    // Auto-select ALL checkboxes by default
                    checkbox.checked = true;

                    const label = document.createElement('label');
                    label.htmlFor = `dim-${index}-${dim.size}`;
                    label.className = 'text-xs text-gray-600';
                    label.textContent = dim.label;

                    dimWrapper.appendChild(checkbox);
                    dimWrapper.appendChild(label);
                    dimensionContainer.appendChild(dimWrapper);
                });

                cardContent.appendChild(dimensionContainer);

                // Download button
                const downloadBtn = document.createElement('button');
                downloadBtn.className =
                    'w-full bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-sm font-medium transition-colors duration-300 flex items-center justify-center gap-2';
                downloadBtn.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Download Selected
        `;

                // Add download functionality with multiple approaches for production
                downloadBtn.addEventListener('click', function(e) {
                    // Prevent default behavior
                    e.preventDefault();
                    e.stopPropagation();

                    // Get all checked dimensions
                    const checkedDimensions = Array.from(
                        dimensionContainer.querySelectorAll('input[type="checkbox"]:checked')
                    ).map(checkbox => checkbox.dataset.dimension);

                    if (checkedDimensions.length === 0) {
                        showStyledError('Please select at least one dimension');
                        return false;
                    }

                    // Add animation effect
                    downloadBtn.classList.add('animate__animated', 'animate__pulse');
                    setTimeout(() => {
                        downloadBtn.classList.remove('animate__animated', 'animate__pulse');
                    }, 500);

                    // Queue these images for download
                    checkedDimensions.forEach(dimension => {
                        queueImageForZip(image, dimension);
                    });

                    // Show a success message
                    showStyledSuccess(
                        `Added ${checkedDimensions.length} versions of ${image.style || 'image'} to download queue...`
                    );

                    // Return false to prevent any further propagation
                    return false;
                });

                cardContent.appendChild(downloadBtn);
                imageDiv.appendChild(imgContainer);
                imageDiv.appendChild(cardContent);

                // Add click event to show image in preview
                imgContainer.addEventListener('click', function() {
                    updatePreviewImage(image.url);
                });

                return imageDiv;
            }

            // Load JSZip from CDN if not already loaded
            function loadJSZip() {
                return new Promise((resolve, reject) => {
                    if (window.JSZip) {
                        resolve(window.JSZip);
                        return;
                    }

                    const script = document.createElement('script');
                    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js';
                    script.onload = () => resolve(window.JSZip);
                    script.onerror = () => reject(new Error('Failed to load JSZip'));
                    document.head.appendChild(script);
                });
            }

            // Global queue for images to be downloaded as zip
            const downloadQueue = [];

            // Add image to download queue
            function queueImageForZip(image, dimension) {
                downloadQueue.push({
                    url: image.url,
                    dimension: dimension,
                    filename: getBaseFilename(image, dimension)
                });

                // Update the download button status
                updateZipDownloadButton();
            }

            // Create or update ZIP download button
            function updateZipDownloadButton() {
                let zipButton = document.getElementById('download-all-zip');

                if (!zipButton) {
                    // Create ZIP download button if it doesn't exist
                    zipButton = document.createElement('button');
                    zipButton.id = 'download-all-zip';
                    zipButton.className =
                        'fixed bottom-4 right-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full shadow-lg flex items-center gap-2 z-50 animate__animated animate__fadeInUp';
                    zipButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download All as ZIP (0)
        `;

                    zipButton.addEventListener('click', downloadAllAsZip);
                    document.body.appendChild(zipButton);
                }

                // Update count
                zipButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Download All as ZIP (${downloadQueue.length})
    `;

                // Show/hide button based on queue
                if (downloadQueue.length > 0) {
                    zipButton.classList.remove('hidden');
                } else {
                    zipButton.classList.add('hidden');
                }
            }

            // Function to download all images in queue as a ZIP file
            async function downloadAllAsZip() {
                if (downloadQueue.length === 0) {
                    showStyledError('No images selected for download');
                    return;
                }

                try {
                    showStyledInfo('Preparing ZIP file... Please wait');

                    // Load JSZip if not already loaded
                    const JSZip = await loadJSZip();
                    const zip = new JSZip();

                    // Create a loading indicator
                    const loadingEl = document.createElement('div');
                    loadingEl.className =
                        'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                                loadingEl.innerHTML = `
                            <div class="bg-white p-6 rounded-lg shadow-xl max-w-md text-center">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto mb-4"></div>
                                <h3 class="text-lg font-semibold mb-2">Preparing Download</h3>
                                <p class="text-gray-600 mb-4">Processing <span id="zip-progress">0</span>/${downloadQueue.length} images...</p>
                            </div>
                        `;
                        document.body.appendChild(loadingEl);

                    const progressEl = document.getElementById('zip-progress');
                    let completed = 0;

                    // Process each image in queue
                    const promises = downloadQueue.map(async item => {
                        try {
                            // Fetch the image and resize it
                            const blob = await fetchAndResizeImage(item.url, item.dimension);

                            // Add to zip
                            zip.file(`${item.filename}.png`, blob);

                            // Update progress
                            completed++;
                            if (progressEl) progressEl.textContent = completed;

                            return true;
                        } catch (err) {
                            console.error(`Error processing ${item.filename}:`, err);
                            return false;
                        }
                    });

                    // Wait for all images to be processed
                    await Promise.all(promises);

                    // Generate ZIP file
                    const zipBlob = await zip.generateAsync({
                        type: 'blob',
                        compression: 'DEFLATE',
                        compressionOptions: {
                            level: 6
                        }
                    }, metadata => {
                        if (progressEl) progressEl.textContent =
                            `Compressing (${Math.floor(metadata.percent)}%)`;
                    });

                    // Download the ZIP file
                    const downloadUrl = URL.createObjectURL(zipBlob);
                    const link = document.createElement('a');
                    link.href = downloadUrl;
                    link.download = `images_${new Date().toISOString().slice(0,10)}.zip`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    // Clean up
                    setTimeout(() => URL.revokeObjectURL(downloadUrl), 30000);

                    // Remove loading indicator
                    document.body.removeChild(loadingEl);

                    // Clear the queue after successful download
                    downloadQueue.length = 0;
                    updateZipDownloadButton();

                    showStyledSuccess('ZIP file downloaded successfully!');
                } catch (error) {
                    console.error('Error creating ZIP file:', error);
                    showStyledError('Failed to create ZIP file: ' + error.message);
                }
            }

            // Fetch and resize image
            async function fetchAndResizeImage(url, dimensionStr) {
                return new Promise(async (resolve, reject) => {
                    try {
                        // Fetch the image
                        const response = await fetch(url, {
                            mode: 'cors',
                            credentials: 'same-origin'
                        });
                        const blob = await response.blob();

                        // Parse dimension string
                        const [width, height] = dimensionStr.split('x').map(Number);

                        // Create an image element
                        const img = new Image();
                        img.crossOrigin = 'anonymous';

                        img.onload = () => {
                            // Create canvas for resizing
                            const canvas = document.createElement('canvas');
                            canvas.width = width;
                            canvas.height = height;

                            // Draw and resize image
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0, width, height);

                            // Convert to blob
                            canvas.toBlob(resolve, 'image/png');
                        };

                        img.onerror = () => reject(new Error('Failed to load image'));

                        // Set source to load the image
                        img.src = URL.createObjectURL(blob);
                    } catch (error) {
                        reject(error);
                    }
                });
            }

            // Show styled notifications
            function showStyledSuccess(message) {
                showStyledNotification(message, 'success');
            }

            function showStyledError(message) {
                showStyledNotification(message, 'error');
            }

            function showStyledInfo(message) {
                showStyledNotification(message, 'info');
            }

            function showStyledNotification(message, type = 'info') {
                // Create notification element if it doesn't exist
                let notificationContainer = document.getElementById('notification-container');

                if (!notificationContainer) {
                    notificationContainer = document.createElement('div');
                    notificationContainer.id = 'notification-container';
                    notificationContainer.className = 'fixed top-4 right-4 z-50 flex flex-col gap-2';
                    document.body.appendChild(notificationContainer);
                }

                // Set color based on type
                let bgColor, iconSvg;
                switch (type) {
                    case 'success':
                        bgColor = 'bg-green-500';
                        iconSvg =
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
                        break;
                    case 'error':
                        bgColor = 'bg-red-500';
                        iconSvg =
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
                        break;
                    default:
                        bgColor = 'bg-blue-500';
                        iconSvg =
                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
                }

                // Create notification
                const notification = document.createElement('div');
                notification.className =
                    `${bgColor} text-white p-3 rounded-lg shadow-lg flex items-center gap-2 animate__animated animate__fadeInRight max-w-xs`;
                notification.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            ${iconSvg}
        </svg>
        <span>${message}</span>
    `;

                // Add to container
                notificationContainer.appendChild(notification);

                // Remove after timeout
                setTimeout(() => {
                    notification.classList.replace('animate__fadeInRight', 'animate__fadeOutRight');
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 500);
                }, 3000);
            }

            // Helper function to generate a base filename
            function getBaseFilename(image, dimension) {
                // Extract filename from URL or use a default name with style and dimension
                let styleName = (image.style || 'image').replace(/\s+/g, '-').toLowerCase();
                let baseFilename;

                try {
                    const urlParts = image.url.split('/');
                    baseFilename = urlParts[urlParts.length - 1].split('.')[0];
                } catch (e) {
                    baseFilename = `image-${styleName}`;
                }

                const extension = getExtensionFromUrl(image.url) || 'jpg';
                return `${baseFilename}-${dimension}.${extension}`;
            }

            // Extract file extension from URL
            function getExtensionFromUrl(url) {
                try {
                    const urlParts = url.split('?')[0].split('.');
                    return urlParts[urlParts.length - 1];
                } catch (e) {
                    return 'jpg';
                }
            }

            // Method 1: Server-side approach - Use your backend API if available
            async function downloadImageServerSide(imageUrl, dimension, filename) {
                // Replace with your actual API endpoint
                const apiEndpoint = '/api/download-image';

                try {
                    const response = await fetch(apiEndpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            url: imageUrl,
                            dimension: dimension,
                            filename: filename
                        })
                    });

                    if (!response.ok) {
                        throw new Error('Server download failed');
                    }

                    const blob = await response.blob();
                    saveBlob(blob, filename);
                    return true;
                } catch (error) {
                    console.warn('Server-side download failed, falling back to client-side', error);
                    throw error; // Re-throw to trigger fallback
                }
            }

            // Method 2: Client-side approach for direct image download
            async function downloadImageClientSide(imageUrl, dimension, filename) {
                try {
                    // 1. Try direct download first (works for same-origin or CORS-enabled images)
                    const dimensionUrl = addDimensionToUrl(imageUrl, dimension);
                    const response = await fetch(dimensionUrl, {
                        mode: 'cors',
                        cache: 'no-cache'
                    });

                    if (response.ok) {
                        const blob = await response.blob();
                        saveBlob(blob, filename);
                        return;
                    }

                    throw new Error('Direct download failed');
                } catch (error) {
                    console.warn('Direct download failed, trying alternative method', error);

                    // 2. If direct download fails, try proxy approach if you have one
                    try {
                        const proxyUrl =
                            `/proxy-image?url=${encodeURIComponent(imageUrl)}&dimension=${dimension}`;
                        const proxyResponse = await fetch(proxyUrl);

                        if (proxyResponse.ok) {
                            const blob = await proxyResponse.blob();
                            saveBlob(blob, filename);
                            return;
                        }

                        throw new Error('Proxy download failed');
                    } catch (proxyError) {
                        console.warn('Proxy download failed, trying canvas approach', proxyError);

                        // 3. Last resort: draw to canvas and download (only works for loaded images)
                        try {
                            downloadViaCanvas(imageUrl, dimension, filename);
                        } catch (canvasError) {
                            console.error('All download methods failed', canvasError);
                            showStyledError('Download failed. Please try again later.');
                        }
                    }
                }
            }

            // Method 3: Canvas approach for already loaded images (fallback)
            function downloadViaCanvas(imageUrl, dimension, filename) {
                return new Promise((resolve, reject) => {
                    // Create an image object
                    const img = new Image();
                    img.crossOrigin = 'anonymous';

                    img.onload = function() {
                        // Parse the dimensions
                        const [targetWidth, targetHeight] = dimension.split('x').map(Number);

                        // Create a canvas
                        const canvas = document.createElement('canvas');
                        canvas.width = targetWidth;
                        canvas.height = targetHeight;

                        // Draw the image on the canvas with resizing
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, targetWidth, targetHeight);

                        // Convert to blob and download
                        canvas.toBlob(function(blob) {
                            if (blob) {
                                saveBlob(blob, filename);
                                resolve();
                            } else {
                                reject(new Error('Canvas to Blob conversion failed'));
                            }
                        }, `image/${getExtensionFromUrl(imageUrl)}`, 0.9);
                    };

                    img.onerror = function() {
                        reject(new Error('Image loading failed'));
                    };

                    // Add a cache-busting parameter to avoid caching issues
                    img.src = `${imageUrl}${imageUrl.includes('?') ? '&' : '?'}cache=${Date.now()}`;
                });
            }

            // Helper function to save a blob as a file
            function saveBlob(blob, filename) {
                const blobUrl = URL.createObjectURL(blob);
                const downloadLink = document.createElement('a');
                downloadLink.href = blobUrl;
                downloadLink.download = filename;
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
                setTimeout(() => URL.revokeObjectURL(blobUrl), 100);
            }

            // Helper function to add dimension parameter to URL
            function addDimensionToUrl(url, dimension) {
                const separator = url.includes('?') ? '&' : '?';
                return `${url}${separator}size=${dimension}`;
            }

            // Function to show styled success message
            function showStyledSuccess(message) {
                const toast = document.createElement('div');
                toast.className =
                    'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg animate__animated animate__fadeIn z-50';
                toast.textContent = message;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('animate__fadeIn');
                    toast.classList.add('animate__fadeOut');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 500);
                }, 3000);
            }

            // Function to show styled error message
            function showStyledError(message) {
                const toast = document.createElement('div');
                toast.className =
                    'fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg animate__animated animate__fadeIn z-50';
                toast.textContent = message;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('animate__fadeIn');
                    toast.classList.add('animate__fadeOut');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 500);
                }, 3000);
            }

            // Helper function to add dimension parameter to URL
            function addDimensionToUrl(url, dimension) {
                // In a real implementation, you might have different URLs for different dimensions
                // or use a resizing service. For this example, we'll just add a query parameter.
                const separator = url.includes('?') ? '&' : '?';
                return `${url}${separator}size=${dimension}`;
            }

            // Function to show styled success message
            function showStyledSuccess(message) {
                const toast = document.createElement('div');
                toast.className =
                    'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg animate__animated animate__fadeIn z-50';
                toast.textContent = message;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('animate__fadeIn');
                    toast.classList.add('animate__fadeOut');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 500);
                }, 3000);
            }

            // Function to show styled error message
            function showStyledError(message) {
                const toast = document.createElement('div');
                toast.className =
                    'fixed bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg animate__animated animate__fadeIn z-50';
                toast.textContent = message;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('animate__fadeIn');
                    toast.classList.add('animate__fadeOut');
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 500);
                }, 3000);
            }
            // Show success message function
            function showStyledSuccess(message) {
                // Create a custom alert element
                const alertBox = document.createElement('div');
                alertBox.className =
                    'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg animate__animated animate__fadeIn z-50';
                alertBox.innerHTML = `
                <div class="flex">
                    <div class="py-1 mr-3">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Success</p>
                        <p>${message}</p>
                    </div>
                </div>`;

                document.body.appendChild(alertBox);

                // Remove the alert after 3 seconds
                setTimeout(() => {
                    alertBox.classList.replace('animate__fadeIn', 'animate__fadeOut');
                    setTimeout(() => {
                        alertBox.remove();
                    }, 500);
                }, 3000);
            }

            // Function to create a more beautiful image card (original function for other values)
            function createImageCard(image, index) {
                const imageDiv = document.createElement('div');
                imageDiv.className =
                    'bg-transparent gradient_border chat_box flex flex-col items-center animate__animated animate__fadeInRight relative group overflow-hidden rounded-lg transition-all duration-300 hover:shadow-lg';
                imageDiv.dataset.imageIndex = index;
                imageDiv.dataset.imageUrl = image.url;
                imageDiv.dataset.imageStyle = image.style || `Style ${index + 1}`;
                imageDiv.style.animationDelay = `${0.1 * index}s`;

                // Image container with hover effect
                const imgContainer = document.createElement('div');
                imgContainer.className = 'relative w-full overflow-hidden';

                const img = document.createElement('img');
                img.src = image.url;
                img.className = 'w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105';
                imgContainer.appendChild(img);

                // Style label
                const styleLabel = document.createElement('div');
                styleLabel.className =
                    'absolute top-2 right-2 bg-blue-500 text-white px-2 py-1 rounded-md text-xs font-semibold opacity-80';
                styleLabel.textContent = image.style || `Style ${index + 1}`;
                imgContainer.appendChild(styleLabel);

                // Selection container with improved checkbox design
                const checkboxContainer = document.createElement('div');
                checkboxContainer.className = 'w-full p-3 flex items-center justify-between';

                // Style name in selection area
                const styleName = document.createElement('span');
                styleName.className = 'text-sm font-medium text-gray-700';
                styleName.textContent = image.style || `Style ${index + 1}`;

                // Creating custom checkbox for better styling
                const checkboxWrapper = document.createElement('label');
                checkboxWrapper.className = 'toggle-checkbox flex items-center cursor-pointer';
                checkboxWrapper.htmlFor = `image-checkbox-${index}`;

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.id = `image-checkbox-${index}`;
                checkbox.className = 'sr-only'; // Hide original checkbox

                const customCheckbox = document.createElement('div');
                customCheckbox.className =
                    'toggle-bg w-11 h-6 bg-gray-200 rounded-full p-1 transition-colors duration-300';
                customCheckbox.innerHTML =
                    '<div class="toggle-dot h-4 w-4 bg-white rounded-full shadow-md transform translate-x-0 transition-transform duration-300"></div>';

                const checkboxLabel = document.createElement('span');
                checkboxLabel.className = 'ml-2 text-sm font-medium text-gray-600';
                checkboxLabel.textContent = 'Select';

                checkboxWrapper.appendChild(checkbox);
                checkboxWrapper.appendChild(customCheckbox);
                checkboxWrapper.appendChild(checkboxLabel);

                checkboxContainer.appendChild(styleName);
                checkboxContainer.appendChild(checkboxWrapper);

                imageDiv.appendChild(imgContainer);
                imageDiv.appendChild(checkboxContainer);

                // Click events for selection
                imageDiv.addEventListener('click', function(e) {
                    if (e.target !== checkbox && !checkboxWrapper.contains(e.target)) {
                        checkbox.checked = !checkbox.checked;
                        const event = new Event('change');
                        checkbox.dispatchEvent(event);
                    }
                });

                checkbox.addEventListener('change', function() {
                    const imageData = {
                        index: parseInt(imageDiv.dataset.imageIndex),
                        url: imageDiv.dataset.imageUrl,
                        style: imageDiv.dataset.imageStyle
                    };

                    if (this.checked) {
                        // Apply selected styling
                        imageDiv.classList.add('ring-2', 'ring-blue-500');
                        customCheckbox.classList.add('bg-blue-500');
                        customCheckbox.querySelector('.toggle-dot').classList.add('translate-x-5');
                        checkboxLabel.textContent = 'Selected';
                        checkboxLabel.classList.add('text-blue-500');

                        // Add to selected images
                        if (!selectedImages.some(img => img.url === imageData.url)) {
                            selectedImages.push(imageData);
                        }

                        // Update preview image
                        updatePreviewImage(imageData.url);
                    } else {
                        // Remove selected styling
                        imageDiv.classList.remove('ring-2', 'ring-blue-500');
                        customCheckbox.classList.remove('bg-blue-500');
                        customCheckbox.querySelector('.toggle-dot').classList.remove('translate-x-5');
                        checkboxLabel.textContent = 'Select';
                        checkboxLabel.classList.remove('text-blue-500');

                        // Remove from selected images
                        selectedImages = selectedImages.filter(img => img.url !== imageData.url);

                        // Update preview image if needed
                        const previewImg = document.querySelector('.preview-image-bg');
                        if (previewImg && previewImg.style.backgroundImage.includes(imageData.url) &&
                            selectedImages.length > 0) {
                            updatePreviewImage(selectedImages[0].url);
                        }
                    }

                    // Update form with selected images
                    updateFormWithSelectedImages();

                    const aiImageErrorMSG = document.querySelector('#aiImageErrorMsg')
                    const nextBtn = document.getElementById('next_btn');


                    if (selectedValue == 1) {
                        if (selectedImages.length === 3) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 2) {
                        if (selectedImages.length === 2) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 3) {
                        aiImageErrorMSG.innerText = "Please select 1 Video*";
                    } else if (selectedValue == 4) {
                        if (selectedImages.length >= 3 && selectedImages.length <= 5) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 5) {
                        if (selectedImages.length >= 3 && selectedImages.length <= 5) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 6) {
                        if (selectedImages.length === 2) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 7) {
                        if (selectedImages.length === 4) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 8) {
                        if (selectedImages.length === 1) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 9) {
                        if (selectedImages.length === 1) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 10) {
                        if (selectedImages.length === 2) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 11) {
                        aiImageErrorMSG.innerText = "Please select 6 Images*";
                    } else if (selectedValue == 12) {
                        if (selectedImages.length === 5) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 13) {
                        if (selectedImages.length === 1) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 14) {
                        if (selectedImages.length === 1) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 15) {
                        if (selectedImages.length === 1) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 16) {
                        aiImageErrorMSG.innerText = "Please select 6 Images*";
                    } else if (selectedValue == 17) {
                        if (selectedImages.length === 1) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 18) {
                        aiImageErrorMSG.innerText = "Please select 6 Images*";
                    } else if (selectedValue == 19) {
                        aiImageErrorMSG.innerText = "Please select 1 Video*";
                    } else if (selectedValue == 20) {
                        if (selectedImages.length === 5) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 21) {
                        if (selectedImages.length === 5) {
                            aiImageErrorMSG.style.color = "green";
                            nextBtn.classList.remove('d-none');
                            nextBtn.classList.add('animate__animated', 'animate__fadeIn');
                        } else {
                            nextBtn.classList.add('d-none');
                            aiImageErrorMSG.style.color = "red";
                        }
                    } else if (selectedValue == 22) {
                        // No selection functionality needed for download option
                    } else {
                        aiImageErrorMSG.innerText = "";
                    }

                    // Toggle next button visibility
                    console.log('Selected images:', selectedImages);
                });

                return imageDiv;
            }

            function updatePreviewImage(imageUrl) {
                const imagePreview = document.getElementById('ImagePreview');
                if (!imagePreview) return;

                // Add smooth transition class if not already present
                if (!imagePreview.classList.contains('transition-all')) {
                    imagePreview.classList.add('transition-all', 'duration-500');
                }

                const previewImg = imagePreview.querySelector('.preview-image-bg');
                if (previewImg) {
                    // Add transition to background image changes
                    previewImg.style.transition = 'background-image 0.5s ease-in-out';
                    previewImg.style.backgroundImage = `url(${imageUrl})`;
                } else {
                    // Create a new preview image if it doesn't exist
                    const previewImgBg = document.createElement('div');
                    previewImgBg.className = 'preview-image-bg transition-all duration-500';
                    previewImgBg.style.position = 'absolute';
                    previewImgBg.style.top = '0';
                    previewImgBg.style.left = '0';
                    previewImgBg.style.width = '100%';
                    previewImgBg.style.height = '100%';
                    previewImgBg.style.zIndex = '0';
                    previewImgBg.style.backgroundImage = `url(${imageUrl})`;
                    previewImgBg.style.backgroundSize = 'cover';
                    previewImgBg.style.backgroundPosition = 'center';

                    imagePreview.insertBefore(previewImgBg, imagePreview.firstChild);
                }
            }

            function setupPreviewOverlays() {
                const imagePreview = document.getElementById('ImagePreview');
                if (!imagePreview) return;

                // Ensure draggable elements are above the background with proper styling
                const campaignNameShow = document.getElementById('campaignNameShow');
                const userInputCTA2 = document.getElementById('userInputCTA2');

                if (campaignNameShow) {
                    campaignNameShow.style.position = 'absolute';
                    campaignNameShow.style.zIndex = '10';
                    // Add drag handle and styling
                    addDragHandleTo(campaignNameShow);
                }

                if (userInputCTA2) {
                    userInputCTA2.style.position = 'absolute';
                    userInputCTA2.style.zIndex = '10';
                    // Add drag handle and styling
                    addDragHandleTo(userInputCTA2);
                }
            }

            function addDragHandleTo(element) {
                // Add drag handle icon
                const dragHandle = document.createElement('div');
                dragHandle.className =
                    'drag-handle absolute -top-3 -right-3 bg-blue-500 text-white rounded-full p-1 opacity-0 transition-opacity duration-300 cursor-move';
                dragHandle.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>';
                element.appendChild(dragHandle);

                // Show drag handle on hover
                element.addEventListener('mouseenter', () => {
                    dragHandle.style.opacity = '1';
                });

                element.addEventListener('mouseleave', () => {
                    dragHandle.style.opacity = '0';
                });
            }

            function addPromptToForm(question) {
                const promptHiddenInput = document.createElement('input');
                promptHiddenInput.type = 'hidden';
                promptHiddenInput.name = 'prompt';
                promptHiddenInput.value = question;

                // Find the form and add the prompt input
                const form = document.getElementById('creativeForm');
                if (form) {
                    // Remove any existing prompt input
                    document.querySelectorAll('input[name="prompt"]').forEach(el => el.remove());
                    // Remove any existing selected images inputs
                    document.querySelectorAll('input[name="selected_images[]"]').forEach(el => el.remove());
                    form.appendChild(promptHiddenInput);
                }
            }

            function updateFormWithSelectedImages() {
                const form = document.getElementById('creativeForm');
                if (!form) return;

                // Add the creative_type_id based on selectedValue
                const creativeTypeInput = document.createElement('input');
                creativeTypeInput.type = 'hidden';
                creativeTypeInput.name = 'creative_type_id';
                creativeTypeInput.value = selectedValue; // Assuming selectedValue corresponds to creative_type_id

                // Remove any existing creative_type_id inputs
                form.appendChild(creativeTypeInput);

                // Remove any existing selected images inputs
                document.querySelectorAll('input[name="selected_images[]"]').forEach(el => el.remove());
                document.querySelectorAll('input[name="selected_styles[]"]').forEach(el => el.remove());

                const selectedImagesInput = document.createElement('input');
                selectedImagesInput.type = 'hidden';
                selectedImagesInput.name = 'selected_images_json';
                selectedImagesInput.value = JSON.stringify(selectedImages);
                form.appendChild(selectedImagesInput);

                // Also add individual inputs for compatibility
                selectedImages.forEach((image, idx) => {
                    const imgInput = document.createElement('input');
                    imgInput.type = 'hidden';
                    imgInput.name = 'selected_images[]';
                    imgInput.value = image.url;
                    form.appendChild(imgInput);

                    const styleInput = document.createElement('input');
                    styleInput.type = 'hidden';
                    styleInput.name = 'selected_styles[]';
                    styleInput.value = image.style;
                    form.appendChild(styleInput);

                    // If this is the first selected image, add it as the primary image
                    if (idx === 0) {
                        const primaryImageInput = document.createElement('input');
                        primaryImageInput.type = 'hidden';
                        primaryImageInput.name = 'generated_image';
                        primaryImageInput.value = image.url;

                        const styleNameInput = document.createElement('input');
                        styleNameInput.type = 'hidden';
                        styleNameInput.name = 'selected_style';
                        styleNameInput.value = image.style;

                        // Remove any existing primary image inputs
                        document.querySelectorAll('input[name="generated_image"]').forEach(el => el
                            .remove());
                        document.querySelectorAll('input[name="selected_style"]').forEach(el => el
                            .remove());

                        form.appendChild(primaryImageInput);
                        form.appendChild(styleNameInput);
                    }
                });
            }

            function showStyledAlert(message) {
                // Create a custom alert element
                const alertBox = document.createElement('div');
                alertBox.className =
                    'fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg animate__animated animate__fadeIn z-50';
                alertBox.innerHTML = `
                <div class="flex">
                    <div class="py-1 mr-3">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Alert</p>
                        <p>${message}</p>
                    </div>
                </div>
                `;

                document.body.appendChild(alertBox);

                // Remove the alert after 3 seconds
                setTimeout(() => {
                    alertBox.classList.replace('animate__fadeIn', 'animate__fadeOut');
                    setTimeout(() => {
                        alertBox.remove();
                    }, 500);
                }, 3000);
            }

            // Enhanced draggable functionality with smooth movement
            const makeDraggable = (element, container) => {
                let offsetX = 0;
                let offsetY = 0;
                let isDragging = false;
                let initialX, initialY;

                // Find or create the drag handle
                let dragHandle = element.querySelector('.drag-handle');
                if (!dragHandle) {
                    addDragHandleTo(element);
                    dragHandle = element.querySelector('.drag-handle');
                }

                const startDrag = (event) => {
                    isDragging = true;
                    initialX = element.offsetLeft;
                    initialY = element.offsetTop;
                    offsetX = event.clientX - element.getBoundingClientRect().left;
                    offsetY = event.clientY - element.getBoundingClientRect().top;

                    // Add dragging visual feedback
                    element.classList.add('dragging');
                    element.style.transition = 'none';
                    document.body.style.cursor = 'grabbing';
                    document.body.style.userSelect = 'none';

                    // Increase opacity of drag handle during drag
                    if (dragHandle) {
                        dragHandle.style.opacity = '1';
                    }
                };

                const onDrag = (event) => {
                    if (!isDragging) return;

                    const containerRect = container.getBoundingClientRect();

                    let newLeft = event.clientX - offsetX;
                    let newTop = event.clientY - offsetY;

                    // Constrain to container bounds
                    newLeft = Math.max(0, Math.min(newLeft - containerRect.left, containerRect.width -
                        element.offsetWidth));
                    newTop = Math.max(0, Math.min(newTop - containerRect.top, containerRect.height - element
                        .offsetHeight));

                    // Apply position with smooth animation during drag
                    element.style.left = `${newLeft}px`;
                    element.style.top = `${newTop}px`;
                    element.style.position = 'absolute';
                };

                const endDrag = () => {
                    if (!isDragging) return;

                    isDragging = false;

                    // Remove dragging visual feedback
                    element.classList.remove('dragging');
                    element.style.transition = 'box-shadow 0.3s ease';
                    document.body.style.cursor = '';
                    document.body.style.userSelect = '';

                    // Hide drag handle when not hovering
                    if (dragHandle && !element.matches(':hover')) {
                        dragHandle.style.opacity = '0';
                    }

                    // Add a subtle animation to indicate the drag has ended
                    element.animate([{
                            transform: 'scale(1.02)'
                        },
                        {
                            transform: 'scale(1)'
                        }
                    ], {
                        duration: 200,
                        easing: 'ease-out'
                    });
                };

                // Use the drag handle for dragging if available
                if (dragHandle) {
                    dragHandle.addEventListener('mousedown', startDrag);
                } else {
                    element.addEventListener('mousedown', startDrag);
                }

                document.addEventListener('mousemove', onDrag);
                document.addEventListener('mouseup', endDrag);
            };

            // Apply enhanced draggable functionality
            const imagePreview = document.getElementById('ImagePreview');
            const campaignNameShow = document.getElementById('campaignNameShow');
            const userInputCTA2 = document.getElementById('userInputCTA2');

            if (imagePreview && campaignNameShow) {
                makeDraggable(campaignNameShow, imagePreview);
            }

            if (imagePreview && userInputCTA2) {
                makeDraggable(userInputCTA2, imagePreview);
            }

            // Handle next and manual upload buttons
            const nextBtn = document.getElementById('next_btn');
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    document.getElementById('promtBoxContainer2').classList.add('d-none');
                    document.getElementById('next_btn').classList.add('d-none');
                    document.getElementById('inputTextSection').classList.remove('d-none');
                });
            }

            const manualUploadBtn = document.getElementById('userChosemenualupload');
            if (manualUploadBtn) {
                manualUploadBtn.addEventListener('click', function() {
                    document.getElementById('promtBoxContainer2').classList.add('d-none');
                    document.getElementById('inputSection').classList.remove('d-none');
                });
            }
        });

        // Function to update character count
        function updateCharCount2() {
            const textarea = document.getElementById('question2');
            const charCount = document.getElementById('charCount2');
            const currentLength = textarea.value.trim().length;

            charCount.innerText = `${currentLength} / 30 characters required`;

            if (currentLength >= 30) {
                charCount.classList.add('text-green-500');
                charCount.classList.remove('text-red-500');
            } else {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-green-500');
            }
        }

        // handle file selection
        const assetTypeDropdown = document.getElementById('assetTypeDropdown');
        const mainAssetErrorMSG = document.querySelector("#main-asset-error");
        const mainAssetErrorMSG2 = document.querySelector("#main-asset-error2");

        assetTypeDropdown.addEventListener('change', () => {
            selectedValue = parseInt(assetTypeDropdown.value);
            if (selectedValue == 1 || selectedValue == 2 || selectedValue == 6 || selectedValue == 7 ||
                selectedValue == 8 || selectedValue == 9 || selectedValue == 10 || selectedValue == 11 ||
                selectedValue == 12 || selectedValue == 13 || selectedValue == 16 || selectedValue == 17 ||
                selectedValue == 18 || selectedValue == 20 || selectedValue == 21) {
                document.getElementById("imageuploadchoice").classList.remove("d-none");
                document.getElementById("inputSection2").classList.add("d-none");
                mainAssetErrorMSG.classList.remove("d-none");
                mainAssetErrorMSG.style.color = "green";
            } else if (selectedValue == 22 || selectedValue == 23) {
                document.querySelector('#promtBoxContainer2').classList.remove('d-none');
                document.getElementById("inputSection").classList.add("d-none");
            } else {
                document.getElementById("inputSection").classList.add("d-none");
                document.getElementById("inputSection2").classList.remove("d-none");
                mainAssetErrorMSG2.classList.remove("d-none");
                mainAssetErrorMSG2.style.color = "green";
                mainAssetErrorMSG2.innerText = "Please select 1 Video*";
            }

            if (selectedValue == 1) {
                mainAssetErrorMSG.innerText = "Please select 3 Images*";
            } else if (selectedValue == 2) {
                mainAssetErrorMSG.innerText = "Please select 2 Images*";
            } else if (selectedValue == 3) {
                mainAssetErrorMSG.innerText = "Please select 1 Video*";
            } else if (selectedValue == 4) {
                mainAssetErrorMSG.innerText = "Please select between 3-6 Images*";
            } else if (selectedValue == 5) {
                mainAssetErrorMSG.innerText = "Please select between 3-6 Images*";
            } else if (selectedValue == 6) {
                mainAssetErrorMSG.innerText = "Please select 2 Images*";
            } else if (selectedValue == 7) {
                mainAssetErrorMSG.innerText = "Please select 4 Images*";
            } else if (selectedValue == 8) {
                mainAssetErrorMSG.innerText = "Please select 10 Images*";
                mainAssetErrorMSG.innerText = "Please select 1 Images*";
            } else if (selectedValue == 9) {
                mainAssetErrorMSG.innerText = "Please select 1 Image*";
            } else if (selectedValue == 10) {
                mainAssetErrorMSG.innerText = "Please select 2 Images*";
            } else if (selectedValue == 11) {
                mainAssetErrorMSG.innerText = "Please select 6 Images*";
            } else if (selectedValue == 12) {
                mainAssetErrorMSG.innerText = "Please select 5 Image*";
            } else if (selectedValue == 13) {
                mainAssetErrorMSG.innerText = "Please select 1 Images*";
            } else if (selectedValue == 14) {
                mainAssetErrorMSG.innerText = "Please select 1 Image*";
            } else if (selectedValue == 15) {
                mainAssetErrorMSG.innerText = "Please select 1 Image*";
            } else if (selectedValue == 16) {
                mainAssetErrorMSG.innerText = "Please select 6 Images*";
            } else if (selectedValue == 17) {
                mainAssetErrorMSG.innerText = "Please select 1 Images*";
            } else if (selectedValue == 18) {
                mainAssetErrorMSG.innerText = "Please select 6 Images*";
            } else if (selectedValue == 19) {
                mainAssetErrorMSG.innerText = "Please select 1 Video*";
            } else if (selectedValue == 20) {
                mainAssetErrorMSG.innerText = "Please select 5 Images*";
            } else if (selectedValue == 21) {
                mainAssetErrorMSG.innerText = "Please select 4 Images*";
            } else {
                mainAssetErrorMSG.innerText = "";
            }
        });



        document.getElementById("userChosemenualupload").addEventListener("click", () => {
            document.getElementById("inputSection").classList.remove("d-none");
            document.querySelector('#promtBoxContainer2').classList.add('d-none');
        })

        document.querySelector('#userChoseGenerateImageUpload').addEventListener('click', () => {
            document.querySelector('#promtBoxContainer2').classList.remove('d-none');
            document.getElementById("inputSection").classList.add("d-none");
        })

        document.querySelector('#submitPrompt2').addEventListener('click', () => {

            document.querySelector("#generatedImage2").classList.add("d-none");
            document.querySelector('#imageLoading2').classList.remove('d-none');

            setTimeout(() => {
                loadingMSG2.innerText = "Generating."
            }, 100)
            setTimeout(() => {
                loadingMSG2.innerText = "Generating.."
            }, 2000)
            setTimeout(() => {
                loadingMSG2.innerText = "Generating..."
            }, 3000)
            setTimeout(() => {
                loadingMSG2.innerText = "Processing"
            }, 5000)
            setTimeout(() => {
                loadingMSG2.innerText = "Processing."
            }, 5500)
            setTimeout(() => {
                loadingMSG2.innerText = "Processing.."
            }, 6000)
            setTimeout(() => {
                loadingMSG2.innerText = "Processing..."
            }, 6500)
            setTimeout(() => {
                loadingMSG2.innerText = "Please wait"
            }, 8000)
            setTimeout(() => {
                loadingMSG2.innerText = "Please wait."
            }, 8500)
            setTimeout(() => {
                loadingMSG2.innerText = "Please wait.."
            }, 9500)
            setTimeout(() => {
                loadingMSG2.innerText = "Please wait..."
                document.querySelector('#imageLoading2').classList.add('d-none');
                // if(selectedValue == 22){
                //    document.querySelector("#generatedImage3").classList.remove("d-none");
                // }else{
                document.querySelector("#generatedImage2").classList.remove("d-none");
                // }
            }, 10000)
        })

        document.querySelector("#next_btn").addEventListener('click', () => {
            //document.querySelector("#inputSection").classList.remove("d-none");
            document.querySelector("#contentText").classList.remove("d-none");
            document.querySelector("#inputTextSection").classList.remove("d-none");
        })

        // Image Compression
        fileInput.addEventListener('change', async () => {
            const selectedFiles = Array.from(fileInput.files);
            const compressedFilesArray = [];

            if (selectedFiles.length > 0) {
                fileList.classList.remove('d-none');
                fileList.innerText = 'Please wait...';
            } else {
                fileList.classList.add('d-none');
            }

            if (selectedFiles.length > 0) {
                // Compression options
                const options = {
                    maxSizeMB: 1, // Maximum size in MB
                    maxWidthOrHeight: 800, // Maximum width or height
                    useWebWorker: true,
                };

                const originalFilesArray = [];

                for (const file of selectedFiles) {
                    originalFilesArray.push(file);
                    try {
                        const compressedFile = await imageCompression(file, options);
                        if (compressedFile instanceof Blob) {
                            const fileName =
                                `compressed-${file.name}`;
                            const compressedImageFile = new File([compressedFile], fileName, {
                                type: "image/jpeg",
                            });
                            compressedFilesArray.push(compressedImageFile);
                        }
                    } catch (error) {
                        console.error("Error during compression:", error);
                    }
                }

                console.log("Original files:", originalFilesArray);
                console.log("Compressed files:", compressedFilesArray);

            } else {
                alert("Please upload valid image files.");
            }

            const images = selectedFiles.filter(file => file.type.startsWith("image/"));

            //Setected Asset Validation
            let imageCount = 0;
            let videoCount = 0;

            selectedFiles.forEach(file => {
                if (file.type.startsWith("image/")) {
                    imageCount++;
                } else if (file.type.startsWith("video/")) {
                    videoCount++;
                }
            });

            if (selectedValue == 1) {
                if (imageCount === 3) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 2) {
                if (imageCount === 2) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 4) {
                if (imageCount >= 3 && imageCount <= 6) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 5) {
                if (imageCount >= 3 && imageCount <= 6) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 6) {
                if (imageCount === 2) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 7) {
                if (imageCount === 4) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 8) {
                if (imageCount === 1) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 9) {
                if (imageCount === 1) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 10) {
                if (imageCount === 2) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 11) {
                if (imageCount === 6) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 12) {
                if (imageCount === 5) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 13) {
                if (imageCount === 1) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 14) {
                if (imageCount === 1) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 15) {
                if (imageCount === 1) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";

                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 16) {
                if (imageCount === 6) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 17) {
                if (imageCount === 1) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 18) {
                if (imageCount === 6) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 20) {
                if (imageCount === 5) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            } else if (selectedValue == 21) {
                if (imageCount === 4) {
                    mainAssetErrorMSG.style.color = "green";
                    contentText.classList.remove('d-none')
                    inputTextSection.classList.remove('d-none');
                } else {
                    mainAssetErrorMSG.style.color = "red";
                    inputTextSection.classList.add('d-none');
                    contentText.classList.add('d-none')
                }
            }

            if (selectedFiles.length > 0) {
                const firstImage = selectedFiles[0];

                if (firstImage.type.startsWith('image/')) {
                    const reader = new FileReader();
                    const imagePreview = document.getElementById('ImagePreview');

                    reader.onload = function(e) {
                        console.log('Image loaded:', e.target.result);
                        imagePreview.style.backgroundImage = `url(${e.target.result})`;
                    };

                    reader.readAsDataURL(firstImage);
                } else {
                    console.log('The selected file is not an image');
                }
            }

            fileList.innerText = '';
            selectedFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.textContent = file.name;

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-btn';
                removeButton.textContent = 'x';
                removeButton.addEventListener('click', () => {
                    removeFile(index);
                });

                fileItem.appendChild(removeButton);
                fileList.appendChild(fileItem);
            });
        });


        // video upload
        fileInput2.addEventListener('change', () => {
            const selectedFiles = Array.from(fileInput2.files);
            const videos = selectedFiles.filter(file => file.type.startsWith("video/"));
            let videoCount = 0;


            selectedFiles.forEach(file => {
                if (file.type.startsWith("video/")) {
                    videoCount++;
                }
            });

            if (selectedValue == 3 || selectedValue == 19) {
                if (videoCount == 1) {
                    document.getElementById("inputTextSection").classList.remove("d-none");
                }
            } else if (selectedValue == 4 || selectedValue == 5 || selectedValue == 14 || selectedValue == 15) {
                if (videoCount == 1) {
                    //inputSection.classList.remove('d-none');
                    document.getElementById("imageuploadchoice").classList.remove("d-none")
                    mainAssetErrorMSG.classList.remove("d-none");
                    mainAssetErrorMSG.style.color = "green";
                }
            } else {
                document.getElementById("inputSection").classList.remove("d-none");
                mainAssetErrorMSG.classList.remove("d-none");
                mainAssetErrorMSG.style.color = "green";
            }

            if (selectedFiles.length > 0) {
                fileList2.classList.remove('d-none');
            } else {
                fileList2.classList.add('d-none');
            }

            if (videoCount === 1) {
                mainAssetErrorMSG2.style.color = "green";
            } else {
                mainAssetErrorMSG2.style.color = "red";
            }

            fileList2.classList.remove('d-none');
            fileList2.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.textContent = file.name;

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-btn';
                removeButton.textContent = 'x';
                removeButton.addEventListener('click', () => {
                    removeFile2(index);
                });

                fileItem.appendChild(removeButton);
                fileList2.appendChild(fileItem);
            });
        });


        // remove a file from the list
        function removeFile(index) {
            const fileArray = Array.from(fileInput.files);
            fileArray.splice(index, 1);

            const dataTransfer = new DataTransfer();
            fileArray.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;

            fileInput.dispatchEvent(new Event('change'));
        }

        function removeFile2(index) {
            const fileArray = Array.from(fileInput2.files);
            fileArray.splice(index, 1);

            const dataTransfer = new DataTransfer();
            fileArray.forEach(file => dataTransfer.items.add(file));
            fileInput2.files = dataTransfer.files;

            fileInput2.dispatchEvent(new Event('change'));
        }

        //textInputNo
        document.getElementById("textInputNo").addEventListener("click", function() {
            inputText = false;
            document.getElementById("CTAButtonContainer").classList.remove("d-none");
        })

        //textInputYes
        document.getElementById("textInputYes").addEventListener("click", function() {
            inputText = true;
            document.getElementById("inputTextContainer").classList.remove("d-none");
        })

        //Input Text Submit
        document.getElementById("inputTextSubmit").addEventListener("click", function() {
            const inputText = document.getElementById("inputText").value
            document.getElementById("inputTextContainer2").classList.remove("d-none");
            document.getElementById("userInputText").innerText = "Your entered: " + inputText
            document.getElementById("campaignNameShow").innerText = inputText
            document.getElementById("CTAButtonContainer").classList.remove("d-none");
        })

        let btnValue;

        //Choose CTA Button
        function chooseCTAButton(btn) {
            document.getElementById("inputCTAContainer").classList.remove("d-none");

            if (selectedValue == 3) {
                document.getElementById("videoSelected").classList.remove("d-none")
            } else {
                document.getElementById("ImagePreview").classList.remove("d-none")
            }

            if (selectedValue != 3 && inputText) {
                document.getElementById("colorCodeContainer").classList.remove("d-none");
            }
            document.getElementById("userInputCTA").innerText = btn
            document.getElementById("campaignNameShow").innerText = document.getElementById("inputText").value
            btnValue = btn;
            document.getElementById("userInputCTA2").innerText = btn
            document.getElementById("interLandingURL").classList.remove("d-none");
            console.log(btnValue);

        }

        //Sumbit Landing URL
        document.getElementById("inputLandingURLSubmit").addEventListener("click", function() {
            const landingURL = document.getElementById("inputLandingURL").value;
            if (landingURL == "") {
                document.getElementById("landingURLError").classList.remove("d-none");
                return;
            } else {
                if (!document.getElementById("landingURLError").classList.contains("d-none")) {
                    document.getElementById("landingURLError").classList.add("d-none");
                }

            }
            document.getElementById("userLandingURLContainer").classList.remove("d-none");
            document.getElementById("interTrackingURL").classList.remove("d-none");
        })

        //Sumbit Tracking URL
        document.getElementById("inputTrackingURLSubmit").addEventListener("click", function() {
            const trackingURL = document.getElementById("inputTrackingURL").value;
            if (trackingURL == "") {
                document.getElementById("trackingURLError").classList.remove("d-none");
                return;
            } else {
                if (!document.getElementById("trackingURLError").classList.contains("d-none")) {
                    document.getElementById("trackingURLError").classList.add("d-none");
                }

            }
            document.getElementById("userTrackingURLContainer").classList.remove("d-none");
            document.getElementById("interCreativeNameContainer").classList.remove("d-none");
        })

        //Submit Creative Name
        document.getElementById("inputCreativeNameSubmit").addEventListener("click", function() {
            const creativeName = document.getElementById("inputCreativeName").value;
            if (creativeName == "") {
                document.getElementById("creativeNameError").classList.remove("d-none");
                return;
            } else {
                if (!document.getElementById("creativeNameError").classList.contains("d-none")) {
                    document.getElementById("creativeNameError").classList.add("d-none");
                }

            }
            document.getElementById("userCreativeName").innerText = "Creative Name is: " + creativeName
            document.getElementById("userCreativeNameContainer").classList.remove("d-none");
            document.getElementById("generateCreativeContainer").classList.remove("d-none");
        })

        //Change Campaign Name's Color
        document.getElementById("colorCodeSubmit").addEventListener("click", function() {
            let colorCode = document.getElementById("inputColorCode").value
            console.log(colorCode)
            document.getElementById("campaignNameShow").classList.add(`text-[${colorCode}]`);
        })

        const fontSizeInput = document.getElementById('fontSizeInput');

        fontSizeInput.addEventListener('input', () => {
            const fontSizeValue = fontSizeInput.value;
            if (fontSizeValue) {
                document.getElementById("campaignNameShow").style.fontSize = `${fontSizeValue}px`;
            }
        });


        const pickr = Pickr.create({
            el: '#color-picker',
            theme: 'nano',
            default: '#ff0000',

            appClass: 'custom-class',
            useAsButton: true,


            swatches: [
                'rgba(0, 0, 0, 1)',
                'rgba(255, 255, 255, 1)',
                'rgba(244, 67, 54, 1)',
                'rgba(233, 30, 99, 0.95)',
                'rgba(156, 39, 176, 0.9)',
                'rgba(103, 58, 183, 0.85)',
                'rgba(63, 81, 181, 0.8)',
                'rgba(33, 150, 243, 0.75)',
                'rgba(3, 169, 244, 0.7)',
                'rgba(0, 188, 212, 0.7)',
                'rgba(0, 150, 136, 0.75)',
                'rgba(76, 175, 80, 0.8)',
                'rgba(139, 195, 74, 0.85)',
                'rgba(205, 220, 57, 0.9)',
            ],

            components: {
                preview: true,
                opacity: true,
                hue: true,

                interaction: {
                    input: true,
                },
            },
        });

        // Handle color selection
        pickr.on('change', (color) => {
            const rgbaColor = color.toHEXA().toString(); // Get the color in HEXA format
            //console.log('Selected color:', rgbaColor);
            const element = document.getElementById("campaignNameShow");
            element.style.color = rgbaColor;
        });


        //Drag and Drop
        // const makeDraggable = (element, container) => {
        //     let offsetX = 0;
        //     let offsetY = 0;
        //     let isDragging = false;

        //     element.addEventListener('mousedown', (event) => {
        //         isDragging = true;
        //         offsetX = event.clientX - element.getBoundingClientRect().left;
        //         offsetY = event.clientY - element.getBoundingClientRect().top;
        //         document.body.style.userSelect = 'none'; // Disable text selection during drag
        //     });

        //     document.addEventListener('mousemove', (event) => {
        //         if (isDragging) {
        //             const containerRect = container.getBoundingClientRect();

        //             let newLeft = event.clientX - offsetX;
        //             let newTop = event.clientY - offsetY;

        //             newLeft = Math.max(containerRect.left, Math.min(newLeft, containerRect.right - element
        //                 .offsetWidth));
        //             newTop = Math.max(containerRect.top, Math.min(newTop, containerRect.bottom - element
        //                 .offsetHeight));

        //             element.style.left = `${newLeft - containerRect.left}px`;
        //             element.style.top = `${newTop - containerRect.top}px`;
        //             element.style.position = 'absolute';
        //             element.style.zIndex = '1000';
        //         }
        //     });

        //     document.addEventListener('mouseup', () => {
        //         isDragging = false;
        //         document.body.style.userSelect = '';
        //     });
        // };

        // const imagePreview = document.getElementById('ImagePreview');
        // const campaignNameShow = document.getElementById('campaignNameShow');
        // const userInputCTA2 = document.getElementById('userInputCTA2');

        // makeDraggable(campaignNameShow, imagePreview);
        // makeDraggable(userInputCTA2, imagePreview);

        //End Drag and Drop
        //Test
    </script>


    @livewireScripts
</body>

</html>
