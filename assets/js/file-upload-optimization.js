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
            imageCount: 0, // Counter for this input field
            dataTransfer: new DataTransfer() // Tracks appended files
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
            imageCount: 0,
            dataTransfer: new DataTransfer()
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
            imageCount: 0,
            dataTransfer: new DataTransfer()
        }
    ];

    fileInputs.forEach(({ input, previewSlots, maxTotalSize, minImages, maxImages, feedbackElement, progressBar, progressText, progressContainer, imageCount, dataTransfer }) => {
        if (input) {
            input.addEventListener('change', function (event) {
                const newFiles = Array.from(input.files);
                let totalProcessedSize = Array.from(dataTransfer.files).reduce((sum, file) => sum + file.size, 0);

                feedbackElement.textContent = '';
                progressBar.style.width = '0%';
                progressText.textContent = '0%';
                progressContainer.style.opacity = 0;

                newFiles.forEach((file) => {
                    if (file.type === 'image/jpeg' || file.type === 'image/png') {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = new Image();
                            img.onload = function () {
                                const canvas = document.createElement('canvas');
                                const ctx = canvas.getContext('2d');
                                const maxWidth = 720, maxHeight = 480;
                                let width = img.width, height = img.height;

                                if (width > maxWidth || height > maxHeight) {
                                    const ratio = Math.min(maxWidth / width, maxHeight / height);
                                    width = Math.round(width * ratio);
                                    height = Math.round(height * ratio);
                                }
                                canvas.width = width;
                                canvas.height = height;
                                ctx.drawImage(img, 0, 0, width, height);

                                canvas.toBlob(function (blob) {
                                    if (!blob) return;

                                    const processedSize = blob.size;
                                    totalProcessedSize += processedSize;

                                    if (totalProcessedSize > maxTotalSize) {
                                        feedbackElement.textContent = 'The total size of images exceeds the allowed limit.';
                                        feedbackElement.style.color = 'red';
                                        return;
                                    }

                                    dataTransfer.items.add(new File([blob], file.name, { type: file.type }));

                                    addPreview(blob, previewSlots, imageCount, maxImages, progressBar, progressText, dataTransfer.files.length);
                                    imageCount++;

                                    input.files = dataTransfer.files;

                                    const progress = Math.min((imageCount / maxImages) * 100, 100);
                                    progressBar.style.width = `${progress}%`;
                                    progressText.textContent = `${Math.round(progress)}%`;

                                    if (progressContainer.style.opacity === '0') {
                                        progressContainer.style.opacity = '1';
                                    }

                                    feedbackElement.textContent = `Uploading ${imageCount} of ${maxImages} images...`;
                                }, file.type, 0.85);
                            };
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        feedbackElement.textContent = 'Please upload only image files (JPG, PNG).';
                        feedbackElement.style.color = 'red';
                    }
                });
            });
        }
    });

    // Helper function to add preview and remove option
    function addPreview(blob, previewSlots, index, maxImages, progressBar, progressText, filesLength) {
        const previewSlot = previewSlots[index];
        if (!previewSlot) return;

        const img = document.createElement('img');
        const deleteIcon = document.createElement('img');

        img.src = URL.createObjectURL(blob);
        img.alt = 'Preview Image';
        img.classList.add('max-w-full', 'h-auto', 'rounded', 'border', 'shadow-lg');

        deleteIcon.src = '/wp-content/themes/auto-fischer/assets/images/delete.svg';
        deleteIcon.alt = 'Delete Image';
        deleteIcon.classList.add('cursor-pointer', 'absolute', 'top-0', 'right-0');
        deleteIcon.addEventListener('click', () => {
            previewSlot.innerHTML = ''; // Clear slot
            previewSlot.classList.add('hidden');
        });

        previewSlot.appendChild(img);
        previewSlot.appendChild(deleteIcon);
        previewSlot.classList.remove('hidden');
        previewSlot.classList.add('flex');
    }
});
