<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproductor de Música</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 5px;
            font-family: Arial, sans-serif;
        }

        .player-container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            box-sizing: border-box;
        }

        .player {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 20px;
            text-align: center;
            flex: 1;
        }

        .album-art {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .song-title {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .song-description {
            font-size: 1em;
            color: #666;
            margin-bottom: 20px;
        }

        .controls {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        button {
            margin: 0 5px;
            padding: 10px;
            background-color: #00338D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
        }

        button:hover {
            background-color: #0056b3;
        }

        .playlist {
            display: flex;
            flex-direction: column;
            max-height: 400px;
            overflow-y: auto;
            flex: 1;
        }

        .playlist-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        .playlist-item:hover {
            background-color: #f0f0f0;
        }

        .playlist-item.active {
            background-color: #00338D;
            color: white;
        }

        /* Responsivo */
        @media (max-width: 600px) {
            .player-container {
                flex-direction: column;
                align-items: center;
            }

            .player {
                margin-right: 0;
                margin-bottom: 20px;
                width: 100%;
            }

            .album-art {
                width: 80%;
            }
        }

        @media (max-width: 400px) {
            .song-title {
                font-size: 1.2em;
            }

            .song-description {
                font-size: 0.9em;
            }

            button {
                padding: 8px;
                font-size: 0.9em;
            }
        }
        
    </style>
</head>

<body>
    <div class="player-container">
        <div class="player">
            <img src="album-art.jpg" alt="Álbum Art" class="album-art">
            <div class="song-info">
                <div class="song-title" id="songTitle">Título de la Canción</div>
                <div class="song-description" id="songDescription">Descripción breve de la canción.</div>
                <div id="duration">Duración: 0:00</div>
            </div>
            <audio id="audioPlayer" controls style="display: none;">
                <source src="cancion1.mp3" type="audio/mp3">
                Tu navegador no soporta la reproducción de audio.
            </audio>
            <input type="range" id="progressBar" value="0" style="width: 100%;">
            <div class="controls">
                <button id="prevButton"><i class="fas fa-backward"></i></button>
                <button id="playPauseButton"><i class="fas fa-play"></i></button>
                <button id="nextButton"><i class="fas fa-forward"></i></button>
            </div>
        </div>
        <div class="playlist">
            <!-- Aquí se generará la lista de reproducción -->
        </div>
    </div>
    <script>
        const audioPlayer = document.getElementById('audioPlayer');
        const prevButton = document.getElementById('prevButton');
        const playPauseButton = document.getElementById('playPauseButton');
        const nextButton = document.getElementById('nextButton');
        const songTitle = document.getElementById('songTitle');
        const songDescription = document.getElementById('songDescription');
        const playlistElement = document.querySelector('.playlist');

        const progressBar = document.getElementById('progressBar');

        const durationElement = document.getElementById('duration');

audioPlayer.addEventListener('loadedmetadata', () => {
    const minutes = Math.floor(audioPlayer.duration / 60);
    const seconds = Math.floor(audioPlayer.duration % 60);
    durationElement.textContent = `Duración: ${minutes}:${seconds.toString().padStart(2, '0')}`;
});


        audioPlayer.addEventListener('timeupdate', () => {
            const {
                currentTime,
                duration
            } = audioPlayer;
            const progressPercent = (currentTime / duration) * 100;
            progressBar.value = progressPercent;
        });

        progressBar.addEventListener('input', () => {
            const seekTime = (progressBar.value / 100) * audioPlayer.duration;
            audioPlayer.currentTime = seekTime;
        });


        const playlist = [{
                src: 'https://mismp3cristianos.com/wp-content/uploads/2018/05/Profetizare.mp3',
                title: 'Dios rey soberano y unico en el mundo testooooooooooooo oooooooooooo',
                description: 'Descripción de la Canción 1',
                img: 'https://d1csarkz8obe9u.cloudfront.net/posterpreviews/music-album-cover-design-template-0b55f32b3855ba41707a08e386e95d6e_screen.jpg?ts=1561485226'
            },
            {
                src: 'https://mismp3cristianos.com/wp-content/uploads/2016/06/Espritu-Santo.mp3',
                title: 'Canción 2',
                description: 'Descripción de la Canción 2',
                img: 'album-art2.jpg'
            },
            {
                src: 'https://mismp3cristianos.com/wp-content/uploads/2016/08/La-Tierra-Canta.mp3',
                title: 'Canción 3',
                description: 'Descripción de la Canción 3',
                img: 'album-art3.jpg'
            }
        ];

        let currentSongIndex = 0;

        function loadSong(index) {
            const song = playlist[index];
            audioPlayer.src = song.src;
            songTitle.textContent = song.title;
            songDescription.textContent = song.description;
            document.querySelector('.album-art').src = song.img;
            audioPlayer.play();

            document.querySelectorAll('.playlist-item').forEach((item, i) => {
                item.classList.toggle('active', i === index);
            });

            playPauseButton.innerHTML = '<i class="fas fa-pause"></i>';
        }

        audioPlayer.addEventListener('ended', () => {
            currentSongIndex = (currentSongIndex + 1) % playlist.length;
            loadSong(currentSongIndex);
        });

        prevButton.addEventListener('click', () => {
            currentSongIndex = (currentSongIndex - 1 + playlist.length) % playlist.length;
            loadSong(currentSongIndex);
        });

        nextButton.addEventListener('click', () => {
            currentSongIndex = (currentSongIndex + 1) % playlist.length;
            loadSong(currentSongIndex);
        });

        playPauseButton.addEventListener('click', () => {
            if (audioPlayer.paused) {
                audioPlayer.play();
                playPauseButton.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                audioPlayer.pause();
                playPauseButton.innerHTML = '<i class="fas fa-play"></i>';
            }
        });

        // Generate playlist items
        playlist.forEach((song, index) => {
            const item = document.createElement('div');
            item.classList.add('playlist-item');
            item.textContent = song.title;
            item.addEventListener('click', () => {
                currentSongIndex = index;
                loadSong(currentSongIndex);
            });
            playlistElement.appendChild(item);
        });

        // Load the first song
        loadSong(currentSongIndex);
    </script>
</body>

</html>
