import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import Lenis from "lenis";

// GSAP horizontal scroll effect
gsap.registerPlugin(ScrollTrigger);

// Initialize Lenis
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
lenis.on("scroll", ScrollTrigger.update);

// Disable Lenis for .thumbnails-container when hovering
const thumbnailsContainer = document.querySelector('.thumbnails-container');
let isHoveringThumbnails = false;

if (thumbnailsContainer) {
    thumbnailsContainer.addEventListener('mouseenter', () => {
        // Disable smooth scrolling but keep the native scrollbar
        isHoveringThumbnails = true;

        // Disable Lenis' smooth scrolling
        lenis.stop();

        // Make sure the native scrollbar is visible and usable
        document.body.style.overflow = 'scroll'; // Force the browser scrollbar to remain visible

        // Optionally, disable Lenis on touch devices as well
        document.body.style.overflowY = 'scroll'; // This ensures vertical scrolling is still available
    });

    thumbnailsContainer.addEventListener('mouseleave', () => {
        // Re-enable smooth scrolling when leaving the thumbnails container
        isHoveringThumbnails = false;

        // Restart Lenis smooth scrolling
        lenis.start();

        // Restore the default page scroll behavior from Lenis
        document.body.style.overflow = ''; // Let Lenis control the scrolling again
        document.body.style.overflowY = ''; // Reset vertical overflow to default
    });

    // Optional: Handle touch events on mobile devices
    thumbnailsContainer.addEventListener('touchstart', () => {
        lenis.stop();
        document.body.style.overflow = 'scroll'; // Ensure scrollbar is visible on touch
        document.body.style.overflowY = 'scroll';
    });

    thumbnailsContainer.addEventListener('touchend', () => {
        lenis.start();
        document.body.style.overflow = ''; // Restore Lenis control on scroll
        document.body.style.overflowY = ''; // Reset vertical overflow to default
    });
}


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

if (document.body.classList.contains("unser-highlight-template-default")) {
	//sticky sidebar for car highlights
	// Create a GSAP Context
	let context = gsap.context(() => {
		if (window.matchMedia("(min-width: 1280px)").matches) {
			const sidebar = document.querySelector('#sticky-sidebar');
			const sidebarContainer = sidebar?.parentElement; // Parent container of the sidebar
	
			if (sidebar && sidebarContainer) {
				gsap.to(sidebar, {
					scrollTrigger: {
						trigger: sidebar,
						start: 'top top+=100', // 100px gap from the top
						end: () => {
							// Dynamically calculate the end with a 320px offset
							const containerBottom = sidebarContainer.getBoundingClientRect().bottom + window.scrollY;
							return `${containerBottom - window.innerHeight - 660}px top`; 
						},
						scrub: true, // Smooth sticky behavior
						pin: true, // Makes the sidebar sticky
						anticipatePin: 1, // For a smooth experience
					},
				});
	
				// Listen for changes in the accordion to refresh ScrollTrigger
				const accordionItems = document.querySelectorAll('.specs-item');
	
				accordionItems.forEach(item => {
					const toggleButton = item.querySelector('.specs-title');
	
					toggleButton.addEventListener('click', () => {
						// Refresh ScrollTrigger after accordion toggle
						setTimeout(() => {
							ScrollTrigger.refresh();
						}, 300); // Add a slight delay to ensure height changes are applied
					});
				});
			}
		}
	});
	
	


	// Cleanup on resize
	window.addEventListener('resize', () => {
		context.revert(); // Remove all animations and ScrollTriggers
		context = gsap.context(() => {
			if (window.matchMedia("(min-width: 1280px)").matches) {
				const sidebar = document.querySelector('#sticky-sidebar');

				if (sidebar) {
					gsap.to(sidebar, {
						scrollTrigger: {
							trigger: sidebar,
							start: 'top top+=100', // Adds 100px gap from the top
							end: 'bottom+=500 top', // Sticky ends after 500px scroll or as needed
							scrub: true, // Smooth sticky behavior
							pin: true, // Makes the sidebar sticky
							anticipatePin: 1, // For smooth experience
						},
					});
				}
			}
		});
	});
}