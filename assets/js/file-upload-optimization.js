document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input[type="file"]'); // Multiple file inputs

    fileInputs.forEach(function (fileInput) {
        fileInput.addEventListener('change', function (event) {
            const feedbackElement = document.querySelector(`#${fileInput.id}-feedback`);
            const progressBar = document.querySelector(`#progress-bar-${fileInput.id}`);
            const progressText = document.querySelector(`#progress-text-${fileInput.id}`);
            const progressContainer = document.querySelector(`#progress-container-${fileInput.id}`);
            const files = event.target.files;

            // Show progress bar with fade-in effect
            progressContainer.style.display = 'block';
            progressContainer.style.opacity = '0';
            setTimeout(() => {
                progressContainer.style.opacity = '1';
            }, 100);

            // Process each file
            Array.from(files).forEach((file, index) => {
                if (file.type.includes('image')) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        const img = new Image();
                        img.onload = function () {
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');
                            const maxWidth = 330, maxHeight = 300;
                            let width = img.width, height = img.height;

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

                            // Updating progress (just for simulation, you can adjust as per actual image processing)
                            let progress = 0;
                            const interval = setInterval(() => {
                                if (progress < 90) {
                                    progress += 5;
                                    progressBar.style.width = `${progress}%`;
                                    progressText.textContent = `${progress}%`;
                                } else {
                                    clearInterval(interval);
                                    progressBar.style.width = '100%';
                                    progressText.textContent = '100%';
                                    canvas.toBlob(function (blob) {
                                        const optimizedFile = new File([blob], file.name, { type: file.type });
                                        const dataTransfer = new DataTransfer();
                                        dataTransfer.items.add(optimizedFile);
                                        fileInput.files = dataTransfer.files;

                                        feedbackElement.textContent = 'File optimized successfully!';
                                        feedbackElement.style.color = 'green';
                                    }, file.type, 0.85);
                                }
                            }, 100);
                        };
                        img.src = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    feedbackElement.textContent = 'Only images allowed.';
                    feedbackElement.style.color = 'red';
                    progressContainer.style.display = 'none';
                }
            });
        });
    });
});
