// Menangani aksi tambah elemen <select>
function addSelect() {
    var container = document.getElementById("select-container");

    // Dapatkan elemen <select> yang sudah ada
    var existingSelect = container.querySelector("select");

    // Buat elemen <select> baru
    var newSelect = document.createElement("select");
    newSelect.classList.add("form-control"); // Add the "form-control" class
    newSelect.classList.add("my-3"); // Add the "form-control" class
    newSelect.style.width = "75%"; // Set the width to 100%

    // Clone options from the existing select element
    Array.from(existingSelect.options).forEach(function (option) {
      var clonedOption = document.createElement("option");
      clonedOption.value = option.value;
      clonedOption.textContent = option.textContent;
      newSelect.appendChild(clonedOption);
    });

    // ... tambahkan atribut, event listener, atau manipulasi elemen <select> sesuai kebutuhan ...

    // Tambahkan elemen <select> baru ke dalam kontainer
    container.appendChild(newSelect);
  }
