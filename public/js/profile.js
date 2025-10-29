document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    // Validasi ekstensi/tipe file
    if (!file.type.startsWith('image/')) {
        alert('Hanya file gambar yang diperbolehkan!');
        e.target.value = ''; // reset input
        return;
    }

    // Preview
    const preview = document.getElementById('profile-preview');
    preview.src = URL.createObjectURL(file);
});
