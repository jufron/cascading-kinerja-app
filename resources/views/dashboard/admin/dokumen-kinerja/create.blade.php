<x-dashboard.layouts.base-dashboard title="tambah dokumen kinerja">
    {{-- todo css --}}
    <x-slot:hadeOptional>

    </x-slot:hadeOptional>
    {{-- todo end css --}}

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Dokumen Kinerja</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Dokumen Kinerja</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dokument-kinerja.store') }}" method="POST">
                    @csrf
                    {{-- ? head surat --}}
                    <x-dashboard.subComponents.input-textarea
                        label="Atas Dokumen"
                        name="head_dokumen"
                        aria-placeholder="Optional"
                        >
                        {{ old('head_dokumen', 'Dalam rangka mewujudkan manajemen pemerintahan yang efektif, transparan, dan akuntabel serta berorientasi pada hasil, kami yang bertandatangan di bawah ini:') }}
                    </x-dashboard.subComponents.input-textarea>

                    <div class="row">
                        {{-- ? Pihak Pertama --}}
                        <div class="col-md-6 border-right">
                            <h5>Pihak Pertama</h5>
                            {{-- ? nama lengkap --}}
                            <x-dashboard.subComponents.input
                                label="Nama Lengkap"
                                name="nama_lengkap_pihak_pertama"
                                type="text"
                                valueData="{{ $nama_lengkap }}"
                                disable="true"
                            />
                            {{-- ? nip --}}
                            <x-dashboard.subComponents.input
                                label="NIP"
                                name="nip_pihak_pertama"
                                type="text"
                                valueData="{{ $nip }}"
                                disable="true"
                            />
                            {{-- ? pangkat --}}
                            <x-dashboard.subComponents.input
                                label="Pangkat"
                                name="pangkat_pihak_pertama"
                                type="text"
                                valueData="{{ $pangkat }}"
                                disable="true"
                            />
                            {{-- ? bidang --}}
                            <x-dashboard.subComponents.input
                                label="Bidang"
                                name="bidang_pihak_pertama"
                                type="text"
                                valueData="{{ $bidang }}"
                                disable="true"
                            />
                            {{-- ? jabatan --}}
                            <x-dashboard.subComponents.input
                                label="Jabatan"
                                name="jabatan_pihak_pertama"
                                type="text"
                                valueData="{{ $jabatan }}"
                                disable="true"
                            />
                        </div>
                        {{-- ? Pihak kedua --}}
                        <div class="col-md-6 border-right">
                            <h5>Pihak Kedua</h5>
                            {{-- ? nama lengkap --}}
                            <x-dashboard.subComponents.input-select name="user_id_pihak_kedua" label="Nama Lengkap">
                                <option value="pilih" selected disabled>Pilih</option>
                                @foreach ($user as $u)
                                    <option value="{{ $u->id }}" {{ old('user_id_pihak_kedua') == $u->id ? 'selected' : '' }}>
                                        {{ $u->biodata->nama_lengkap }}
                                    </option>
                                @endforeach
                            </x-dashboard.subComponents.input-select>
                            {{-- ? nip --}}
                            <x-dashboard.subComponents.input
                                label="NIP"
                                name="nip_pihak_kedua"
                                type="text"
                                disable="true"
                            />
                            {{-- ? pangkat --}}
                            <x-dashboard.subComponents.input
                                label="Pangkat"
                                name="pangkat_pihak_kedua"
                                type="text"
                                disable="true"
                            />
                            {{-- ? bidang --}}
                            <x-dashboard.subComponents.input
                                label="Bidang"
                                name="bidang_pihak_kedua"
                                type="text"
                                disable="true"
                            />
                            {{-- ? jabatan --}}
                            <x-dashboard.subComponents.input
                                label="Jabatan"
                                name="jabatan_pihak_kedua"
                                type="text"
                                disable="true"
                            />
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        {{-- ? jenis kinerja --}}
                        <div class="col-md-3">
                            <x-dashboard.subComponents.input-select name="jenis_kinerja" label="Jenis Kinerja">
                                <option value="pilih" selected disabled>Pilih</option>
                                @foreach ($jenis_kinerja as $jk)
                                    <option value="{{ $jk }}" {{ old('jenis_kinerja') == $jk ? 'selected' : '' }}>
                                        {{ $jk }}
                                    </option>
                                @endforeach
                            </x-dashboard.subComponents.input-select>
                        </div>
                        {{-- ? tahun --}}
                        <div class="col-md-2">
                            <x-dashboard.subComponents.input-select name="tahun" label="Tahun">
                                <option value="pilih" selected disabled>Pilih</option>
                                @foreach ($tahun as $t)
                                    <option value="{{ $t }}" {{ old('tahun') == $t ? 'selected' : '' }}>
                                        {{ $t }}
                                    </option>
                                @endforeach
                            </x-dashboard.subComponents.input-select>
                        </div>
                    </div>
                    {{-- ? body dokumen --}}
                    <x-dashboard.subComponents.input-textarea
                        label="Badan Dokumen"
                        name="body_dokumen"
                        aria-placeholder="Optional"
                        >
                        {{ old('body_dokumen', 'Pihak pertama berjanji akan mewujudkan target kinerja yang seharusnya sesuai lampiran perjanjian ini, dalam rangka mencapai target kinerja jangka menengah seperti yang telah ditetapkan dalam dokumen perencanaan. Keberhasilan dan kegagalan pencapaian target kinerja tersebut menjadi tanggung jawab kami. Pihak kedua akan melakukan pengawasan dan evaluasi terhadap capaian kinerja dari perjanjian ini dan mengambil tindakan yang diperlukan dalam rangka pemberian penghargaan dan sanksi.') }}
                    </x-dashboard.subComponents.input-textarea>

                    <button class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </x-slot:content>

    {{-- todo javascript --}}
    <x-slot:buttonOptional>
        <script>
            const inputNip = document.getElementById('nip_pihak_kedua');
            const inputPangkat = document.getElementById('pangkat_pihak_kedua');
            const inputBidang = document.getElementById('bidang_pihak_kedua');
            const inputJabatan = document.getElementById('jabatan_pihak_kedua');

            const inputSelectNamaLengkap = document.getElementById('user_id_pihak_kedua');
            const searchBiodata = `{{ route('dokument-kinerja.search') }}`;

            inputSelectNamaLengkap.addEventListener('change', async function () {
                let userId = this.value;

                if (!userId) return;

                // fetch dari Laravel
                let response = await fetch(`${searchBiodata}?id=${userId}`);
                let result = await response.json();
                const {message, data} = result;

                inputNip.value = data.nip;
                inputPangkat.value = data.pangkat;
                inputBidang.value = data.bidang;
                inputJabatan.value = data.jabatan;
            });
        </script>
    </x-slot:buttonOptional>
    {{-- todo end javascript --}}
</x-dashboard.layouts.base-dashboard>
