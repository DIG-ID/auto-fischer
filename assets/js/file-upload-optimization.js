document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input[type="file"]'); // Multiple file inputs
    const maxTotalSize = 10 * 1024 * 1024;

    fileInputs.forEach(function (fileInput) {
        fileInput.addEventListener('change', function (event) {
            const feedbackElement = document.querySelector(`#${fileInput.id}-feedback`);
            const progressBar = document.querySelector(`#progress-bar-${fileInput.id}`);
            const progressText = document.querySelector(`#progress-text-${fileInput.id}`);
            const progressContainer = document.querySelector(`#progress-container-${fileInput.id}`);

            const files = event.target.files;
            let totalProcessedSize = 0; // Track total size of processed files

            feedbackElement.textContent = '';
            progressBar.style.width = '0%';
            progressText.textContent = '0%';
            progressContainer.style.opacity = 0;

            const processedFiles = []; // To store processed files

            Array.from(files).forEach((file, index) => {
                if (file.type.includes('image')) {
                    const reader = new FileReader();

                    reader.onload = function () {
                        const img = new Image();
                        img.onload = function () {
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');
                            const maxWidth = 720,
                                maxHeight = 480;
                            let width = img.width,
                                height = img.height;

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

                            canvas.toBlob(
                                function (blob) {
                                    if (!blob) return;

                                    const processedSize = blob.size;

                                    // Update total size
                                    totalProcessedSize += processedSize;

                                    if (totalProcessedSize > maxTotalSize) {
                                        feedbackElement.textContent =
                                            'The total size of all uploaded files exceeds 5MB.';
                                        feedbackElement.style.color = 'red';
                                        progressBar.style.width = '0%';
                                        progressText.textContent = '0%';
                                        return;
                                    }

                                    // Add processed file
                                    processedFiles.push(
                                        new File([blob], file.name, { type: file.type })
                                    );

                                    // Update progress bar
                                    const progress =
                                        Math.min((processedFiles.length / files.length) * 100, 100);
                                    progressBar.style.width = `${progress}%`;
                                    progressText.textContent = `${Math.round(progress)}%`;

                                    // Show progress bar when process starts
                                    if (progressContainer.style.opacity === '0') {
                                        progressContainer.style.opacity = '1';
                                    }

                                    // Replace original input files with processed files when done
                                    if (processedFiles.length === files.length) {
                                        const dataTransfer = new DataTransfer();
                                        processedFiles.forEach((processedFile) =>
                                            dataTransfer.items.add(processedFile)
                                        );
                                        fileInput.files = dataTransfer.files;
                                        feedbackElement.textContent =
                                            'All files successfully processed!';
                                        feedbackElement.style.color = 'green';
                                    }
                                },
                                file.type,
                                0.85
                            );
                        };
                        img.src = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    feedbackElement.textContent = 'Only image files are allowed.';
                    feedbackElement.style.color = 'red';
                }
            });
        });
    });
});
