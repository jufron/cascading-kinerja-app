<x-dashboard.layouts.base-dashboard title="Dashboard Admin">
    <x-slot:hadeOptional>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');

            .dashboard-container {
                font-family: 'Outfit', 'Nunito', sans-serif;
                color: #1f2937;
            }

            .welcome-card {
                background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
                border: none;
                border-radius: 20px;
                color: #ffffff;
                overflow: hidden;
                position: relative;
                box-shadow: 0 10px 30px rgba(49, 46, 129, 0.15);
            }

            .welcome-card::after {
                content: '';
                position: absolute;
                top: -50px;
                right: -50px;
                width: 200px;
                height: 200px;
                background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(99, 102, 241, 0) 70%);
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
            .bg-grad-emerald { background: linear-gradient(135deg, #059669, #10b981); }
            .bg-grad-amber { background: linear-gradient(135deg, #d97706, #f59e0b); }
            .bg-grad-purple { background: linear-gradient(135deg, #7c3aed, #a78bfa); }

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

            .progress-custom {
                height: 8px;
                border-radius: 10px;
                background-color: #f1f5f9;
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

            .status-indicator {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                display: inline-block;
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
                                <span class="badge bg-white text-indigo-900 px-3 py-2 rounded-pill font-weight-bold mb-2 text-uppercase" style="color: #1e1b4b; background-color: #e0e7ff;">Sistem Cascading Kinerja</span>
                                <h1 class="h2 font-weight-bold mt-2 text-white">Selamat Datang, {{ auth()->user()->name }}!</h1>
                                <p class="lead mb-0 text-indigo-100 opacity-75" style="font-size: 1.1rem; color: #c7d2fe;">
                                    Anda login sebagai <strong class="text-white">Admin</strong>. Kelola semua pengguna, jabatan, dokumen kinerja, dan laporan di sini.
                                </p>
                            </div>
                            <div class="mt-md-0 mt-3 text-md-right text-left text-indigo-100" style="color: #c7d2fe;">
                                <div class="font-weight-bold h5 mb-0 text-white"><i class="fa-regular fa-calendar-days mr-2"></i>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
                                <small class="opacity-75">Waktu Server</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="row mb-4">
                {{-- Admin Card --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card shadow-sm">
                        <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total Admin</h6>
                                <h2 class="font-weight-bold mb-0 text-gray-800">{{ $daftar_admin }}</h2>
                            </div>
                            <div class="stat-icon bg-grad-purple">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pejabat Atasan Card --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card shadow-sm">
                        <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Pejabat Atasan</h6>
                                <h2 class="font-weight-bold mb-0 text-gray-800">{{ $daftar_pejabat_atasan }}</h2>
                            </div>
                            <div class="stat-icon bg-grad-indigo">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dokumen Kinerja Card --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card shadow-sm">
                        <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Dokumen Kinerja</h6>
                                <h2 class="font-weight-bold mb-0 text-gray-800">{{ $dokumen_kinerja }}</h2>
                            </div>
                            <div class="stat-icon bg-grad-emerald">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Catatan Card --}}
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card shadow-sm">
                        <div class="card-body stat-card-inner d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="text-muted text-uppercase font-weight-bold mb-1" style="font-size: 0.8rem; letter-spacing: 0.5px;">Total Catatan</h6>
                                <h2 class="font-weight-bold mb-0 text-gray-800">{{ $catatan }}</h2>
                            </div>
                            <div class="stat-icon bg-grad-amber">
                                <i class="fa-solid fa-comments"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Row for Visual Data --}}
            <div class="row mb-4">
                {{-- Left Side: Reports Status --}}
                <div class="col-lg-7 mb-4">
                    <div class="card card-modern shadow-sm h-100">
                        <div class="card-modern-header d-flex align-items-center justify-content-between">
                            <h5 class="font-weight-bold text-gray-800 mb-0"><i class="fa-solid fa-square-poll-vertical mr-2 text-indigo"></i>Status Validasi Laporan</h5>
                            <span class="badge bg-indigo-100 text-indigo-800 font-weight-bold px-3 py-2 rounded-pill" style="background-color: #e0e7ff; color: #4338ca;">
                                Total: {{ $validasi_laporan }} Laporan
                            </span>
                        </div>
                        <div class="card-body">
                            {{-- Disetujui --}}
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-medium text-gray-700"><span class="status-indicator mr-2" style="background-color: #10b981;"></span>Disetujui</span>
                                    <span class="font-weight-bold">{{ $validasi_laporan_disetujui }} ({{ $validasi_laporan > 0 ? round(($validasi_laporan_disetujui / $validasi_laporan) * 100, 1) : 0 }}%)</span>
                                </div>
                                <div class="progress progress-custom">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $validasi_laporan > 0 ? ($validasi_laporan_disetujui / $validasi_laporan) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            {{-- Menunggu Persetujuan --}}
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-medium text-gray-700"><span class="status-indicator mr-2" style="background-color: #f59e0b;"></span>Menunggu Persetujuan</span>
                                    <span class="font-weight-bold">{{ $validation_laporan_menunggu_persetujuan }} ({{ $validasi_laporan > 0 ? round(($validation_laporan_menunggu_persetujuan / $validasi_laporan) * 100, 1) : 0 }}%)</span>
                                </div>
                                <div class="progress progress-custom">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $validasi_laporan > 0 ? ($validation_laporan_menunggu_persetujuan / $validasi_laporan) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            {{-- Diproses --}}
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-medium text-gray-700"><span class="status-indicator mr-2" style="background-color: #3b82f6;"></span>Diproses</span>
                                    <span class="font-weight-bold">{{ $validasi_laporan_diproses }} ({{ $validasi_laporan > 0 ? round(($validasi_laporan_diproses / $validasi_laporan) * 100, 1) : 0 }}%)</span>
                                </div>
                                <div class="progress progress-custom">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $validasi_laporan > 0 ? ($validasi_laporan_diproses / $validasi_laporan) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            {{-- Dibaca --}}
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-medium text-gray-700"><span class="status-indicator mr-2" style="background-color: #6b7280;"></span>Dibaca</span>
                                    <span class="font-weight-bold">{{ $validasi_laporan_dibaca }} ({{ $validasi_laporan > 0 ? round(($validasi_laporan_dibaca / $validasi_laporan) * 100, 1) : 0 }}%)</span>
                                </div>
                                <div class="progress progress-custom">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $validasi_laporan > 0 ? ($validasi_laporan_dibaca / $validasi_laporan) * 100 : 0 }}%"></div>
                                </div>
                            </div>

                            {{-- Tidak Disetujui --}}
                            <div class="mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="font-weight-medium text-gray-700"><span class="status-indicator mr-2" style="background-color: #ef4444;"></span>Tidak Disetujui</span>
                                    <span class="font-weight-bold">{{ $validasi_laporan_tidak_disetujui }} ({{ $validasi_laporan > 0 ? round(($validasi_laporan_tidak_disetujui / $validasi_laporan) * 100, 1) : 0 }}%)</span>
                                </div>
                                <div class="progress progress-custom">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $validasi_laporan > 0 ? ($validasi_laporan_tidak_disetujui / $validasi_laporan) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Chart --}}
                <div class="col-lg-5 mb-4">
                    <div class="card card-modern shadow-sm h-100">
                        <div class="card-modern-header">
                            <h5 class="font-weight-bold text-gray-800 mb-0"><i class="fa-solid fa-chart-pie mr-2 text-indigo"></i>Visualisasi Status</h5>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div style="position: relative; height:220px; width:220px;">
                                <canvas id="reportDoughnutChart"></canvas>
                            </div>
                            <div class="mt-4 d-flex flex-wrap justify-content-center gap-3 text-xs text-muted" style="gap: 15px;">
                                <span class="d-flex align-items-center"><span class="status-indicator mr-1" style="background-color: #10b981;"></span> Setuju</span>
                                <span class="d-flex align-items-center"><span class="status-indicator mr-1" style="background-color: #f59e0b;"></span> Pending</span>
                                <span class="d-flex align-items-center"><span class="status-indicator mr-1" style="background-color: #3b82f6;"></span> Proses</span>
                                <span class="d-flex align-items-center"><span class="status-indicator mr-1" style="background-color: #6b7280;"></span> Dibaca</span>
                                <span class="d-flex align-items-center"><span class="status-indicator mr-1" style="background-color: #ef4444;"></span> Ditolak</span>
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
                            <h5 class="font-weight-bold text-gray-800 mb-0"><i class="fa-solid fa-bolt mr-2 text-indigo"></i>Pintasan Akses Cepat</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('daftar-admin.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-purple" style="font-size: 1.75rem;"><i class="fa-solid fa-user-shield"></i></div>
                                        <div class="font-weight-bold small">Daftar Admin</div>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('pejabat-atasan.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-indigo" style="font-size: 1.75rem;"><i class="fa-solid fa-user-tie"></i></div>
                                        <div class="font-weight-bold small">Pejabat Atasan</div>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('dokument-kinerja.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-success" style="font-size: 1.75rem;"><i class="fa-solid fa-file-contract"></i></div>
                                        <div class="font-weight-bold small">Dokumen Kinerja</div>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('catatan.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-warning" style="font-size: 1.75rem;"><i class="fa-solid fa-comment-dots"></i></div>
                                        <div class="font-weight-bold small">Catatan Sistem</div>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('laporan.index') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-info" style="font-size: 1.75rem;"><i class="fa-solid fa-list-check"></i></div>
                                        <div class="font-weight-bold small">Validasi Laporan</div>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-md-4 col-sm-6 mb-3">
                                    <a href="{{ route('profile.edit') }}" class="card quick-action-card p-3 h-100 text-center">
                                        <div class="mb-2 text-danger" style="font-size: 1.75rem;"><i class="fa-solid fa-user-gear"></i></div>
                                        <div class="font-weight-bold small">Profil Saya</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-slot:content>

    <x-slot:buttonOptional>
        {{-- Load Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const ctx = document.getElementById('reportDoughnutChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Disetujui', 'Menunggu Persetujuan', 'Diproses', 'Dibaca', 'Tidak Disetujui'],
                        datasets: [{
                            data: [
                                {{ $validasi_laporan_disetujui }},
                                {{ $validation_laporan_menunggu_persetujuan }},
                                {{ $validasi_laporan_diproses }},
                                {{ $validasi_laporan_dibaca }},
                                {{ $validasi_laporan_tidak_disetujui }}
                            ],
                            backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#6b7280', '#ef4444'],
                            borderWidth: 2,
                            borderColor: '#ffffff',
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                padding: 12,
                                boxPadding: 8,
                                font: {
                                    family: "'Outfit', 'Nunito', sans-serif"
                                }
                            }
                        },
                        cutout: '70%'
                    }
                });
            });
        </script>
    </x-slot:buttonOptional>
</x-dashboard.layouts.base-dashboard>
