<x-dashboard.layouts.base-dashboard title="Dashboard Pimpinan">
    <x-slot:hadeOptional>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');

            .dashboard-container {
                font-family: 'Outfit', 'Nunito', sans-serif;
                color: #1f2937;
            }

            .welcome-card {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                border: none;
                border-radius: 20px;
                color: #ffffff;
                overflow: hidden;
                position: relative;
                box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
            }

            .welcome-card::after {
                content: '';
                position: absolute;
                top: -50px;
                right: -50px;
                width: 200px;
                height: 200px;
                background: radial-gradient(circle, rgba(148, 163, 184, 0.15) 0%, rgba(148, 163, 184, 0) 70%);
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

            .bg-grad-indigo { background: linear-gradient(135deg, #4f46e5, #6366f1); }
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

            .role-bullet {
                display: flex;
                align-items: flex-start;
                margin-bottom: 1rem;
            }

            .role-bullet-icon {
                color: #4f46e5;
                font-size: 1.15rem;
                margin-top: 2px;
                margin-right: 12px;
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
                                <span class="badge bg-white text-slate-900 px-3 py-2 rounded-pill font-weight-bold mb-2 text-uppercase" style="color: #0f172a; background-color: #f1f5f9;">Dashboard Eksekutif</span>
                                <h1 class="h2 font-weight-bold mt-2 text-white">Selamat Datang, {{ auth()->user()->name }}!</h1>
                                <p class="lead mb-0 text-slate-200 opacity-75" style="font-size: 1.1rem; color: #cbd5e1;">
                                    Anda login sebagai <strong class="text-white">Pimpinan</strong>. Pantau kinerja organisasi, tinjau dokumen, dan berikan validasi laporan pegawai.
                                </p>
                            </div>
                            <div class="mt-md-0 mt-3 text-md-right text-left text-slate-200" style="color: #cbd5e1;">
                                <div class="font-weight-bold h5 mb-0 text-white"><i class="fa-regular fa-calendar-days mr-2"></i>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
                                <small class="opacity-75">Waktu Server</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="row mb-4">
                {{-- Dokumen Kinerja Card --}}
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card stat-card shadow-sm">
                        <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Dokumen Kinerja</h6>
                                <h2 class="font-weight-bold mb-0 text-gray-800">{{ $dokumen_kinerja }}</h2>
                            </div>
                            <div class="stat-icon bg-grad-blue">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Rekan Pimpinan Card --}}
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card stat-card shadow-sm">
                        <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Rekan Pimpinan</h6>
                                <h2 class="font-weight-bold mb-0 text-gray-800">{{ $userPimpinann }}</h2>
                            </div>
                            <div class="stat-icon bg-grad-indigo">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Catatan Card --}}
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card stat-card shadow-sm">
                        <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Catatan Sistem</h6>
                                <h2 class="font-weight-bold mb-0 text-gray-800">{{ $catatan }}</h2>
                            </div>
                            <div class="stat-icon bg-grad-amber">
                                <i class="fa-solid fa-comment-dots"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info & Instructions row --}}
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card card-modern shadow-sm">
                        <div class="card-modern-header">
                            <h5 class="font-weight-bold text-gray-800 mb-0"><i class="fa-solid fa-circle-info mr-2 text-indigo"></i>Panduan & Tanggung Jawab Pimpinan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="role-bullet">
                                        <div class="role-bullet-icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Validasi Laporan Berkala</h6>
                                            <p class="text-muted small mb-0">Tinjau laporan kerja yang diajukan oleh staf, berikan umpan balik (catatan) dan setujui atau tolak dokumen sesuai dengan hasil evaluasi lapangan.</p>
                                        </div>
                                    </div>
                                    <div class="role-bullet">
                                        <div class="role-bullet-icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Monitoring Cascading Kinerja</h6>
                                            <p class="text-muted small mb-0">Pastikan seluruh target cascading terdistribusi secara baik dari tingkat eselon hingga pejabat pelaksana di bawah wewenang Anda.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="role-bullet">
                                        <div class="role-bullet-icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Pemberian Catatan Strategis</h6>
                                            <p class="text-muted small mb-0">Gunakan menu Catatan untuk menulis arahan khusus, koreksi dokumen, atau masukan untuk perbaikan kualitas kinerja pegawai.</p>
                                        </div>
                                    </div>
                                    <div class="role-bullet">
                                        <div class="role-bullet-icon"><i class="fa-solid fa-circle-check"></i></div>
                                        <div>
                                            <h6 class="font-weight-bold mb-1">Unduh & Cetak Laporan</h6>
                                            <p class="text-muted small mb-0">Anda dapat memantau dan mengunduh berkas laporan dalam format digital untuk kebutuhan arsip dinas secara instan.</p>
                                        </div>
                                    </div>
                                </div>
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
                            <h5 class="font-weight-bold text-gray-800 mb-0"><i class="fa-solid fa-bolt mr-2 text-indigo"></i>Akses Menu Utama</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('dokument-kinerja.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-blue" style="font-size: 1.75rem;"><i class="fa-solid fa-file-contract"></i></div>
                                        <div class="font-weight-bold small">Dokumen Kinerja</div>
                                    </a>
                                </div>
                                @can('can-access-report-pegawai')
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('laporan-pegawai.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-indigo" style="font-size: 1.75rem;"><i class="fa-solid fa-file-invoice"></i></div>
                                        <div class="font-weight-bold small">Laporan Pegawai (Eksklusif)</div>
                                    </a>
                                </div>
                                @endcan
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('validasi-laporan.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-emerald" style="font-size: 1.75rem;"><i class="fa-solid fa-clipboard-check"></i></div>
                                        <div class="font-weight-bold small">Validasi Laporan</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <a href="{{ route('catatan.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-warning" style="font-size: 1.75rem;"><i class="fa-solid fa-comment-dots"></i></div>
                                        <div class="font-weight-bold small">Catatan Pembinaan</div>
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
