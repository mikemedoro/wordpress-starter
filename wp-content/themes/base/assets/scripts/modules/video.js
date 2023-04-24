import { gsap } from 'gsap';
import { CSSPlugin } from 'gsap/CSSPlugin';

// Ensure modules don't get dropped by tree-shaking
gsap.registerPlugin(CSSPlugin);

const PlayVideo = {
  init() {
    this.PlayVideo();
  },
  PlayVideo() {
    document.querySelectorAll('.play-btn').forEach((btn) => {
      btn.addEventListener('click', (e) => {
        const videoBlock = e.currentTarget.closest('.video-block');
        const video = videoBlock.querySelector('video');

        gsap.to(e.currentTarget, { autoAlpha: 0, duration: 0.35 });

        video.muted = false;
        video.controls = true;
        video.currentTime = 0;
        video.loop = false;
        video.play();
      });
    });
  },
};

export default PlayVideo;
