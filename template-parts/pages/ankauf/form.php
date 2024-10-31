<section class="section-faq py-20 pb-40 relative overflow-hidden">
    <div class="theme-container">
        <?php 
        $form_shortcode = get_field('form_shortcode'); 
        if ($form_shortcode) {
            echo do_shortcode($form_shortcode); 
        }
        ?>
    </div>
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
                document.getElementById('preview-slot-3')
            ]
        },
        {
            input: document.querySelector('input[name="file-auto-innen"]'),
            previewSlots: [
                document.getElementById('preview-slot-1-innen'),
                document.getElementById('preview-slot-2-innen'),
                document.getElementById('preview-slot-3-innen')
            ]
        }
    ];

    fileInputs.forEach(({ input, previewSlots }) => {
        if (input) {
            input.addEventListener('change', function() {
                // Convert FileList to an array and limit to 3 images
                const files = Array.from(input.files).slice(0, 3);

                files.forEach(file => {
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.alt = "Uploaded Image";
                            img.classList.add("max-w-full", "h-auto", "rounded", "border", "shadow-lg");

                            // Find the first available slot to display the image
                            for (let i = 0; i < previewSlots.length; i++) {
                                if (!previewSlots[i].innerHTML) { // Check if the slot is empty
                                    previewSlots[i].innerHTML = ""; // Clear any existing content
                                    previewSlots[i].appendChild(img); // Display the new image in the available slot
                                    break; // Exit the loop after placing the image
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
