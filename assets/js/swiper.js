import Swiper from 'swiper/bundle';

//wait until images, links, fonts, stylesheets, and js is loaded
window.addEventListener("load", () => {

	if (document.body.classList.contains("page-template-page-home")) {
        var heroSwiper = new Swiper(".team-swiper", {
            lazy: {
                loadOnTransitionStart: true,
            },
            slidesPerView: 4,
            spaceBetween: 24,
            speed: 800,
            loop: false,
        });
    }

}, false);
