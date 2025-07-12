/*
    Audio Player Injector
    This script dynamically creates and inserts the audio player, its styles, and its logic.
    It is designed to be self-contained and minimize interference with existing code.
*/

(function() {
    let playlist = []; // Will be loaded from JSON

    let currentTrackIndex = 0;
    let isPlaying = false;
    let audio = document.getElementById('background-music');
    let audioContext = null;
    let analyser = null;
    let source = null;
    let animationFrameId = null;

    // Function to create and append CSS styles
    function injectStyles() {
        const style = document.createElement('style');
        style.textContent = `
            #music-controls {
                position: fixed;
                top: 80px; /* Adjusted to be below the header */
                right: 20px;
                z-index: 1000;
                /* Removed background-color, border-radius, padding, box-shadow, backdrop-filter */
                display: flex;
                flex-direction: column; /* Changed to column for better layout */
                align-items: flex-end;
                gap: 5px; /* Reduced gap */
            }
            .player-controls-row {
                display: flex;
                align-items: center;
                margin-bottom: 5px;
            }
            .player-controls-row button {
                background: transparent;
                border: none;
                color: #fff;
                font-size: 16px;
                cursor: pointer;
                transition: color 0.3s ease;
                padding: 0 5px; /* Added padding for better click area */
            }
            .player-controls-row button:hover {
                color: #2be6ab;
            }
            .volume-controls-row {
                display: flex;
                align-items: center;
                margin-bottom: 5px;
            }
            .volume-controls-row #mute-icon {
                color: white;
                font-size: 20px;
                cursor: pointer;
                margin-right: 5px;
            }
            .volume-controls-row #volume-slider {
                width: 150px;
                vertical-align: middle;
            }
            #current-track-title {
                color: #fff;
                font-size: 14px;
                font-weight: 500;
                margin-bottom: 5px;
                max-width: 180px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                text-align: right;
            }
            #player-visualizer {
                height: 40px;
                width: 150px;
                margin-top: 5px;
                align-self: flex-end; /* Ensure it aligns to the end */
            }
        `;
        document.head.appendChild(style);
    }

    // Functions (moved to top level for scope access)
    function shufflePlaylist() {
        for (let i = playlist.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [playlist[i], playlist[j]] = [playlist[j], playlist[i]];
        }
    }

    function setTrack(index, autoPlay = true) {
            currentTrackIndex = index;
            audio.src = playlist[currentTrackIndex].src;
            currentTrackTitle.textContent = playlist[currentTrackIndex].title;
            if (autoPlay) {
                // Ensure visualizer is set up before playing
                if (!audioContext) {
                    setupVisualizer();
                }
                play();
            }
        }

    function togglePlayPause() {
        if (!audioContext) {
            setupVisualizer();
        }
        if (audioContext && audioContext.state === 'suspended') {
            audioContext.resume().then(() => {
                if (isPlaying) {
                    pause();
                } else {
                    play();
                }
            });
        } else {
            if (isPlaying) {
                pause();
            } else {
                play();
            }
        }
    }

    function play() {
        isPlaying = true;
        const playPromise = audio.play();
        if (playPromise !== undefined) {
            playPromise.then(() => {
                playPauseIcon.className = 'fa fa-pause';
                if (audioContext && audioContext.state === 'suspended') {
                    audioContext.resume();
                }
                drawVisualizer();
            }).catch(error => {
                console.error("Playback error (autoplay blocked?):", error);
                isPlaying = false; // Reset playing state
                playPauseIcon.className = 'fa fa-play'; // Show play icon
                // Optionally, display a message to the user to click play
            });
        }
    }

    function pause() {
        isPlaying = false;
        audio.pause();
        playPauseIcon.className = 'fa fa-play';
        if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
            animationFrameId = null;
        }
    }

    function playNextTrack() {
        currentTrackIndex = (currentTrackIndex + 1) % playlist.length;
        setTrack(currentTrackIndex);
    }

    function playPreviousTrack() {
        currentTrackIndex = (currentTrackIndex - 1 + playlist.length) % playlist.length;
        setTrack(currentTrackIndex);
    }

    function toggleMute() {
        audio.muted = !audio.muted;
        updateMuteIcon();
    }

    function updateVolume() {
        audio.volume = volumeSlider.value / 100;
        if (audio.muted && audio.volume > 0) {
            audio.muted = false;
        }
        updateMuteIcon();
    }

    function updateMuteIcon() {
        if (audio.muted || audio.volume === 0) {
            muteIcon.className = 'fa fa-volume-off';
        } else {
            muteIcon.className = 'fa fa-volume-up';
        }
    }

    function setupVisualizer() {
        if (audioContext) return;
        audioContext = new (window.AudioContext || window.webkitAudioContext)();
        analyser = audioContext.createAnalyser();
        try {
            source = audioContext.createMediaElementSource(audio);
            source.connect(analyser);
            analyser.connect(audioContext.destination);
            analyser.fftSize = 128;
        } catch (e) {
            console.error("Error setting up visualizer:", e);
            return;
        }
    }

    function drawVisualizer() {
        const ctx = visualizerCanvas.getContext('2d');
        const bufferLength = analyser.frequencyBinCount;
        const dataArray = new Uint8Array(bufferLength);
        
        const draw = () => {
            if (!isPlaying) {
                ctx.clearRect(0, 0, visualizerCanvas.width, visualizerCanvas.height);
                return;
            }
            animationFrameId = requestAnimationFrame(draw);
            analyser.getByteFrequencyData(dataArray);
            ctx.clearRect(0, 0, visualizerCanvas.width, visualizerCanvas.height);
            const barWidth = (visualizerCanvas.width / bufferLength);
            let barHeight;
            let x = visualizerCanvas.width; // Start x from the rightmost edge
            for (let i = 0; i < bufferLength; i++) {
                barHeight = dataArray[i] / 8; // Halved the height
                ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
                x -= (barWidth + 1); // Decrement x to draw from right to left
                ctx.fillRect(x, visualizerCanvas.height - barHeight, barWidth, barHeight);
            }
        };
        draw();
    }

    // Main player logic
    let playPauseIcon;
    let nextBtn;
    let prevBtn;
    let muteIcon;
    let volumeSlider;
    let currentTrackTitle;
    let visualizerCanvas;

    function initPlayer() {
        audio.crossOrigin = "anonymous";

        playPauseIcon = document.getElementById('play-pause-icon');
        nextBtn = document.getElementById('player-next');
        prevBtn = document.getElementById('player-prev');
        muteIcon = document.getElementById('mute-icon');
        volumeSlider = document.getElementById('volume-slider');
        currentTrackTitle = document.getElementById('current-track-title');
        visualizerCanvas = document.getElementById('player-visualizer');

        // Event Listeners
        playPauseIcon.addEventListener('click', togglePlayPause);
        nextBtn.addEventListener('click', playNextTrack);
        prevBtn.addEventListener('click', playPreviousTrack);
        muteIcon.addEventListener('click', toggleMute);
        volumeSlider.addEventListener('input', updateVolume);
        volumeSlider.addEventListener('change', updateVolume);
        audio.addEventListener('ended', playNextTrack);
        audio.addEventListener('volumechange', updateMuteIcon);

        // Save state before page unload
        window.addEventListener('beforeunload', () => {
            sessionStorage.setItem('audioCurrentTime', audio.currentTime);
            sessionStorage.setItem('audioCurrentTrackIndex', currentTrackIndex);
            sessionStorage.setItem('audioVolume', audio.volume);
            sessionStorage.setItem('audioMuted', audio.muted);
            sessionStorage.setItem('audioIsPlaying', isPlaying); // Save playing state
        });

        // Initial setup (moved to DOMContentLoaded to handle saved state)
        audio.volume = volumeSlider.value / 100;
        updateMuteIcon();
    }

    // Execute when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', async () => {
        injectStyles();
        await loadPlaylist();
        initPlayer();

        // Load state and resume playback
        const savedCurrentTime = sessionStorage.getItem('audioCurrentTime');
        const savedCurrentTrackIndex = sessionStorage.getItem('audioCurrentTrackIndex');
        const savedVolume = sessionStorage.getItem('audioVolume');
        const savedMuted = sessionStorage.getItem('audioMuted');
        const savedIsPlaying = sessionStorage.getItem('audioIsPlaying');

        if (savedCurrentTrackIndex !== null && playlist.length > 0) {
            currentTrackIndex = parseInt(savedCurrentTrackIndex, 10);
            audio.src = playlist[currentTrackIndex].src;
            document.getElementById('current-track-title').textContent = playlist[currentTrackIndex].title;

            if (savedCurrentTime !== null) {
                audio.currentTime = parseFloat(savedCurrentTime);
            }
            if (savedVolume !== null) {
                audio.volume = parseFloat(savedVolume);
                document.getElementById('volume-slider').value = parseFloat(savedVolume) * 100;
            }
            if (savedMuted !== null) {
                audio.muted = (savedMuted === 'true');
            }
            updateMuteIcon();

            // Attempt to play if it was playing before unload, only when audio is ready
            if (savedIsPlaying === 'true') {
                setupVisualizer(); // Ensure visualizer is set up before playing
                audio.addEventListener('canplaythrough', function handler() {
                    audio.removeEventListener('canplaythrough', handler); // Remove listener after first play
                    play();
                });
                audio.load(); // Ensure audio loads the new source
            }
        } else {
            // Initial setup if no saved state
            // Do not shuffle playlist on initial load to maintain consistent first track
            setTrack(0, false); // Start with the first track (index 0) and don't autoplay
        }
    });

    async function loadPlaylist() {
        try {
            const response = await fetch('application/config/playlist.json');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            playlist = await response.json();
        } catch (error) {
            console.error('Error loading playlist:', error);
            // Fallback to an empty playlist or handle error gracefully
            playlist = [];
        }
    }

})();
