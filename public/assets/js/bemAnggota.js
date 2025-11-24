import { handleShowData, handleDeleteData } from "./showAndDelete.js";

// get input select id status
const inputSelectBidang = document.getElementById('bidang');
const inputSelectProdi = document.getElementById('prodi');
const inputSelectSemseter = document.getElementById('semester');

// get button reset filter
const buttonResetFilter = document.getElementById('reset-filter-button');

$(document).ready(function() {
    const tableBemAnggota = $('#bem-anggota-table');

    const datatable = tableBemAnggota.DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: tableBemAnggota.attr('data-url'),
            data: function(d) {
                // * filter data jika nanti diperlukan
                // console.log(d);

                if (inputSelectBidang.value !== null && inputSelectBidang.value !== '') {
                    console.log(inputSelectBidang.value);
                    d.bidang = inputSelectBidang.value;
                }
                if (inputSelectProdi.value !== null && inputSelectProdi.value !== '') {
                    console.log(inputSelectProdi.value);
                    d.prodi  = inputSelectProdi.value;
                }
                if (inputSelectSemseter.value !== null && inputSelectSemseter.value !== '') {
                    console.log(inputSelectSemseter.value);
                    d.semester  = inputSelectSemseter.value;
                }
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'Photo', name: 'Photo', searchable: false },
            { data: 'Nama Lengkap', name: 'Nama Lengkap', searchable: true },
            { data: 'NIM', name: 'NIM', searchable: true },
            { data: 'Bidang', name: 'Bidang', searchable: true },
            { data: 'Tanggal Buat', name: 'Tanggal Buat', searchable: false },
            { data: 'Tanggal Pembaharuan', name: 'Tanggal Pembaharuan', searchable: false },
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
                    <img
                        src="${data.photo}"
                        alt="User Photo" class="img-fluid mb-3"
                        width="200px">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Nama Lengkap
                                </div>
                                <div class="col-md-8">
                                    : ${data.nama_lengkap}
                                </div>
                            </div>
                        </li>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    NIM
                                </div>
                                <div class="col-md-8">
                                    : ${data.nim}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Bidang
                                </div>
                                <div class="col-md-8">
                                    : ${data.bidang}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Prodi
                                </div>
                                <div class="col-md-8">
                                    : ${data.prodi}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Semester
                                </div>
                                <div class="col-md-8">
                                    : ${data.semester}
                                </div>
                            </div>
                        </li>
                    </ul>

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
    }); // * enddatatable

      // * reset filter
    buttonResetFilter.addEventListener('click', function () {
        inputSelectBidang.value = '';
        inputSelectProdi.value = '';
        inputSelectSemseter.value = '';

        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Seluruh Filter Direset');
    });

    // * input filter change
    inputSelectBidang.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Bidang');
    });
    inputSelectProdi.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Prodi');
    });
    inputSelectSemseter.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Semester');
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
