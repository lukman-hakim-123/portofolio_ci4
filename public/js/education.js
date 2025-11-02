function previewLogo(event) {
    const preview = document.getElementById('logo-preview');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => preview.src = e.target.result;
        reader.readAsDataURL(file);
    }
}