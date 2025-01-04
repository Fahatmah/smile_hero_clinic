function updatePageImage(image) {
  const imageInput = document.getElementById(image)
  const imagePreview = document.getElementById('image-preview')
  const errorMessage = document.getElementById('error-message')
  const updateBtn = document.getElementById('updateBtn')

  // Event listener for when a file is selected
  imageInput.addEventListener('change', () => {
    const file = imageInput.files[0] // Get the selected file
    errorMessage.style.display = 'none' // Reset error message

    // Check if a file is selected and is an image
    if (file) {
      if (file.size > 2 * 1024 * 1024) {
        // Check file size (2MB)
        errorMessage.textContent = 'File must be less than 2MB'
        errorMessage.style.display = 'block'
        imageInput.value = '' // Reset the file input
        imagePreview.innerHTML = `<p>No image uploaded</p>`
        return
      }

      if (file.type.startsWith('image/')) {
        const reader = new FileReader()

        // When the file is loaded, set it as the preview image
        reader.onload = function (e) {
          imagePreview.innerHTML = `<img src="${e.target.result}" alt="Selected Image" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 5px;" />`
        }

        reader.readAsDataURL(file) // Read the file as a data URL
      } else {
        imagePreview.innerHTML = `<p>No image uploaded</p>`
      }
    }
  })
}
