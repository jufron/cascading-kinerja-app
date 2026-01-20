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
                    {{--? 'kinerja_id', --}}
                    <div class="col-md-6">
                        <x-dashboard.subComponents.input-select name="kinerja_id" label="Nama Lengkap">
                            <option value="pilih" selected disabled>Pilih</option>
                            @foreach ($kinerja as $krj)
                                <option value="{{ $krj->id }}" {{ old('kinerja_id') == $krj->id ? 'selected' : '' }}>
                                    {{ $krj->sasaran_strategis }}
                                </option>
                            @endforeach
                        </x-dashboard.subComponents.input-select>
                    </div>
                    <div class="row">
                        {{-- ? sasaran_strategis --}}
                        <div class="col-md-6">
                            <x-dashboard.subComponents.input
                                label="Sasaran Strategis Kepala Dinas/ Indikator Kinerja Kepala Dinas Yang Diintervensi"
                                name="sasaran_strategis"
                                type="text"
                                disable="true"
                            />
                        </div>
                        {{-- ? sasaran_strategis_individu --}}
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Sasaran Strategis Individu / Rencana Hasil Kerja Individu"
                                name="sasaran_strategis_individu"
                                type="text"
                                disable="true"
                            />
                        </div>
                        {{-- ? indikator_kinerja_individu --}}
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Indikator Kinerja Individu"
                                name="indikator_kinerja_individu"
                                type="text"
                                disable="true"
                            />
                        </div>
                        {{-- ? target --}}
                        <div class="col-md-3">
                            <x-dashboard.subComponents.input
                                label="Target / Satuan"
                                name="target"
                                type="text"
                                disable="true"
                            />
                        </div>
                    </div>

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
        <script>
            const inputSasaranStrategis = document.getElementById('sasaran_strategis');
            const inputSasaranStrategisIndividu = document.getElementById('sasaran_strategis_individu');
            const inputIndikatorKinerjaIndividu = document.getElementById('indikator_kinerja_individu');
            const inputTarget = document.getElementById('target');

            const inputSelectKinerjaId = document.getElementById('kinerja_id');
            const searchBiodata = `{{ route('pelaksanaan-anggaran.search', $dokumentKinerja) }}`;

            inputSelectKinerjaId.addEventListener('change', async function () {
                let userId = this.value;

                if (!userId) return;

                // fetch dari Laravel
                let response = await fetch(`${searchBiodata}?id=${userId}`);
                let result = await response.json();

                // console.log(result);
                const {
                    indikator_kinerja_individu,
                    sasaran_strategis,
                    sasaran_strategis_individu,
                    target
                } = result.data;

                inputSasaranStrategis.value = sasaran_strategis;
                inputSasaranStrategisIndividu.value = sasaran_strategis_individu;
                inputIndikatorKinerjaIndividu.value = indikator_kinerja_individu;
                inputTarget.value = target
            });
        </script>
    </x-slot:buttonOptional>
    {{-- todo end javascript --}}
</x-dashboard.layouts.base-dashboard>
