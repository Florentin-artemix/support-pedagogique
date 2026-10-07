
  const fileInput = document.getElementById('fichier');
  const fileNameInput = document.getElementById('nomFichier');

  fileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      fileNameInput.value = file.name;
    }
  });
