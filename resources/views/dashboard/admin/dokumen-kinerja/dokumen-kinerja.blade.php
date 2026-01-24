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
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="faqLabel">Pertanyaan Faq Info</h5>
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
                const modalContainerInfo = document.querySelector('#modal-banner-container-info');

                const element = `
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Username
                                </div>
                                <div class="col-md-8">
                                    : ${data.username}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    NIP
                                </div>
                                <div class="col-md-8">
                                    : ${data.nip}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Email
                                </div>
                                <div class="col-md-8">
                                    : ${data.email}
                                </div>
                            </div>
                        </li>
                    </ul>
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
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Jabatan
                                </div>
                                <div class="col-md-8">
                                    : ${data.nama_jabatan}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
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
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Pangkat Golongan
                                </div>
                                <div class="col-md-8">
                                    : ${data.pangkat_golongan}
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">
                                    Nomor Telepon
                                </div>
                                <div class="col-md-8">
                                    : ${data.nomor_telepon}
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

