import { handleShowData, handleDeleteData } from "./showAndDelete.js";

const inputSelectPenulis = document.getElementById('penulis');
const inputSelectKategory = document.getElementById('kategory');
const inputSelectStatus = document.getElementById('status');
const inputStartDate = document.getElementById('start_date');
const inputEndDate = document.getElementById('end_date');
// get button reset filter
const buttonResetFilter = document.getElementById('reset-filter-button');


$(document).ready(function() {
    const beritaTable = $('#berita-table');

    const datatable = beritaTable.DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: beritaTable.attr('data-url'),
            data: function(d) {
                // * filter data jika nanti diperlukan
                // console.log(d);
                // * penulis
                if (inputSelectPenulis.value !== null && inputSelectPenulis.value !== '') {
                    d.penulis = inputSelectPenulis.value;
                }
                // * kategory
                if (inputSelectKategory.value !== null && inputSelectKategory.value !== '') {
                    d.kategory = inputSelectKategory.value;
                }
                // * status
                if (inputSelectStatus.value !== null && inputSelectStatus.value !== '') {
                    d.status = inputSelectStatus.value;
                }
                // * start date
                if (inputStartDate.value !== null && inputStartDate.value !== '') {
                    d.start_date  = inputStartDate.value;
                }
                // * end date
                if (inputEndDate.value !== null && inputEndDate.value !== '') {
                    d.end_date  = inputEndDate.value;
                }
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'Photo', name: 'Photo', searchable: false },
            { data: 'Judul', name: 'Judul', searchable: true },
            { data: 'Penulis', name: 'Penulis', searchable: false },
            { data: 'Publish', name: 'Publish', searchable: false },
            { data: 'Tanggal Buat', name: 'Tanggal Buat', searchable: false },
            { data: 'Tanggal Pembaharuan', name: 'Tanggal Pembaharuan', searchable: false },
            { data: 'Aksi', name: 'Aksi', searchable: false },
        ],
        order: [[3, 'desc']],
        rowCallback: function(row, dataRow) {
            console.log(row);
            console.log(dataRow);

            const buttonShow = row.querySelector('#button-info');
            const buttonDelete = row.querySelector('#button-delete');
            const formDelete = row.querySelector('#form-delete');

            // todo info
            handleShowData(buttonShow, function (data, modalBody) {

            const element = `
                <img
                    src="${data.poster}"
                    alt="User Photo" class="img-fluid mb-3"
                    width="100%"
                    loading="lazy"
                >
                <h3 class="font-weight-bold">${data.judul}</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Penulis
                            </div>
                            <div class="col-md-8">
                                : ${data.penulis}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Kategory
                            </div>
                            <div class="col-md-8">
                                : ${data.kategory}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Status
                            </div>
                            <div class="col-md-8">
                                : ${
                                    data.status
                                        ? `<span class="badge badge-success py-2 px-1">Publish</span>`
                                        : `<span class="badge badge-info py-2 px-1">Belum Publish</span>`
                                }
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Terakhir Ditulis
                            </div>
                            <div class="col-md-8">
                                : ${data.terakhir_ditulis}
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="my-3 summernote-content">
                    ${data.kontent}
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Tanggal Buat
                            </div>
                            <div class="col-md-8">
                                : ${data.created_at}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Tanggal Perbaharui
                            </div>
                            <div class="col-md-8">
                                : ${data.updated_at}
                            </div>
                        </div>
                    </li>
                </ul>
            `;

                modalBody.innerHTML = element;
            });

            // todo delete
            handleDeleteData(buttonDelete, formDelete);
        }
    }); // * end datatable

    // * reset filter
    buttonResetFilter.addEventListener('click', function () {
        inputSelectPenulis.value = '';
        inputSelectKategory.value = '';
        inputSelectStatus.value = '';
        inputEndDate.value = '';
        inputStartDate.value = '';

        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Seluruh Filter Direset');
    });

    // * input filter change
    inputSelectPenulis.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Penulis');
    });
    inputSelectKategory.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Kategory');
    });
    inputSelectStatus.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Status');
    });
    inputEndDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Tanggal Awal');
    });
    inputStartDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Tanggal Akhir');
    });

    // * toastify js
    function handleToastlifyPopUp (label) {
        Toastify({
            text: label,
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
        }).showToast();
    }
});
