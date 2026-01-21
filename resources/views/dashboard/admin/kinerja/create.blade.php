<x-dashboard.layouts.base-dashboard title="create kinerja">
    {{-- todo css --}}
    <x-slot:hadeOptional>

    </x-slot:hadeOptional>
    {{-- todo end css --}}

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Kinerja</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kinerja</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kinerja.store', $dokumentKinerja) }}" method="POST">
                    @csrf
                    {{-- ? sasaran_strategis --}}
                    <x-dashboard.subComponents.input-textarea
                        label="Sasaran Strategis Kepala Dinas/ Indikator Kinerja Kepala Dinas Yang Diintervensi"
                        name="sasaran_strategis"
                        aria-placeholder="Optional"
                        rows="3"
                        >
                        {{ old('sasaran_strategis') }}
                    </x-dashboard.subComponents.input-textarea>

                    {{-- ? sasaran_strategis_individu --}}
                    <x-dashboard.subComponents.input-textarea
                        label="Sasaran Strategis Individu / Rencana Hasil Kerja Individu"
                        name="sasaran_strategis_individu"
                        aria-placeholder="Optional"
                        rows="3"
                        >
                        {{ old('sasaran_strategis_individu') }}
                    </x-dashboard.subComponents.input-textarea>

                    {{-- ? indikator_kinerja_individu --}}
                    <x-dashboard.subComponents.input-textarea
                        label="Indikator Kinerja Individu"
                        name="indikator_kinerja_individu"
                        aria-placeholder="Optional"
                        rows="3"
                        >
                        {{ old('indikator_kinerja_individu') }}
                    </x-dashboard.subComponents.input-textarea>

                    <div class="col-md-6">
                        <x-dashboard.subComponents.input
                            label="Target / Satuan"
                            name="target"
                            valueData="{{ old('target') }}"
                        />
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
