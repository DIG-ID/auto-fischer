import Swiper from 'swiper/bundle';

//wait until images, links, fonts, stylesheets, and js is loaded
window.addEventListener("load", () => {

	if (document.body.classList.contains("page-template-page-home")) {
        var heroSwiper = new Swiper(".team-swiper", {
            lazy: {
                loadOnTransitionStart: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 3, // Show all slides in 3 columns when viewport is less than 1024px
                    grid: {
                        rows: 2, // 2 rows for a grid layout
                    },
                    loop: false, // Disable looping for this layout
                    spaceBetween: 16, // Adjust space between slides if needed
                },
                1024: {
                    slidesPerView: 4, // Switch back to regular layout with 4 slides in view
                    grid: {
                        rows: 1,
                    },
                    spaceBetween: 24,
                },
            },
            slidesPerView: 2, // Default view for larger screens
            grid: {
                rows: 3, // 2 rows for a grid layout
            },
            spaceBetween: 24,
            speed: 800,
            loop: false,
            navigation: {
                nextEl: ".arrow-right",
                prevEl: ".arrow-left",
            },
        });
    }

    if (document.body.classList.contains("page-template-page-home") || document.body.classList.contains("page-template-page-uber-uns")) {
        var reviewSwiper = new Swiper(".reviews-swiper", {
            lazy: {
                loadOnTransitionStart: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1.5,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            slidesPerView: 1,
            spaceBetween: 24,
            speed: 800,
            loop: false,
            pagination: {
                el: ".pagination-info",
                type: "custom",
                renderCustom: function (swiper, current, total) {
                    return `${current} von ${total}`;
                },
            },
            navigation: {
                nextEl: ".arrow-right",
                prevEl: ".arrow-left",
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
    }    

    if (document.body.classList.contains("page-template-page-uber-uns")) {
        var gallerySwiper = new Swiper(".gallerySwiper", {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            centeredSlides: true,
            grabCursor: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".pagination-info",
                type: "custom",
                renderCustom: function (swiper, current, total) {
                    return `${current} von ${total}`;
                },
            },
            navigation: {
                nextEl: ".arrow-right",
                prevEl: ".arrow-left",
            },
            breakpoints: {
                768: {
                    slidesPerView: 1.5,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            /*effect: "coverflow",
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 0,
                modifier: 2,
                slideShadows: true,
                scale: 1,
              },*/
        });
    }    

}, false);
