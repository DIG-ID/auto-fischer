<section class="section-faq py-20 pb-40 relative overflow-hidden">
    <div class="theme-container">
        <?php 
        $form_shortcode = get_field('form_shortcode'); 
        if ($form_shortcode) {
            echo do_shortcode($form_shortcode); 
        }
        ?>
    </div>
    <div class="hidden flex-wrap gap-4 mt-5"></div>
    <div class="hidden mt-3"></div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
                            // Create image preview element
                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.alt = "Uploaded Image";
                            img.classList.add("max-w-full", "h-auto", "rounded", "border", "shadow-lg");

                            // Create delete icon element
                            const deleteIcon = document.createElement('img');
                            deleteIcon.src = '/wp-content/themes/auto-fischer/assets/images/delete.svg'; // Replace with the path to your SVG
                            deleteIcon.alt = "Delete Image";
                            deleteIcon.classList.add("absolute", "top-1/2", "left-1/2", "transform", "-translate-x-1/2", "-translate-y-1/2", "cursor-pointer");

                            // Add click event for delete functionality
                            deleteIcon.addEventListener('click', () => {
                                previewSlots[i].innerHTML = ""; // Clear the slot
                                previewSlots[i].classList.add('hidden'); // Hide slot after deletion
                            });

                            // Find the first available slot to display the image and delete icon
                            for (let i = 0; i < previewSlots.length; i++) {
                                if (!previewSlots[i].innerHTML) {
                                    previewSlots[i].innerHTML = ""; // Clear any existing content
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
});

</script>
