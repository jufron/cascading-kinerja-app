<x-dashboard.layouts.base-dashboard title="dashboard">
    <x-slot:content>
        {{-- ? Page Heading --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Selamat Datang {{ auth()->user()->getRoleNames()->first() }} | {{ auth()->user()->name }}</h1>
        </div>

        {{-- ? Content Row  --}}
        <div class="row">
            {{--todo Card count total user --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 'user' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- todo Card count total berita --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Daftar Berita</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 'berita' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-newspaper fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- todo Card count total kategory  --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Kategory</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 'kategory' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-newspaper fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- todo Card cound total kontak masuk --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Kontak Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">111</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- ? end Content Row  --}}

        <div class="row">

            {{-- todo line Chart --}}
            {{-- <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kunjungan Perpustakaan dan Lab Komputer Selama 6 Bulan Terakhir</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- todo Pie Chart kategory --}}
            {{-- <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kategory Berita</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2 mt-2 mb-4">
                            <canvas id="chartKategory"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Server Migration <span
                                class="float-right">20%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Sales Tracking <span
                                class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Customer Database <span
                                class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Payout Details <span
                                class="float-right">80%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Account Setup <span
                                class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <!-- Color System -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                Primary
                                <div class="text-white-50 small">#4e73df</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                Success
                                <div class="text-white-50 small">#1cc88a</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-info text-white shadow">
                            <div class="card-body">
                                Info
                                <div class="text-white-50 small">#36b9cc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-warning text-white shadow">
                            <div class="card-body">
                                Warning
                                <div class="text-white-50 small">#f6c23e</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-danger text-white shadow">
                            <div class="card-body">
                                Danger
                                <div class="text-white-50 small">#e74a3b</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-secondary text-white shadow">
                            <div class="card-body">
                                Secondary
                                <div class="text-white-50 small">#858796</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-light text-black shadow">
                            <div class="card-body">
                                Light
                                <div class="text-black-50 small">#f8f9fc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                Dark
                                <div class="text-white-50 small">#5a5c69</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="img/undraw_posting_photo.svg" alt="...">
                        </div>
                        <p>Add some quality, svg illustrations to your project courtesy of <a
                                target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                            constantly updated collection of beautiful svg images that you can use
                            completely free and without attribution!</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                            unDraw &rarr;</a>
                    </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                    </div>
                    <div class="card-body">
                        <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                            CSS bloat and poor page performance. Custom CSS classes are used to create
                            custom components and custom utility classes.</p>
                        <p class="mb-0">Before working with this theme, you should become familiar with the
                            Bootstrap framework, especially the utility classes.</p>
                    </div>
                </div>

            </div>
        </div> --}}
    </x-slot:content>

    <x-slot:buttonOptional>
        {{-- ? Page level plugins  --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {{-- ? Page level custom scripts --}}
        <script src="{{ asset('assets/js/chart.js') }}"></script>

        <script type="module" src="{{ asset('assets/js/dashboard-admin.js') }}"></script>

        <script>
            // chart line
            chart({
                targetElement: document.getElementById('lineChart'),
                chartType: 'line',
                labels: ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli'],
                datasets: [{
                    label: 'Kunjungan Perpustakaan',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: '#b5179e',
                    tension: 0.1
                },{
                    label: 'Kunjungan Lab Komputer',
                    data: [80, 46, 69, 20, 40, 70, 30],
                    fill: false,
                    borderColor: '#fb8500',
                    tension: 0.1
                }]
            });

            // chart bar
            chart({
                targetElement: document.getElementById('chartKategory'),
                chartType: 'doughnut',
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            });

            // kunjungan perpustakaan 1 bulan terakhir
            chart({
                targetElement: document.getElementById('chartBarHorizontalKunjunganPerpust1bulan'),
                chartType: 'bar',
                labels: ['aldi', 'sinta', 'james', 'dodi', 'erik'],
                datasets: [{
                    label: 'Kunjungan Perpustakaan',
                    data: [1, 2, 3, 4, 5],
                    backgroundColor: '#06d6a0',
                }],
                options: {
                    indexAxis: 'y',
                    responsive: true
                }
            });

            // kunjungan perpustakaan 3 bulan terakhir
            chart({
                targetElement: document.getElementById('chartBarHorizontalKunjunganPerpust3bulan'),
                chartType: 'bar',
                labels: ['aldi', 'sinta', 'james', 'dodi', 'erik'],
                datasets: [{
                    label: 'Kunjungan Perpustakaan',
                    data: [1, 2, 3, 4, 5],
                    backgroundColor: '#ef476f',
                }],
                options: {
                    indexAxis: 'y',
                    responsive: true
                }
            });

            // kunjungan perpustakaan 6 bulan terakhir
            chart({
                targetElement: document.getElementById('chartBarHorizontalKunjunganPerpust6bulan'),
                chartType: 'bar',
                labels: ['aldi', 'sinta', 'james', 'dodi', 'erik'],
                datasets: [{
                    label: 'Kunjungan Perpustakaan',
                    data: [1, 2, 3, 4, 5],
                    backgroundColor: '#387478',
                }],
                options: {
                    indexAxis: 'y',
                    responsive: true
                }
            });

            // kunjungan lab komputer 1 bulan terakhir
            chart({
                targetElement: document.getElementById('chartBarHorizontalKunjunganLabKomputer1bulan'),
                chartType: 'bar',
                labels: ['aldi', 'sinta', 'james', 'dodi', 'erik'],
                datasets: [{
                    label: 'Kunjungan Perpustakaan',
                    data: [1, 2, 3, 4, 5],
                    backgroundColor: '#ffd166',
                }],
                options: {
                    indexAxis: 'y',
                    responsive: true
                }
            });

            // kunjungan lab komputer 3 bulan terakhir
            chart({
                targetElement: document.getElementById('chartBarHorizontalKunjunganLabKomputer3bulan'),
                chartType: 'bar',
                labels: ['aldi', 'sinta', 'james', 'dodi', 'erik'],
                datasets: [{
                    label: 'Kunjungan Perpustakaan',
                    data: [1, 2, 3, 4, 5],
                    backgroundColor: '#ff499e',
                }],
                options: {
                    indexAxis: 'y',
                    responsive: true
                }
            });

            // kunjungan lab komputer 6 bulan terakhir
            chart({
                targetElement: document.getElementById('chartBarHorizontalKunjunganLabKomputer6bulan'),
                chartType: 'bar',
                labels: ['aldi', 'sinta', 'james', 'dodi', 'erik'],
                datasets: [{
                    label: 'Kunjungan Perpustakaan',
                    data: [1, 2, 3, 4, 5],
                    backgroundColor: '#9fffcb',
                }],
                options: {
                    indexAxis: 'y',
                    responsive: true
                }
            });

            // kunjungan perpustakaan data prodi 1 bulan terakhir
            chart({
                targetElement: document.getElementById('chart-perpustakaan-jurusan'),
                chartType: 'pie',
                labels: [
                    'Pendidikan Agaka Kristen',
                    'Pendidikan Kristen Guru Sekolah Dasar',
                    'theologi',
                    'lainya'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [11, 16, 14],
                    backgroundColor: [
                        '#d65db1',
                        '#ff9671',
                        '#008e9b',
                        '#b39cd0',
                    ]
                }],
            });

            // kunjungan lab komputer data prodi 1 bulan terakhir
            chart({
                targetElement: document.getElementById('chart-lab-komputer-jurusan'),
                chartType: 'pie',
                labels: [
                    'Pendidikan Agaka Kristen',
                    'Pendidikan Kristen Guru Sekolah Dasar',
                    'theologi',
                    'lainya'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [9, 22, 6],
                    backgroundColor: [
                        '#d65db1',
                        '#ff9671',
                        '#008e9b',
                        '#b39cd0',
                    ]
                }],
            });

            // kunjungan lab komputer data status 1 bulan terakhir
            chart({
                targetElement: document.getElementById('chart-perpustakaan-dan-lab-komputer-status'),
                chartType: 'line',
                labels: [
                    'PAK',
                    'PKGSD',
                    'theologi',
                    'lainya'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [9, 11, 6, 8],
                    backgroundColor: '#00c9a7'
                },
                {
                    label: 'My First Dataset',
                    data: [3, 22, 14, 5],
                    backgroundColor: '#c34a36'
                }],
            });

            // kunjungan lab komputer dan perpustakaan data semester 1 bulan terakhir
            chart({
                targetElement: document.getElementById('chart-perpustakaan-dan-lab-komputer-semester-bulan1'),
                chartType: 'bar',
                labels: [
                    'lainya',
                    'semester 1',
                    'semester 2',
                    'semester 3',
                    'semester 4',
                    'semester 5',
                    'semester 6',
                    'semester 7',
                    'semester 8',
                    'semester 9',
                    'semester 10'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40, 90, 76, 42, 11],
                    backgroundColor: '#00c9a7'
                },
                {
                    label: 'My First Dataset',
                    data: [3, 22, 14, 5, 67, 12, 87, 12, 85, 75, 89],
                    backgroundColor: '#c34a36'
                }],
            });

            // kunjungan lab komputer dan perpustakaan data semester 3 bulan terakhir
            chart({
                targetElement: document.getElementById('chart-perpustakaan-dan-lab-komputer-semester-bulan3'),
                chartType: 'bar',
                labels: [
                    'lainya',
                    'semester 1',
                    'semester 2',
                    'semester 3',
                    'semester 4',
                    'semester 5',
                    'semester 6',
                    'semester 7',
                    'semester 8',
                    'semester 9',
                    'semester 10'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40, 90, 76, 42, 11],
                    backgroundColor: '#00c9a7'
                },
                {
                    label: 'My First Dataset',
                    data: [3, 22, 14, 5, 67, 12, 87, 12, 85, 75, 89],
                    backgroundColor: '#c34a36'
                }],
            });

            // kunjungan lab komputer dan perpustakaan data semester 6 bulan terakhir
            chart({
                targetElement: document.getElementById('chart-perpustakaan-dan-lab-komputer-semester-bulan6'),
                chartType: 'bar',
                labels: [
                    'lainya',
                    'semester 1',
                    'semester 2',
                    'semester 3',
                    'semester 4',
                    'semester 5',
                    'semester 6',
                    'semester 7',
                    'semester 8',
                    'semester 9',
                    'semester 10'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40, 90, 76, 42, 11],
                    backgroundColor: '#00c9a7'
                },
                {
                    label: 'My First Dataset',
                    data: [3, 22, 14, 5, 67, 12, 87, 12, 85, 75, 89],
                    backgroundColor: '#c34a36'
                }],
            });
        </script>
    </x-slot:buttonOptional>
</x-dashboard.layouts.base-dashboard>
