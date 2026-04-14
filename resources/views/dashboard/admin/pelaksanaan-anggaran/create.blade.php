<x-dashboard.layouts.base-dashboard title="tambah pelaksanaan anggaran">
    {{-- todo css --}}
    <x-slot:hadeOptional>

    </x-slot:hadeOptional>
    {{-- todo end css --}}

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pelaksanaan Anggaran</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Pelaksanaan Anggaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pelaksanaan-anggaran.store', $dokumentKinerja) }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- ? program kegiatan --}}
                        <div class="col-md-5">
                            <x-dashboard.subComponents.input
                                label="Program Kegiatan"
                                name="program_kegiatan"
                                type="text"
                            />
                        </div>
                        {{-- ? jumlah anggaran --}}
                        <div class="col-md-3">
                            <x-dashboard.subComponents.input
                                label="Jumlah Anggaran"
                                name="jumlah_anggaran"
                                type="text"
                            />
                        </div>
                        {{-- ? target kegiatan --}}
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Target Kegiatan"
                                name="target_kegiatan"
                                type="text"
                            />
                        </div>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </x-slot:content>

    {{-- todo javascript --}}
    <x-slot:buttonOptional>

    </x-slot:buttonOptional>
    {{-- todo end javascript --}}
</x-dashboard.layouts.base-dashboard>
