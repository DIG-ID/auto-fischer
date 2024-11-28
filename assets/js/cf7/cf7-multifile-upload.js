document.addEventListener("DOMContentLoaded", () => {
  const multifileWrappers = document.querySelectorAll(".cf7-multifile-wrapper");

  multifileWrappers.forEach((wrapper) => {
      const dropzone = wrapper.querySelector(".cf7-multifile-dropzone");
      const previewsContainer = wrapper.querySelector(".cf7-multifile-previews");
      const addButton = wrapper.querySelector(".cf7-multifile-add-button");
      const hiddenInput = wrapper.querySelector("input[type='file']");

      const maxTotalSize = parseFileSize(wrapper.dataset.totalLimit);
      const maxFileSize = parseFileSize(wrapper.dataset.fileLimit);
      const allowedTypes = wrapper.dataset.filetypes.split("|");
      const maxFiles = parseInt(wrapper.dataset.max, 10) || 10;
      const minFiles = parseInt(wrapper.dataset.min, 10) || 1;
      const resizeWidth = parseInt(wrapper.dataset.width, 10) || null;
      const resizeHeight = parseInt(wrapper.dataset.height, 10) || null;

      let fileCollection = []; // Store optimized files
      let totalFileSize = 0;

      // Add button click
      addButton.addEventListener("click", () => hiddenInput.click());

      // File input change
      hiddenInput.addEventListener("change", (event) => handleFiles(Array.from(event.target.files)));

      // Drag and drop functionality
      ["dragover", "dragenter"].forEach((event) => {
          dropzone.addEventListener(event, (e) => {
              e.preventDefault();
              dropzone.classList.add("dragging");
          });
      });

      ["dragleave", "drop"].forEach((event) => {
          dropzone.addEventListener(event, (e) => {
              e.preventDefault();
              dropzone.classList.remove("dragging");
              if (event === "drop") handleFiles(Array.from(e.dataTransfer.files));
          });
      });

      // Handle files
      function handleFiles(files) {
          files.forEach((file) => {
              const fileType = file.type.split("/")[1].toLowerCase();
              if (!allowedTypes.includes(fileType)) {
                  alert(`File type not allowed: ${fileType}`);
                  return;
              }

              if (file.size > maxFileSize) {
                  alert(`File size exceeds limit: ${formatFileSize(file.size)} (Max: ${formatFileSize(maxFileSize)})`);
                  return;
              }

              if (fileCollection.find((f) => f.name === file.name)) {
                  alert(`Duplicate file: ${file.name}`);
                  return;
              }

              if (fileCollection.length >= maxFiles) {
                  alert(`Maximum number of files (${maxFiles}) reached.`);
                  return;
              }

              // Resize and optimize
              resizeAndOptimizeImage(file, (optimizedFile) => {
                  fileCollection.push(optimizedFile);
                  totalFileSize += optimizedFile.size;

                  if (totalFileSize > maxTotalSize) {
                      alert(`Total file size exceeds limit: ${formatFileSize(totalFileSize)} (Max: ${formatFileSize(maxTotalSize)})`);
                      fileCollection.pop(); // Remove the last file
                      totalFileSize -= optimizedFile.size;
                      return;
                  }

                  addPreview(optimizedFile);
                  updateHiddenInput();
              });
          });
      }

      // Resize and optimize images
      function resizeAndOptimizeImage(file, callback) {
          const reader = new FileReader();
          reader.onload = (e) => {
              const img = new Image();
              img.onload = () => {
                  const canvas = document.createElement("canvas");
                  const ctx = canvas.getContext("2d");
                  let { width, height } = img;

                  if (resizeWidth && resizeHeight) {
                      const scale = Math.min(resizeWidth / width, resizeHeight / height);
                      width = Math.round(width * scale);
                      height = Math.round(height * scale);
                  }

                  canvas.width = width;
                  canvas.height = height;
                  ctx.drawImage(img, 0, 0, width, height);

                  canvas.toBlob(
                      (blob) => {
                          if (!blob) return;
                          callback(new File([blob], file.name, { type: file.type }));
                      },
                      file.type,
                      0.85 // Quality for compression
                  );
              };
              img.src = e.target.result;
          };
          reader.readAsDataURL(file);
      }

      // Add preview
      function addPreview(file) {
          const previewSlot = document.createElement("div");
          previewSlot.classList.add("cf7-multifile-preview");

          const img = document.createElement("img");
          img.src = URL.createObjectURL(file);
          img.alt = "Preview";
          img.classList.add("preview-image");

          const deleteButton = document.createElement("button");
          deleteButton.classList.add("delete-button");
          deleteButton.innerHTML = "&times;";
          deleteButton.addEventListener("click", () => {
              fileCollection = fileCollection.filter((f) => f !== file);
              totalFileSize -= file.size;
              previewsContainer.removeChild(previewSlot);
              updateHiddenInput();
          });

          previewSlot.appendChild(img);
          previewSlot.appendChild(deleteButton);
          previewsContainer.appendChild(previewSlot);
      }

      // Update hidden input field
      function updateHiddenInput() {
          const dataTransfer = new DataTransfer();
          fileCollection.forEach((file) => dataTransfer.items.add(file));
          hiddenInput.files = dataTransfer.files;
      }
  });

  // Parse file size (e.g., "10mb" -> bytes)
  function parseFileSize(size) {
      const units = { b: 1, kb: 1024, mb: 1024 ** 2, gb: 1024 ** 3 };
      const match = size.match(/^(\d+)(b|kb|mb|gb)$/i);
      return match ? parseInt(match[1], 10) * units[match[2].toLowerCase()] : 0;
  }

  // Format file size (e.g., 1048576 -> "1 MB")
  function formatFileSize(bytes) {
      if (bytes < 1024) return `${bytes} B`;
      if (bytes < 1024 ** 2) return `${(bytes / 1024).toFixed(2)} KB`;
      if (bytes < 1024 ** 3) return `${(bytes / 1024 ** 2).toFixed(2)} MB`;
      return `${(bytes / 1024 ** 3).toFixed(2)} GB`;
  }
});
