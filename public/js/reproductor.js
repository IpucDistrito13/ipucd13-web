const audioPlayer = document.getElementById('audioPlayer');
const prevButton = document.getElementById('prevButton');
const playPauseButton = document.getElementById('playPauseButton');
const nextButton = document.getElementById('nextButton');
const songTitle = document.getElementById('songTitle');
const songDescription = document.getElementById('songDescription');
const playlistElement = document.querySelector('.playlist');

const progressBar = document.getElementById('progressBar');

const durationElement = document.getElementById('duration');
const timeRemainingElement = document.getElementById('timeRemaining'); // Nuevo elemento

audioPlayer.addEventListener('loadedmetadata', () => {
    const minutes = Math.floor(audioPlayer.duration / 60);
    const seconds = Math.floor(audioPlayer.duration % 60);
    durationElement.textContent = `Duración: ${minutes}:${seconds.toString().padStart(2, '0')}`;
});

audioPlayer.addEventListener('timeupdate', () => {
    const { currentTime, duration } = audioPlayer;
    const progressPercent = (currentTime / duration) * 100;
    progressBar.value = progressPercent;

    const remainingTime = duration - currentTime;
    const remainingMinutes = Math.floor(remainingTime / 60);
    const remainingSeconds = Math.floor(remainingTime % 60);
    timeRemainingElement.textContent = `Tiempo restante: ${remainingMinutes}:${remainingSeconds.toString().padStart(2, '0')}`;
});

progressBar.addEventListener('input', () => {
    const seekTime = (progressBar.value / 100) * audioPlayer.duration;
    audioPlayer.currentTime = seekTime;
});

const playlist = [
    {
        src: 'https://mismp3cristianos.com/wp-content/uploads/2018/05/Profetizare.mp3',
        title: 'Dios rey soberano y unico en el mundo',
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