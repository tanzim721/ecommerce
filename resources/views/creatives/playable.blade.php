<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basketball Game</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        
        header {
            background-color: #2a2a2a;
            color: white;
            width: 100%;
            text-align: center;
            padding: 1rem 0;
        }
        
        .game-container {
            margin: 20px;
            width: 90%;
            max-width: 1000px;
            height: 80vh;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .overlay-image {
            position: absolute;
            width: 300px;
            height: 200px;
            top: 20px;
            right: 20px;
            background-color: white;
            border: 3px solid #333;
            border-radius: 8px;
            padding: 5px;
            display: none;
            z-index: 10;
            background-image: url('/api/placeholder/300/200');
            background-size: cover;
            background-position: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        
        footer {
            margin-top: auto;
            width: 100%;
            background-color: #2a2a2a;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Basketball Game</h1>
    </header>
    
    <div class="game-container" id="gameContainer">
        <iframe src="https://toucan.adplaytechnology.com/basketball/" allowfullscreen id="gameIframe"></iframe>
        <div class="overlay-image" id="overlayImage"></div>
    </div>
    
    <footer>
        <p>&copy; 2025 My Basketball Project</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gameContainer = document.getElementById('gameContainer');
            const overlayImage = document.getElementById('overlayImage');
            let timerSet = false;

            gameContainer.addEventListener('click', function() {
                if (!timerSet) {
                    timerSet = true;
                    console.log('Game clicked, image will appear in 15 seconds');
                    
                    // Set timer to show the image after 15 seconds
                    setTimeout(function() {
                        overlayImage.style.display = 'block';
                        console.log('Image is now displayed');
                    }, 15000); // 15 seconds in milliseconds
                }
            });

            // Allow clicking on the overlay image to close it
            overlayImage.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent triggering the container click event
                overlayImage.style.display = 'none';
                timerSet = false;
                console.log('Image closed');
            });
        });
    </script>
</body>
</html>