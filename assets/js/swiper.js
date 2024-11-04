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

    if (document.body.classList.contains("page-template-page-home") || document.body.classList.contains("page-template-page-uber-uns")) {
        var reviewSwiper = new Swiper(".reviews-swiper", {
            lazy: {
                loadOnTransitionStart: true,
            },
            slidesPerView: 3,
            spaceBetween: 24,
            speed: 800,
            loop: false,
            pagination: {
                el: ".pagination-info",
                type: "custom",
                renderCustom: function (swiper, current, total) {
                    return `${current} of ${total}`;
                },
            },
            navigation: {
                nextEl: ".arrow-right",
                prevEl: ".arrow-left",
            },
        });
    }    

    if (document.body.classList.contains("page-template-page-uber-uns")) {
        var gallerySwiper = new Swiper(".gallerySwiper", {
            lazy: {
                loadOnTransitionStart: true,
            },
            slidesPerView: 3,
            spaceBetween: 24,
            speed: 800,
            loop: true,
            centeredSlides: true,
        });
    }    

}, false);
