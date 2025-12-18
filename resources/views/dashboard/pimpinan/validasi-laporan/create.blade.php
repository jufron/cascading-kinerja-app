<x-dashboard.layouts.base-dashboard title="validasi laporan">
    {{-- todo css --}}
    <x-slot:hadeOptional>

    </x-slot:hadeOptional>
    {{-- todo end css --}}

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Validasi Laporan</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Validasi Laporan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('validasi-laporan.store') }}" method="POST">
                    @csrf
                    @dump($dokumen_kinerja)
                    <div class="row">
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input-select name="status" label="Status">
                                <option selected disabled>Pilih</option>
                                @foreach ($status as $s)
                                    <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>
                                        {{ $s }}
                                    </option>
                                @endforeach
                            </x-dashboard.subComponents.input-select>
                        </div>

                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Komentar atau Pesan"
                                name="komentar"
                                valueData="{{ old('komentar') }}"
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
