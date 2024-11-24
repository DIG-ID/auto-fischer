// wait until DOM is ready
document.addEventListener("DOMContentLoaded", () => {
	//wait until images, links, fonts, stylesheets, and js is loaded
	window.addEventListener("load", () => {

        if (document.body.classList.contains("page-template-page-gut-zu-wissen")) {
            const faqQuestions = document.querySelectorAll('.faq-question');
        
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('.icon-plus');
                    const isOpen = answer.classList.contains('open');
                    
                    // Close all other answers
                    document.querySelectorAll('.faq-answer').forEach(el => {
                        el.classList.remove('open');
                        el.previousElementSibling.classList.add('q-closed');
                    });
                    document.querySelectorAll('.icon-plus').forEach(icon => icon.textContent = '+');
        
                    // Toggle the current answer
                    if (!isOpen) {
                        question.classList.remove('q-closed');
                        answer.classList.add('open');
                        icon.textContent = '-';
                    } else {
                        question.classList.add('q-closed');
                        answer.classList.remove('open');
                        icon.textContent = '+';
                    }
                });
            });
        }

        // Accordion in Car Highlights
        if (document.body.classList.contains("unser-highlight-template-default")) {
            const faqQuestions = document.querySelectorAll('.specs-title');
        
            faqQuestions.forEach(question => {
                const answer = question.nextElementSibling;
                const icon = question.querySelector('.icon-plus img'); // Select the <img> inside .icon-plus
        
                // Ensure pre-opened state respects max-height
                if (answer.classList.contains('open')) {
                    answer.style.maxHeight = answer.scrollHeight + 'px'; // Set max-height to its content height
                }
        
                question.addEventListener('click', function () {
                    const isOpen = answer.classList.contains('open');
        
                    // Close all other answers
                    document.querySelectorAll('.specs-text').forEach(el => {
                        if (el !== answer) {
                            el.style.maxHeight = el.scrollHeight + 'px'; // Set current height for smooth transition
                            setTimeout(() => (el.style.maxHeight = '0px'), 10); // Trigger transition to 0
                            el.classList.remove('open');
                            el.previousElementSibling.classList.add('q-closed');
                        }
                    });
        
                    document.querySelectorAll('.icon-plus img').forEach(img => {
                        if (img !== icon) {
                            img.src = '/wp-content/themes/auto-fischer/assets/images/arrow-down-sign.svg';
                        }
                    });
        
                    // Toggle the current answer
                    if (!isOpen) {
                        question.classList.remove('q-closed');
                        answer.classList.add('open');
                        icon.src = '/wp-content/themes/auto-fischer/assets/images/arrow-up-sign.svg';
        
                        // Dynamically set max-height for smooth opening
                        answer.style.maxHeight = answer.scrollHeight + 'px';
        
                        // Optional: Reset to fit-content after animation
                        setTimeout(() => {
                            answer.style.maxHeight = 'fit-content';
                        }, 500); // Match transition duration in your CSS
                    } else {
                        question.classList.add('q-closed');
                        answer.classList.remove('open');
                        icon.src = '/wp-content/themes/auto-fischer/assets/images/arrow-down-sign.svg';
        
                        // Set max-height to current height before transitioning to 0
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        setTimeout(() => (answer.style.maxHeight = '0px'), 10); // Smoothly transition to 0
                    }
                });
            });
        }
        
         
        

        if (document.body.classList.contains("page-template-page-ankauf")) {
            // Configuration for each file input and its corresponding preview slots
            const fileInputs = [
                {
                    input: document.querySelector('input[name="your-image-file"]'),
                    previewSlots: [
                        document.getElementById('preview-slot-1'),
                        document.getElementById('preview-slot-2'),
                        document.getElementById('preview-slot-3'),
                        document.getElementById('preview-slot-4'),
                        document.getElementById('preview-slot-5'),
                        document.getElementById('preview-slot-6'),
                        document.getElementById('preview-slot-7'),
                        document.getElementById('preview-slot-8'),
                        document.getElementById('preview-slot-9'),
                        document.getElementById('preview-slot-10')
                    ]
                },
                {
                    input: document.querySelector('input[name="file-auto-innen"]'),
                    previewSlots: [
                        document.getElementById('preview-slot-1-innen'),
                        document.getElementById('preview-slot-2-innen'),
                        document.getElementById('preview-slot-3-innen'),
                        document.getElementById('preview-slot-4-innen'),
                        document.getElementById('preview-slot-5-innen'),
                        document.getElementById('preview-slot-6-innen'),
                        document.getElementById('preview-slot-7-innen'),
                        document.getElementById('preview-slot-8-innen'),
                        document.getElementById('preview-slot-9-innen'),
                        document.getElementById('preview-slot-10-innen')
                    ]
                },
                {
                    input: document.querySelector('input[name="file-fahrzeugausweis"]'),
                    previewSlots: [
                        document.getElementById('preview-slot-1-fahrzeugausweis'),
                        document.getElementById('preview-slot-2-fahrzeugausweis'),
                        document.getElementById('preview-slot-3-fahrzeugausweis')
                    ]
                }
            ];

            fileInputs.forEach(({ input, previewSlots }) => {
                if (input) {
                    input.addEventListener('change', function() {
                        // Convert FileList to an array and limit to 10 images
                        const files = Array.from(input.files).slice(0, 10);

                        files.forEach(file => {
                            if (file && file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    // Find the first available slot to display the image and delete icon
                                    for (let i = 0; i < previewSlots.length; i++) {
                                        if (!previewSlots[i].innerHTML) {
                                            previewSlots[i].innerHTML = ""; // Clear any existing content

                                            // Create image preview element
                                            const img = document.createElement('img');
                                            img.src = event.target.result;
                                            img.alt = "Uploaded Image";
                                            img.classList.add("max-w-full", "h-auto", "rounded", "border", "shadow-lg");

                                            // Create delete icon element
                                            const deleteIcon = document.createElement('img');
                                            deleteIcon.src = '/wp-content/themes/auto-fischer/assets/images/delete.svg';
                                            deleteIcon.alt = "Delete Image";
                                            deleteIcon.classList.add("absolute", "top-1/2", "left-1/2", "transform", "-translate-x-1/2", "-translate-y-1/2", "cursor-pointer");

                                            // Add click event for delete functionality
                                            deleteIcon.addEventListener('click', () => {
                                                previewSlots[i].innerHTML = ""; // Clear the slot
                                                previewSlots[i].classList.add('hidden'); // Hide slot after deletion
                                            });

                                            // Append image and delete icon to the preview slot
                                            previewSlots[i].appendChild(img); // Add image to slot
                                            previewSlots[i].appendChild(deleteIcon); // Add delete icon to slot
                                            previewSlots[i].classList.remove('hidden'); // Make slot visible
                                            previewSlots[i].classList.add('flex'); // Set display to flex for slot
                                            break; // Exit loop after placing image
                                        }
                                    }
                                };
                                reader.readAsDataURL(file);
                            } else {
                                console.warn("Selected file is not an image or is invalid.");
                            }
                        });
                    });
                } else {
                    console.warn("File input not found for selector.");
                }
            });
        }

    }, false);
});