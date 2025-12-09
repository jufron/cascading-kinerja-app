<x-dashboard.layouts.base-dashboard title="create laporan pegawai">
    {{-- todo css --}}
    <x-slot:hadeOptional>

    </x-slot:hadeOptional>
    {{-- todo end css --}}

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Laporan Pegawai</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Laporan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('laporan-pegaai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4 mb-4">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input @error('nama_file') is-invalid @enderror" name="nama_file" id="nama_file">
                            <label class="custom-file-label" for="nama_file">Pilih file...</label>
                            @error('nama_file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <x-dashboard.subComponents.input-select name="pegawai_user_id" label="Nama Pegawai">
                            @foreach ($user as $u)
                                <option selected disabled>Pilih</option>
                                <option value="{{ $u->id }}" {{ old('pegawai_user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->biodata->nama_lengkap }}
                                </option>
                            @endforeach
                        </x-dashboard.subComponents.input-select>
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
