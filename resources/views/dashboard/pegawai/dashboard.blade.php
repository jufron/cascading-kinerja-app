<x-dashboard.layouts.base-dashboard title="Dashboard Pegawai">
    <x-slot:hadeOptional>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');

            .dashboard-container {
                font-family: 'Outfit', 'Nunito', sans-serif;
                color: #1f2937;
            }

            .welcome-card {
                background: linear-gradient(135deg, #065f46 0%, #064e3b 100%);
                border: none;
                border-radius: 20px;
                color: #ffffff;
                overflow: hidden;
                position: relative;
                box-shadow: 0 10px 30px rgba(6, 95, 70, 0.15);
            }

            .welcome-card::after {
                content: '';
                position: absolute;
                top: -50px;
                right: -50px;
                width: 200px;
                height: 200px;
                background: radial-gradient(circle, rgba(167, 243, 208, 0.15) 0%, rgba(167, 243, 208, 0) 70%);
                border-radius: 50%;
            }

            .stat-card {
                border: none;
                border-radius: 16px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
                background: #ffffff;
                overflow: hidden;
                height: 100%;
            }

            .stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .stat-icon {
                width: 52px;
                height: 52px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
                font-size: 1.5rem;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }

            .bg-grad-blue { background: linear-gradient(135deg, #2563eb, #3b82f6); }
            .bg-grad-amber { background: linear-gradient(135deg, #d97706, #f59e0b); }
            .bg-grad-emerald { background: linear-gradient(135deg, #059669, #10b981); }

            .quick-action-card {
                border: 1px solid rgba(0,0,0,0.06);
                border-radius: 14px;
                background: #ffffff;
                transition: all 0.2s ease;
                text-decoration: none !important;
                color: #374151;
            }
            .quick-action-card:hover {
                background: #f8fafc;
                border-color: #cbd5e1;
                transform: scale(1.02);
            }

            .card-modern {
                border: none;
                border-radius: 18px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            }

            .card-modern-header {
                background-color: #ffffff;
                border-bottom: 1px solid #f1f5f9;
                border-top-left-radius: 18px;
                border-top-right-radius: 18px;
                padding: 1.25rem 1.5rem;
            }

            .profile-detail-row {
                padding: 12px 0;
                border-bottom: 1px dashed #e2e8f0;
            }
            .profile-detail-row:last-child {
                border-bottom: none;
            }
        </style>
    </x-slot:hadeOptional>

    <x-slot:content>
        <div class="dashboard-container container-fluid py-2">
            
            {{-- Welcome Card --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card welcome-card p-4 shadow-sm">
                        <div class="card-body p-2 d-flex flex-md-row flex-column justify-content-between align-items-md-center">
                            <div>
                                <span class="badge bg-white text-emerald-900 px-3 py-2 rounded-pill font-weight-bold mb-2 text-uppercase" style="color: #064e3b; background-color: #d1fae5;">Dashboard Pegawai</span>
                                <h1 class="h2 font-weight-bold mt-2 text-white">Selamat Datang, {{ auth()->user()->biodata->nama_lengkap ?? auth()->user()->name }}!</h1>
                                <p class="lead mb-0 text-emerald-100 opacity-75" style="font-size: 1.1rem; color: #a7f3d0;">
                                    Kelola dokumen kinerja, unggah laporan kegiatan Anda, dan tinjau catatan instruksi pimpinan di sini.
                                </p>
                            </div>
                            <div class="mt-md-0 mt-3 text-md-right text-left text-emerald-100" style="color: #a7f3d0;">
                                <div class="font-weight-bold h5 mb-0 text-white"><i class="fa-regular fa-calendar-days mr-2"></i>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
                                <small class="opacity-75">Waktu Server</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats & Profile Grid --}}
            <div class="row mb-4">
                {{-- Left: Stats --}}
                <div class="col-lg-4 mb-4">
                    <div class="row">
                        {{-- Dokumen Kinerja Saya Card --}}
                        <div class="col-12 mb-4">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Dokumen Kinerja Saya</h6>
                                        <h2 class="font-weight-bold mb-0 text-gray-800">{{ $dokumen_kinerja }}</h2>
                                    </div>
                                    <div class="stat-icon bg-grad-blue">
                                        <i class="fa-solid fa-file-contract"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Catatan Card --}}
                        <div class="col-12 mb-4">
                            <div class="card stat-card shadow-sm">
                                <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Catatan Pembinaan</h6>
                                        <h2 class="font-weight-bold mb-0 text-gray-800">{{ $catatan }}</h2>
                                    </div>
                                    <div class="stat-icon bg-grad-amber">
                                        <i class="fa-solid fa-comments"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Profile Detail Card --}}
                <div class="col-lg-8 mb-4">
                    <div class="card card-modern shadow-sm h-100">
                        <div class="card-modern-header">
                            <h5 class="font-weight-bold text-gray-800 mb-0"><i class="fa-solid fa-address-card mr-2 text-success"></i>Profil Pegawai</h5>
                        </div>
                        <div class="card-body">
                            <div class="profile-detail-row d-flex justify-content-between">
                                <span class="font-weight-medium text-muted">Nama Lengkap</span>
                                <span class="font-weight-bold text-gray-800">{{ auth()->user()->biodata->nama_lengkap ?? auth()->user()->name }}</span>
                            </div>
                            <div class="profile-detail-row d-flex justify-content-between">
                                <span class="font-weight-medium text-muted">NIP / Nomor Identitas</span>
                                <span class="font-weight-bold text-gray-800">{{ auth()->user()->nip ?? '-' }}</span>
                            </div>
                            <div class="profile-detail-row d-flex justify-content-between">
                                <span class="font-weight-medium text-muted">Jabatan</span>
                                <span class="font-weight-bold text-gray-800">{{ auth()->user()->biodata->jabatan->nama_jabatan ?? '-' }}</span>
                            </div>
                            <div class="profile-detail-row d-flex justify-content-between">
                                <span class="font-weight-medium text-muted">Pangkat / Golongan</span>
                                <span class="font-weight-bold text-gray-800">{{ auth()->user()->biodata->pangkat_golongan ?? '-' }}</span>
                            </div>
                            <div class="profile-detail-row d-flex justify-content-between">
                                <span class="font-weight-medium text-muted">Bidang Tugas</span>
                                <span class="font-weight-bold text-gray-800">{{ auth()->user()->biodata->bidang ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Links / Actions --}}
            <div class="row">
                <div class="col-12">
                    <div class="card card-modern shadow-sm">
                        <div class="card-modern-header">
                            <h5 class="font-weight-bold text-gray-800 mb-0"><i class="fa-solid fa-rocket mr-2 text-success"></i>Pintasan Menu Utama</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('dokument-kinerja.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-blue" style="font-size: 1.75rem;"><i class="fa-solid fa-file-invoice"></i></div>
                                        <div class="font-weight-bold small">Dokumen Kinerja Saya</div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('catatan.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-warning" style="font-size: 1.75rem;"><i class="fa-solid fa-envelope-open-text"></i></div>
                                        <div class="font-weight-bold small">Lihat Catatan Pembinaan</div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <a href="{{ route('profile.edit') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-success" style="font-size: 1.75rem;"><i class="fa-solid fa-user-edit"></i></div>
                                        <div class="font-weight-bold small">Perbaharui Profil Saya</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-slot:content>
</x-dashboard.layouts.base-dashboard>
