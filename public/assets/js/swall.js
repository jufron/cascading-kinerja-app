const modalSweatAlert = swal => {
    const {
        title,
        text,
        form,
        confirmButtonText = 'Hapus',
        cencelButtonText = 'Batal'
    } = swal;
    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33", // Warna merah untuk tombol Hapus
        cancelButtonColor: "#3085d6", // Warna biru untuk tombol Batal
        confirmButtonText: confirmButtonText,
        cancelButtonText: cencelButtonText
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
