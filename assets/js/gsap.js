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

// Scroll to top button.
const scrollToTopBtn = document.getElementById('scrollToTop');

// Track scroll position with Lenis
lenis.on('scroll', ({ scroll }) => {
	if (scroll > 400) {
		gsap.to(scrollToTopBtn, { autoAlpha: 1, y: 0, duration: 0.6, });
	} else {
		gsap.to(scrollToTopBtn, { autoAlpha: 0, y: 64, duration: .3, });
	}
});

scrollToTopBtn.addEventListener('click', (e) => {
	e.preventDefault();
	lenis.scrollTo(0); // Smooth scroll to top
});