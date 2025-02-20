import { Howl } from "howler";

// Function to initialize audio dynamically
window.initAudio = function (audioSrc) {
    if (window.sound) {
        window.sound.unload(); // Remove previous instance if exists
    }
    console.log("init");
    window.sound = new Howl({
        src: [audioSrc],
        html5: true,
        onplay: updateProgress,
        onseek: updateProgress,
        onload: updateDuration, // Set total duration on load
    });
};

// Play function
window.playAudio = function () {
    if (window.sound && !window.sound.playing()) {
        window.sound.play();
        requestAnimationFrame(updateProgress);
    }
};

// Pause function
window.pauseAudio = function () {
    if (window.sound && window.sound.playing()) {
        window.sound.pause();
    }
};

// Stop function
window.stopAudio = function () {
    if (window.sound) {
        window.sound.stop();
        updateProgress();
    }
};

// Update progress bar
function updateProgress() {
    const progressBar = document.getElementById("progressBar");
    const currentTimeEl = document.getElementById("currentTime");

    if (window.sound && window.sound.playing()) {
        const progress = (window.sound.seek() / window.sound.duration()) * 100;
        progressBar.value = progress;
        currentTimeEl.textContent = formatTime(window.sound.seek());

        requestAnimationFrame(updateProgress);
    }
}

// Update total duration when audio is loaded
function updateDuration() {
    document.getElementById("duration").textContent = formatTime(window.sound.duration());
}

// Seek function
window.seekAudio = function (event) {
    const seekTime = (event.target.value / 100) * window.sound.duration();
    window.sound.seek(seekTime);
};

// Format time (minutes:seconds)
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${minutes}:${secs.toString().padStart(2, "0")}`;
}
