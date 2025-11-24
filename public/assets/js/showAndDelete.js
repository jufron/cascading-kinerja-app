
// ? show element for modal
const myModal = new bootstrap.Modal(document.getElementById('show-modal'));

const modalBody = document.querySelector('#modal-body-information');

const getData = (dataUrl, callback) => {
    fetch(dataUrl)
        .then(ress => {
            if (!ress.ok) {
                throw {
                    status: ress.status,
                    message: ress.statusText || 'Unknown error'
                };
            }
            return ress.json();
        })
        .then(data => {
            renderLoading(false);
            callback(
                data,
                modalBody
            );
        })
        .catch(err => {
            renderLoading(false);
            console.error('Fetch error:', err);
            renderErrorMessage(
                `An error occurred: ${err.message}`,
                `${err.status}`
            );
        });
};

const renderErrorMessage = (message, statusCode) => {
    modalBody.innerHTML = `
        <h1 class="text-center mt-3">${statusCode}</h1>
        <div class="text-center mb-3">${message}</div>
    `;
};

const renderLoading = (data) => {
    if (data) {
        const element = `
            <div class="d-flex justify-content-center">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        `;
        modalBody.innerHTML = element;
    } else {
        modalBody.innerHTML = '';
    }
};

// todo handle show data
function handleShowData (oneButtonShowElement, callback) {
    oneButtonShowElement.addEventListener('click', function () {
        const dataUrl = this.getAttribute('data-url');

        getData(dataUrl, callback);
        renderLoading(true);
    });
}

// todo handle delete data
function handleDeleteData (oneButtonDeleteElement, oneFormDelete) {
    oneButtonDeleteElement.addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
            icon: "warning",
            title : 'Hapus Data',
            text: 'anda yakin ingin menghapus data tersebut?',
            showCancelButton: true,
            confirmButtonColor: "#d33", // Warna merah untuk tombol Hapus
            cancelButtonColor: "#3085d6", // Warna biru untuk tombol Batal
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                oneFormDelete.submit();
            }
        });

    });
}

export { handleShowData, handleDeleteData };
