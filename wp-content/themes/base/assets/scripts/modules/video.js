import { gsap } from 'gsap';
import { CSSPlugin } from 'gsap/CSSPlugin';

// Ensure modules don't get dropped by tree-shaking
gsap.registerPlugin(CSSPlugin);

const PlayVideo = {
  init() {
    this.PlayVideo();
  },
  PlayVideo() {
    $('.play-btn').on('click', (e) => {
      const $this = $(e.currentTarget);
      const $video = $this.parents('.video-block').find('video');

      gsap.to($this, { autoAlpha: 0, duration: 0.35 });

      $video[0].muted = false;
      $video[0].controls = true;
      $video[0].currentTime = 0;
      $video[0].loop = false;
      $video[0].play();
    });
  },
};

export default PlayVideo;
