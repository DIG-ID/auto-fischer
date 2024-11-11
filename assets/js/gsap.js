import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Lenis from 'lenis';

// GSAP horizontal scroll effect (this will still run on the about page)
gsap.registerPlugin(ScrollTrigger);

// Initialize Lenis only if it's NOT the about page
const lenis = new Lenis({
	duration: 1.1,
	smooth: true,
	//easing: easeOutExpo(),
});

function raf(time) {
	lenis.raf(time);
	requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

// GSAP ScrollTrigger integration with Lenis
lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time) => {
	lenis.raf(time * 1000);
});

gsap.ticker.lagSmoothing(0);

// Scroll to top button & fixed header
const scrollToTopBtn = document.getElementById('scrollToTop');
const header = document.querySelector('header');
const threshold = 0;
const showScrollToTopThreshold = 400;

// Initial styles for scroll-to-top button
gsap.set(scrollToTopBtn, { autoAlpha: 0, y: 64 });

// Track scroll position with Lenis
lenis.on('scroll', ({ scroll }) => {
  // Toggle scroll-to-top button visibility and animation
  const showScrollButton = scroll > showScrollToTopThreshold;
  gsap.to(scrollToTopBtn, {
    autoAlpha: showScrollButton ? 1 : 0,
    y: showScrollButton ? 0 : 64,
    duration: showScrollButton ? 0.6 : 0.3,
    ease: 'power2.out'
  });

  // Toggle header class
  header.classList.toggle('scrolled', scroll > threshold);
});

// Scroll-to-top button click event
scrollToTopBtn.addEventListener('click', (e) => {
  e.preventDefault();
  lenis.scrollTo(0); // Smooth scroll to top
});
