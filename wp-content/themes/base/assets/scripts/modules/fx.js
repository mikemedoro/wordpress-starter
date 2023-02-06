import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import imagesLoaded from 'imagesloaded';

imagesLoaded.makeJQueryPlugin($);
gsap.registerPlugin(ScrollTrigger);

const Fx = {
  init() {
    this.ScrollReveal();
  },
  ScrollReveal() {
    gsap.utils.toArray('.scroll-watch').forEach((el) => {
      ScrollTrigger.create({
        toggleClass: 'is-inview',
        trigger: el,
        once: true,
        start: 'top 80%',
      });
    });
  },
};

export default Fx;
