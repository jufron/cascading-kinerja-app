import { handleShowData, handleDeleteData } from "./showAndDelete.js";

// get input select id status
const inputSelectStatus = document.getElementById('status');
// get input select id tanggal
const inputStartDate = document.getElementById('start_date');
const inputEndDate = document.getElementById('end_date');

// get button reset filter
const buttonResetFilter = document.getElementById('reset-filter-button');

// ? datatable
$(document).ready(function() {
    const tablePengumuman = $('#pengumuman-table');

  const datatable = tablePengumuman.DataTable({
    serverSide: true,
    processing: true,
    ajax: {
        url: tablePengumuman.attr('data-url'),
        data: function(d) {
            // * filter data jika nanti diperlukan
            // console.log(d);
            if (inputSelectStatus.value !== null && inputSelectStatus.value !== '') {
                d.Status = inputSelectStatus.value;
            }

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
        { data: 'Photo', name: 'Photo', searchable: false },
        { data: 'Judul', name: 'Judul', searchable: true },
        { data: 'Kontent', name: 'Kontent', searchable: false },
        { data: 'Status', name: 'Status', searchable: false },
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
                    src="${data.poster}"
                    alt="User Photo" class="img-fluid mb-3"
                    width="300px">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Judul
                            </div>
                            <div class="col-md-8">
                                : ${data.title}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">
                                Status
                            </div>
                            <div class="col-md-8">
                                : ${data.is_published
                                    ? '<span class="badge badge-success">Publish</span>'
                                    : '<span class="badge badge-danger">Draft</span>'}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item summernote-content">
                        ${data.content}
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
  }); // * end datatable

  // * reset filter
    buttonResetFilter.addEventListener('click', function () {
        inputSelectStatus.value = '';

        inputEndDate.value = '';
        inputStartDate.value = '';

        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Seluruh Filter Direset');
    });

    // * input filter change
    inputSelectStatus.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Status');
    });
    inputStartDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Tanggal Mulai');
    });
    inputEndDate.addEventListener('change', function () {
        datatable.ajax.reload(null, false);
        handleToastlifyPopUp('Filter dengan Tanggal Selesai');
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


}); // * end document ready
