<x-dashboard.layouts.base-dashboard title="create pejabat atasan">
    {{-- todo css --}}
    <x-slot:hadeOptional>

    </x-slot:hadeOptional>
    {{-- todo end css --}}

    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pejabat Atasan</h1>
        </div>

        {{-- ? DataTales Example  --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah pejabat atasan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('daftar-admin.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Username"
                                name="name"
                                valueData="{{ old('name') }}"
                            />
                        </div>
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="NIP"
                                name="nip"
                                valueData="{{ old('nip') }}"
                            />
                        </div>
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Email"
                                name="email"
                                type="email"
                                valueData="{{ old('email') }}"
                            />
                        </div>
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Passowrd"
                                name="password"
                                type="password"
                                valueData="{{ old('password') }}"
                            />
                        </div>
                        <div class="col-md-4">
                            <x-dashboard.subComponents.input
                                label="Password Konfirmasi"
                                name="password_confirmation"
                                type="password"
                                valueData="{{ old('password_confirmation') }}"
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
