<x-dashboard.layouts.base-dashboard title="edit kinerja">
    {{-- todo css --}}
    <x-slot:hadeOptional>

    </x-slot:hadeOptional>
    {{-- todo end css --}}

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Kinerja</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Kinerja</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kinerja.update', [$dokumentKinerja, $kinerja]) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-md-6">
                            <x-dashboard.subComponents.input
                                label="Sasaran Strategis Kepala Dinas/ Indikator Kinerja Kepala Dinas Yang Diintervensi"
                                name="sasaran_strategis"
                                valueData="{{ old('sasaran_strategis', $kinerja->sasaran_strategis) }}"
                            />
                        </div>
                        <div class="col-md-6">
                            <x-dashboard.subComponents.input
                                label="Sasaran Strategis Individu / Rencana Hasil Kerja Individu"
                                name="sasaran_strategis_individu"
                                valueData="{{ old('sasaran_strategis_individu', $kinerja->sasaran_strategis_individu) }}"
                            />
                        </div>
                        <div class="col-md-6">
                            <x-dashboard.subComponents.input
                                label="Indikator Kinerja Individu"
                                name="indikator_kinerja_individu"
                                valueData="{{ old('indikator_kinerja_individu', $kinerja->indikator_kinerja_individu) }}"
                            />
                        </div>
                        <div class="col-md-6">
                            <x-dashboard.subComponents.input
                                label="Target / Satuan"
                                name="target"
                                valueData="{{ old('target', $kinerja->target) }}"
                            />
                        </div>
                    </div>
                    <button class="btn btn-success">Perbaharui</button>
                </form>
            </div>
        </div>
    </x-slot:content>

    {{-- todo javascript --}}
    <x-slot:buttonOptional>
    </x-slot:buttonOptional>
    {{-- todo end javascript --}}
</x-dashboard.layouts.base-dashboard>
