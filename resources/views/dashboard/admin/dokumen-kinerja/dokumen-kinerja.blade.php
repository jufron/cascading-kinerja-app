<x-dashboard.layouts.base-dashboard title="dokumen kinerja">
    <x-slot:hadeOptional>
        {{-- ? Custom styles for this page  --}}
        <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    </x-slot:hadeOptional>

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dokumen Kinerja</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Dokumen Kinerja</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('dokument-kinerja.create') }}" class="btn btn-success my-3">Buat Dokumen Baru</a>

                <div class="my-3">
                    <form method="GET" action="{{ route('dokument-kinerja.index') }}" class="d-inline">
                        <select class="form-control d-inline-block w-auto mr-2" name="validasi">
                            <option value="">Filter by Status Validasi</option>
                            @foreach ($status as $s)
                                <option value="{{ $s }}">{{ $s }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mr-2">Filter</button>
                        <a href="{{ route('dokument-kinerja.index') }}" class="btn btn-secondary">Reset</a>
                    </form>
                </div>

                <div class="table-responsive">
                    <table
                        class="table table-bordered"
                        id="dataTable"
                        width="100%"
                        cellspacing="0"
                        >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Dokumen Kinerja Tipe</th>
                                <th>Pihak Pertama</th>
                                <th>Pihak Kedua</th>
                                <th>Tahun</th>
                                <th>tanggal Perubahan</th>
                                <th>Tanggal Pembuatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Dokumen Kinerja Tipe</th>
                                <th>Pihak Pertama</th>
                                <th>Pihak Kedua</th>
                                <th>Tahun</th>
                                <th>tanggal Perubahan</th>
                                <th>Tanggal Pembuatan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dokumentKinerja as $dk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dk->jenis_kinerja }}</td>
                                <td>{{ $dk->userPertama->biodata->nama_lengkap }}</td>
                                <td>{{ $dk->userKedua->biodata->nama_lengkap }}</td>
                                <td>{{ $dk->tahun }}</td>
                                <td>{{ $dk->updated_at }}</td>
                                <td>{{ $dk->created_at }}</td>
                                <td>
                                    <form
                                        id="banner-delete-form" action="{{ route('dokument-kinerja.destroy', $dk) }}" method="post" class="d-flex">
                                        @method('delete')
                                        @csrf
                                        <a href="{{ route('dokument-kinerja.download.word', $dk) }}" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <a href="{{ route('kinerja.index', $dk) }}" class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <button
                                            id="button-banner-info"
                                            type="button"
                                            class="btn btn-info btn-circle btn-sm"
                                            data-toggle="modal"
                                            data-target="#faq"
                                            data-url="{{ route('dokument-kinerja.show', $dk) }}"
                                            >
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <a href="{{ route('dokument-kinerja.edit', $dk) }}" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <button type="button" id="banner-delete-button" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ? Modal info  --}}
        <div class="modal fade" id="faq" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="faqLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="faqLabel">Dokumen Kinerja Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body" id="modal-banner-container-info">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- ? end modal info --}}
    </x-slot:content>

    <x-slot:buttonOptional>
        {{-- ? Page level plugins  --}}
        <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        {{-- ? Page level custom scripts  --}}
        <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ asset('assets/js/swall.js') }}"></script>

        <script>
            const allButtonDelete = document.querySelectorAll('#banner-delete-button');
            const formSubmit = document.querySelectorAll('#banner-delete-form');

            allButtonDelete.forEach((buttonDelete, index) => {
                buttonDelete.addEventListener('click', function (event) {
                    event.preventDefault();
                    modalSweatAlert({
                        title : 'Hapus Data',
                        text: 'anda yakin ingin menghapus data tersebut?',
                        form: formSubmit[index]
                    });
                });
            });

            const faq = () => {
                const button_info = document.querySelectorAll('#button-banner-info');

                button_info.forEach(info => {
                    info.addEventListener('click', function () {
                        const dataUrl = info.getAttribute('data-url');
                        getData(dataUrl);
                        renderLoading(true);
                    });
                });
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
                        console.log(data);
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

            const renderErrorMessage = (message, statusCode) => {
                const modalContainerInfo = document.querySelector('#modal-banner-manajement-container-info');

                modalContainerInfo.innerHTML = `
                    <h1 class="text-center mt-3">${statusCode}</h1>
                    <div class="text-center mb-3">${message}</div>
                `;
            };

            const renderHTML = (data) => {
                console.log(data);
                const modalContainerInfo = document.querySelector('#modal-banner-container-info');

                const element = `
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">
                                    Tipe Dokument Kinerja
                                </div>
                                <div class="col-md-3">
                                    ${data.tipe_dokument_kinerja}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">
                                    Pihak Pertama
                                </div>
                                <div class="col-md-3">
                                    ${data.nama_user_pertama}
                                </div>
                                <div class="col-md-3 font-weight-bold">
                                    Pihak Kedua
                                </div>
                                <div class="col-md-3">
                                    ${data.nama_user_kedua}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">
                                    NIP
                                </div>
                                <div class="col-md-3">
                                    ${data.nip_user_pertama}
                                </div>
                                <div class="col-md-3 font-weight-bold">
                                    NIP
                                </div>
                                <div class="col-md-3">
                                    ${data.nip_user_kedua}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">
                                    Jabatan
                                </div>
                                <div class="col-md-3">
                                    ${data.jabatan_user_pertama}
                                </div>
                                <div class="col-md-3 font-weight-bold">
                                    Jabatan
                                </div>
                                <div class="col-md-3">
                                    ${data.jabatan_user_kedua}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">
                                    Bidang
                                </div>
                                <div class="col-md-3">
                                    ${data.bidang_user_pertama}
                                </div>
                                <div class="col-md-3 font-weight-bold">
                                    Bidang
                                </div>
                                <div class="col-md-3">
                                    ${data.bidang_user_kedua}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">
                                    Pangkat / Golongan
                                </div>
                                <div class="col-md-3">
                                    ${data.pangkat_golongan_user_pertama}
                                </div>
                                <div class="col-md-3 font-weight-bold">
                                    Pangkat / Golongan
                                </div>
                                <div class="col-md-3">
                                    ${data.pangkat_golongan_user_kedua}
                                </div>
                            </div>
                        </li>
                    </ul>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3 font-weight-bold">
                                    Tahun
                                </div>
                                <div class="col-md-3">
                                    ${data.tahun}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Kepala Dokumen
                                </div>
                                <div class="col-md-8">
                                    : ${data.head_dokument}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Badan Dokumen
                                </div>
                                <div class="col-md-8">
                                    : ${data.body_dokument}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="font-weight-bold my-4">
                        Daftar Kinerja
                    </div>
                    ${data.kinerja === null || data.kinerja === undefined || data.kinerja.length === 0
                        ? ``
                        : `
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sasaran Strategis Kepala Dinas/ Indikator Kinerja Kepala Dinas Yang Diintervensi
                                        </th>
                                        <th>Sasaran Strategis Individu / Rencana Hasil Kerja Individu</th>
                                        <th>Indikator Kinerja Individu</th>
                                        <th>Target / Satuan</th>
                                        <th>tanggal Perubahan</th>
                                        <th>Tanggal Pembuatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${data.kinerja.map((item, index) =>
                                        `
                                            <tr>
                                                <th scope="row">${index + 1}</th>
                                                <td>${item.sasaran_strategis}</td>
                                                <td>${item.sasaran_strategis_individu}</td>
                                                <td>${item.indikator_kinerja_individu}</td>
                                                <td>${item.target}</td>
                                                <td>${item.created_at}</td>
                                                <td>${item.updated_at}</td>
                                            </tr>
                                        `)
                                        .join('')
                                    }
                                </tbody>
                            </table>
                        `
                    }
                    <div class="font-weight-bold my-4">
                        Anggaran
                    </div>
                    ${data.pelaksanaan_anggaran === null || data.pelaksanaan_anggaran === undefined || data.pelaksanaan_anggaran.length === 0
                        ? ``
                        : `
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Program Kegiatan</th>
                                        <th scope="col">jumlah_anggaran</th>
                                        <th scope="col">Target Kegiatan</th>
                                        <th scope="col">Tanggal Buar</th>
                                        <th scope="col">Tanggal Perbaharui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${data.pelaksanaan_anggaran.map((item, index) =>
                                        `
                                            <tr>
                                                <th scope="row">${index + 1}</th>
                                                <td>${item.program_kegiatan}</td>
                                                <td>${item.jumlah_anggaran}</td>
                                                <td>${item.target_kegiatan}</td>
                                                <td>${item.created_at}</td>
                                                <td>${item.updated_at}</td>
                                            </tr>
                                        `)
                                        .join('')
                                    }
                                </tbody>
                            </table>
                        `
                    }

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
                    </ul>
                    <ul class="list-group list-group-flush">
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
                modalContainerInfo.innerHTML = element;
            };

            const renderLoading = (data) => {
                const modalContainerInfo = document.querySelector('#modal-banner-container-info');

                if (data) {
                    const element = `
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    `;
                    modalContainerInfo.innerHTML = element;
                } else {
                    modalContainerInfo.innerHTML = '';
                }
            };

            faq();



        </script>
    </x-slot:buttonOptional>
</x-dashboard.layouts.base-dashboard>

