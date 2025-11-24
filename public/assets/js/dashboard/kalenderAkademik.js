const modalKalenderAkademikContainer = document.getElementById('modal-kalender-akademik-container-info');
const buttonKalenderAkademikInfo = document.querySelectorAll('#button-kalender-akademik-info');
const modalBox = document.getElementById('modal-kalender-akademik-info');

const renderHTML = (data) => {
    // console.log(data);
    const element = `
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Judul
                    </div>
                    <div class="col-md-8">
                        ${data.title}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Deskripsi
                    </div>
                    <div class="col-md-8">
                        ${data.description}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Tanggal Awal
                    </div>
                    <div class="col-md-8">
                        ${data.start_date}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Tanggal Akhir
                    </div>
                    <div class="col-md-8">
                        ${data.end_date}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Pengulangan Setiap Tahun
                    </div>
                    <div class="col-md-8">
                        ${data.is_annual}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Warna
                    </div>
                    <div class="col-md-8">
                        ${data.color}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Event Tipe
                    </div>
                    <div class="col-md-8">
                        ${data.event_tipe}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Tanggal Pengulangan Setiap Tahun
                    </div>
                    <div class="col-md-8">
                        ${data.dtstart}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Durasi Hari Pengulangan Setiap Tahun
                    </div>
                    <div class="col-md-8">
                        ${data.duration_days}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Tanggal Buat
                    </div>
                    <div class="col-md-8">
                        ${data.created_at}
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-4 font-weight-bold">
                        Tanggal Perbaharui
                    </div>
                    <div class="col-md-8">
                        ${data.updated_at}
                    </div>
                </div>
            </li>
        </ul>
    `;
    modalKalenderAkademikContainer.innerHTML = element;
};

const renderErrorMessage = (message, statusCode) => {
    modalKalenderAkademikContainer.innerHTML = `
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
        modalKalenderAkademikContainer.innerHTML = element;
    } else {
        modalKalenderAkademikContainer.innerHTML = '';
    }
};

const getData = (dataUrl) => {
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
            renderHTML(data);
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

const kalenderAkademik = () => {
    buttonKalenderAkademikInfo.forEach(info => {
        info.addEventListener('click', function () {
            const dataUrl = info.getAttribute('data-url');
            getData(dataUrl);
            renderLoading(true);
        });
    });
};

kalenderAkademik();

// ? delete data from kalender akademik
const allButtonDeleteKalenderAkademik = document.querySelectorAll('#kalender-akademik-delete-button');
const formSubmitKalenderAkademik = document.querySelectorAll('#kalender-akademik-delete-form');

allButtonDeleteKalenderAkademik.forEach((buttonDelete, index) => {
    buttonDelete.addEventListener('click', function (event) {
        event.preventDefault();
        modalSweatAlert({
            title : 'Hapus Data',
            text: 'anda yakin ingin menghapus data tersebut?',
            form: formSubmitKalenderAkademik[index]
        });
    });
});

// ? delete data from evnet tipe
const allButtonDeleteEvent = document.querySelectorAll('#event-tipe-delete-button');
const formSubmitEvent = document.querySelectorAll('#event-tipe-delete-form');

allButtonDeleteEvent.forEach((buttonDelete, index) => {
    buttonDelete.addEventListener('click', function (event) {
        event.preventDefault();
        modalSweatAlert({
            title : 'Hapus Data',
            text: 'anda yakin ingin menghapus data tersebut?',
            form: formSubmitEvent[index]
        });
    });
});
