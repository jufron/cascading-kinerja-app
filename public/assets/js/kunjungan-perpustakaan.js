import { handleShowData, handleDeleteData } from "./showAndDelete.js";

// get input select id prodi, status, semester, start_date dan end_date
const inputSelectProdi = document.getElementById('prodi');
const inputSelectStatus = document.getElementById('status');
const inputSelectSemester = document.getElementById('semester');

const inputStartDate = document.getElementById('start_date');
const inputEndDate = document.getElementById('end_date');

// * get button reset filter
const buttonResetFilter = document.getElementById('reset-filter-button');

$(document).ready(function() {
    const tablePengumuman = $('#kunjungan-perpustakaan-table');

    const datatable = tablePengumuman.DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: tablePengumuman.attr('data-url'),
            data: function(d) {
                // * prodi
                if (inputSelectProdi.value !== null && inputSelectProdi.value !== '') {
                    d.prodi = inputSelectProdi.value;
                }
                // * status
                if (inputSelectStatus.value !== null && inputSelectStatus.value !== '') {
                    d.status = inputSelectStatus.value;
                }
                // * semester
                if (inputSelectSemester.value !== null && inputSelectSemester.value !== '') {
                    d.semester = inputSelectSemester.value;
                }

                // * tanggal start date and end date
                if (inputStartDate.value !== null && inputStartDate.value !== '') {
                    d.start_date  = inputStartDate.value;
                }
                if (inputEndDate.value !== null && inputEndDate.value !== '') {
                    d.end_date  = inputEndDate.value;
                }
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'Tanggal', name: 'Tanggal', searchable: false },
            { data: 'Nim', name: 'Nim', searchable: true },
            { data: 'Nama Pemustaka', name: 'Nama Pemustaka', searchable: true },
            { data: 'Prodi', name: 'Prodi', searchable: false },
            { data: 'Status', name: 'Status', searchable: false },
            { data: 'Semester', name: 'Semester', searchable: false },
            { data: 'Tujuan Kunjungan', name: 'Tujuan Kunjungan', searchable: false },
            { data: 'Aksi', name: 'Aksi', searchable: false },
        ],
        order: [[3, 'desc']],
        rowCallback: function(row, data) {
            const buttonShow = row.querySelector('#button-info');
            const buttonDelete = row.querySelector('#button-delete');
            const formDelete = row.querySelector('#form-delete');

            // todo info
            handleShowData(buttonShow, function (data, modalBody) {
                const element = `
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Tanggal
                                </div>
                                <div class="col-md-8">
                                    ${data.tanggal}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    NIM
                                </div>
                                <div class="col-md-8">
                                    ${data.nim}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Nama Pemustaka
                                </div>
                                <div class="col-md-8">
                                    ${data.nama_pemustaka}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Prodi
                                </div>
                                <div class="col-md-8">
                                    ${data.prodi}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Status
                                </div>
                                <div class="col-md-8">
                                    ${data.status}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Semester
                                </div>
                                <div class="col-md-8">
                                    ${data.semester}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Tujuan Kunjungan
                                </div>
                                <div class="col-md-8">
                                    ${data.tujuan_kunjungan}
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
    }); //* end datatable

      // * reset filter
      buttonResetFilter.addEventListener('click', function () {
        inputSelectProdi.value = '';
        inputSelectStatus.value = '';
        inputSelectSemester.value = '';

        inputEndDate.value = '';
        inputStartDate.value = '';

        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Seluruh Filter Direset');
    });

    // * input filter change
    inputSelectProdi.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter Prodi');
    });
    inputSelectStatus.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter Status');
    });
    inputSelectSemester.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter Semester');
    });
    inputStartDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter Tanggal Mulai');
    });
    inputEndDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter Tanggal Selesai');
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
    } // * end toastify js

}); // * end document ready
