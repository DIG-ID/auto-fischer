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
    const fileInput = document.querySelector('input[name="your-image-file"]');
    console.log("File input:", fileInput); // Check if it's correctly selected

    const previewSlots = [
        document.getElementById('preview-slot-1'),
        document.getElementById('preview-slot-2'),
        document.getElementById('preview-slot-3')
    ];

    fileInput.addEventListener('change', function() {
        console.log("File input changed, files:", fileInput.files); // Log the selected files

        // Convert FileList to an array
        const files = Array.from(fileInput.files).slice(0, 3); // Limit to 3 images

        files.forEach(file => {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.alt = "Uploaded Image";
                    img.classList.add("max-w-full", "h-auto", "rounded", "border", "shadow-lg"); // Optional styling classes
                    
                    // Find the first available slot to display the image
                    for (let i = 0; i < previewSlots.length; i++) {
                        if (!previewSlots[i].innerHTML) { // Check if the slot is empty
                            previewSlots[i].innerHTML = ""; // Clear any existing image (optional, but it shouldn't matter here)
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
});



</script>
