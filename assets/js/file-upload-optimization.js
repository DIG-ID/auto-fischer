document.addEventListener('DOMContentLoaded', function () {
    const maxTotalSizeInput1 = 10 * 1024 * 1024; // 10MB
    const maxTotalSizeInput2 = 10 * 1024 * 1024; // 10MB
    const maxTotalSizeInput3 = 5 * 1024 * 1024;  // 5MB
    const minImagesInput1 = 2, maxImagesInput1 = 10;
    const minImagesInput2 = 2, maxImagesInput2 = 10;
    const minImagesInput3 = 1, maxImagesInput3 = 5;

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
            ],
            maxTotalSize: maxTotalSizeInput1,
            minImages: minImagesInput1,
            maxImages: maxImagesInput1,
            feedbackElement: document.querySelector('#your-image-file-feedback'),
            progressBar: document.querySelector('#progress-bar-your-image-file'),
            progressText: document.querySelector('#progress-text-your-image-file'),
            progressContainer: document.querySelector('#progress-container-your-image-file'),
            imageCount: 0  // Counter for this input field
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
            ],
            maxTotalSize: maxTotalSizeInput2,
            minImages: minImagesInput2,
            maxImages: maxImagesInput2,
            feedbackElement: document.querySelector('#file-auto-innen-feedback'),
            progressBar: document.querySelector('#progress-bar-file-auto-innen'),
            progressText: document.querySelector('#progress-text-file-auto-innen'),
            progressContainer: document.querySelector('#progress-container-file-auto-innen'),
            imageCount: 0  // Counter for this input field
        },
        {
            input: document.querySelector('input[name="file-fahrzeugausweis"]'),
            previewSlots: [
                document.getElementById('preview-slot-1-fahrzeugausweis'),
                document.getElementById('preview-slot-2-fahrzeugausweis'),
                document.getElementById('preview-slot-3-fahrzeugausweis')
            ],
            maxTotalSize: maxTotalSizeInput3,
            minImages: minImagesInput3,
            maxImages: maxImagesInput3,
            feedbackElement: document.querySelector('#file-fahrzeugausweis-feedback'),
            progressBar: document.querySelector('#progress-bar-file-fahrzeugausweis'),
            progressText: document.querySelector('#progress-text-file-fahrzeugausweis'),
            progressContainer: document.querySelector('#progress-container-file-fahrzeugausweis'),
            imageCount: 0  // Counter for this input field
        }
    ];

    fileInputs.forEach(({ input, previewSlots, maxTotalSize, minImages, maxImages, feedbackElement, progressBar, progressText, progressContainer, imageCount }) => {
        if (input) {
            input.addEventListener('change', function (event) {
                const files = Array.from(input.files);
                let totalProcessedSize = 0;
                let processedFiles = [];

                feedbackElement.textContent = '';
                progressBar.style.width = '0%';
                progressText.textContent = '0%';
                progressContainer.style.opacity = 0;

                // Check for valid file types, resolution, and size
                files.forEach((file) => {
                    if (file.type === 'image/jpeg' || file.type === 'image/png') {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = new Image();
                            img.onload = function () {
                                const canvas = document.createElement('canvas');
                                const ctx = canvas.getContext('2d');
                                const maxWidth = 720, maxHeight = 480;
                                let width = img.width, height = img.height;

                                // Resize image if necessary
                                if (width > maxWidth || height > maxHeight) {
                                    const ratio = Math.min(maxWidth / width, maxHeight / height);
                                    width = Math.round(width * ratio);
                                    height = Math.round(height * ratio);
                                }
                                canvas.width = width;
                                canvas.height = height;
                                ctx.drawImage(img, 0, 0, width, height);

                                // Convert image to blob
                                canvas.toBlob(function (blob) {
                                    if (!blob) return;

                                    const processedSize = blob.size;
                                    totalProcessedSize += processedSize;

                                    // Check total size
                                    if (totalProcessedSize > maxTotalSize) {
                                        feedbackElement.textContent = 'A soma do tamanho das imagens excedeu o limite permitido.';
                                        feedbackElement.style.color = 'red';
                                        progressBar.style.width = '0%';
                                        progressText.textContent = '0%';
                                        return;
                                    }

                                    processedFiles.push(new File([blob], file.name, { type: file.type }));

                                    // Add preview for each image
                                    if (imageCount < maxImages) {
                                        addPreview(blob, previewSlots, imageCount, maxImages, progressBar, progressText, files.length);
                                        imageCount++; // Increment image count for this field
                                    }

                                    // Create a new DataTransfer object
                                    const dataTransfer = new DataTransfer();

                                    // Add the existing files from the input (preserving old files)
                                    for (let i = 0; i < input.files.length; i++) {
                                        dataTransfer.items.add(input.files[i]);
                                    }

                                    // Add the new processed files
                                    processedFiles.forEach(file => {
                                        dataTransfer.items.add(file);
                                    });

                                    // Update the file input with the new list of files
                                    input.files = dataTransfer.files;

                                    // Update progress bar
                                    const progress = Math.min((imageCount / files.length) * 100, 100);
                                    progressBar.style.width = `${progress}%`;
                                    progressText.textContent = `${Math.round(progress)}%`;

                                    // Show progress bar
                                    if (progressContainer.style.opacity === '0') {
                                        progressContainer.style.opacity = '1';
                                    }

                                    // Handle success or error messages for number of images
                                    feedbackElement.textContent = `Carregando ${imageCount} de ${maxImages} imagens...`;
                                }, file.type, 0.85);
                            };
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        feedbackElement.textContent = 'Por favor, adicione apenas arquivos de imagem (JPG, PNG).';
                        feedbackElement.style.color = 'red';
                    }
                });
            });
        }
    });

    // Helper function to add preview and remove option
    function addPreview(blob, previewSlots, index, imageCount, progressBar, progressText, filesLength) {
        const previewSlot = previewSlots[index];
        if (!previewSlot) return;

        const img = document.createElement('img');
        const deleteIcon = document.createElement('img');

        // Create preview image
        img.src = URL.createObjectURL(blob);
        img.alt = 'Preview Image';
        img.classList.add('max-w-full', 'h-auto', 'rounded', 'border', 'shadow-lg');

        // Create delete icon
        deleteIcon.src = '/wp-content/themes/auto-fischer/assets/images/delete.svg';
        deleteIcon.alt = 'Delete Image';
        deleteIcon.classList.add('cursor-pointer', 'absolute', 'top-0', 'right-0');
        deleteIcon.addEventListener('click', () => {
            // Decrease image count and handle the file removal
            imageCount--;

            // Update progress bar after deletion
            const progress = Math.min((imageCount / filesLength) * 100, 100);
            progressBar.style.width = `${progress}%`;
            progressText.textContent = `${Math.round(progress)}%`;

            // Hide preview
            previewSlot.classList.add('hidden');
            previewSlot.innerHTML = ''; // Clear content
        });

        // Append preview and delete icon
        previewSlot.appendChild(img);
        previewSlot.appendChild(deleteIcon);
        previewSlot.classList.remove('hidden');
        previewSlot.classList.add('flex');
    }
});
