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

        // Main Swiper
        // Initialize Thumbnail Swiper
        var thumbnailsSwiper = new Swiper(".swiper-thumbnails", {
            slidesPerView: 2,
            //spaceBetween: 28,
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    //spaceBetween: 16,
                },
                1024: {
                    slidesPerView: 3.4,
                    //spaceBetween: 24,
                },
                1600: {
                    slidesPerView: 4.4,
                    //spaceBetween: 24,
                },
            },
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            slideToClickedSlide: true, // Make thumbnails clickable
        });

        // Initialize Main Swiper
        var highlightsSwiper = new Swiper(".highlights-swiper", {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: thumbnailsSwiper, // Link thumbnails to main swiper
            },
            speed: 800,
        });

        // Add Event Listener to Ensure Thumbnails Work Properly
        thumbnailsSwiper.on("click", function (swiper) {
            const clickedIndex = swiper.clickedIndex;
            if (typeof clickedIndex !== "undefined" && clickedIndex !== null) {
                highlightsSwiper.slideTo(clickedIndex); // Change the main slider to the clicked thumbnail
            }
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

    if (document.body.classList.contains("unser-highlight-template-default-alternative")) {
        
        // Thumbnail slider
        const thumbnailSlider = new Swiper('.thumbnail-slider', {
            slidesPerView: 2,
            slidesPerGroup: 6,
            grid: {
                rows: 3, // Number of rows
                fill: 'row', // Fills rows horizontally (default)
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            watchSlidesProgress: true,
        });

        // Main slider
        const mainSlider = new Swiper('.highlights-slider', {
            slidesPerView: 1,
            spaceBetween: 10,
            effect: 'fade',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: thumbnailSlider,
            },
        });

    }
    
    if (document.body.classList.contains("unser-highlight-template-default")) {
        const mainSlider = new Swiper('.highlights-slider', {
            slidesPerView: 1,
            spaceBetween: 10,
            effect: 'fade',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                slideChange: function () {
                    // Update the active thumbnail on slide change
                    updateActiveThumbnail(mainSlider.activeIndex);
                },
            },
        });
    
        const thumbnailsContainer = document.querySelector('.thumbnails-container'); // Thumbnail container
        const thumbnails = document.querySelectorAll('.swiper-slide-thumbnail img');
    
        // Add click event to thumbnails
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                mainSlider.slideTo(index); // Navigate to the corresponding slide
            });
        });
    
        // Function to update the active thumbnail and scroll into view
        function updateActiveThumbnail(activeIndex) {
            thumbnails.forEach((thumbnail, index) => {
                // Add 'active' class to the current thumbnail and remove from others
                if (index === activeIndex) {
                    thumbnail.classList.add('active');
                    thumbnail.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center',
                    });
                } else {
                    thumbnail.classList.remove('active');
                }
            });
        }
    
        // Prevent page scrolling when interacting with the thumbnails container
        thumbnailsContainer.addEventListener('wheel', (event) => {
            event.preventDefault(); // Stop the page from scrolling
            thumbnailsContainer.scrollBy({
                top: 0,
                left: event.deltaY, // Horizontal scroll only
                behavior: 'smooth',
            });
        });
    
        // Set the initial active thumbnail
        updateActiveThumbnail(mainSlider.activeIndex);
    }
    
    
    

}, false);
