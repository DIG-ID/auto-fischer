document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input[type="file"]'); // Multiple file inputs

    fileInputs.forEach(function (fileInput) {
        fileInput.addEventListener('change', function (event) {
            const fileId = fileInput.id; // Get the file input's ID
            const feedbackElement = document.querySelector(`#${fileId}-feedback`);
            const progressContainer = document.querySelector(`#progress-container-${fileId}`);
            const progressBar = document.querySelector(`#progress-bar-${fileId}`);
            const progressText = document.querySelector(`#progress-text-${fileId}`);
            const files = event.target.files;

            // Show the progress container with fade-in effect
            progressContainer.style.display = 'block';
            progressContainer.style.opacity = 0;  // Start with 0 opacity for fade effect
            setTimeout(() => {
                progressContainer.style.transition = 'opacity 0.5s ease';  // Smooth fade-in
                progressContainer.style.opacity = 1; // Fade to 100% opacity
            }, 50);

            // Reset progress bar and feedback text
            progressBar.style.width = '0%';  // Reset the progress bar
            progressText.textContent = '0%';  // Set the progress text to 0%
            feedbackElement.textContent = '';  // Clear previous feedback
            feedbackElement.style.color = ''; // Clear feedback text color

            Array.from(files).forEach((file) => {
                if (file.type.includes('image')) {
                    // Resize and compress the image
                    const reader = new FileReader();
                    reader.onload = function () {
                        const img = new Image();
                        img.onload = function () {
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');
                            const maxWidth = 330, maxHeight = 300;
                            let width = img.width, height = img.height;

                            // Calculate resizing proportions
                            if (width > height && width > maxWidth) {
                                height = Math.round(height * (maxWidth / width));
                                width = maxWidth;
                            } else if (height > maxHeight) {
                                width = Math.round(width * (maxHeight / height));
                                height = maxHeight;
                            }

                            canvas.width = width;
                            canvas.height = height;
                            ctx.drawImage(img, 0, 0, width, height);

                            // Simulate progress updates
                            let progress = 0;
                            const progressInterval = setInterval(function () {
                                progress += 10; // Simulate progress steps
                                progressBar.style.width = progress + '%';
                                progressText.textContent = `${progress}%`;

                                if (progress >= 100) {
                                    clearInterval(progressInterval);
                                    feedbackElement.textContent = 'File optimized successfully!';
                                    feedbackElement.style.color = 'green';
                                }
                            }, 100); // Update every 100ms

                            canvas.toBlob(function (blob) {
                                const optimizedFile = new File([blob], file.name, { type: file.type });
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(optimizedFile);
                                fileInput.files = dataTransfer.files;

                            }, file.type, 0.85);
                        };
                        img.src = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Handle error case
                    feedbackElement.textContent = 'Only images allowed.';
                    feedbackElement.style.color = 'red';
                    clearInterval(progressInterval);  // Stop the progress bar update
                }
            });
        });
    });
});
