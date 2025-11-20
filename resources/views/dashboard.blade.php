
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rekam Medis Elektronik</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            color: #333;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            flex-direction: column;
            gap: 15px;
        }

        .sidebar.collapsed .sidebar-header {
            padding: 20px 10px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
        }

        .sidebar.collapsed .logo-container {
            justify-content: center;
        }

        .logo {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #1e3a8a;
            font-size: 20px;
            flex-shrink: 0;
        }

        .sidebar-title {
            font-size: 14px;
            font-weight: 600;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar.collapsed .sidebar-title {
            display: none;
        }

        .toggle-btn {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            align-self: center;
        }

        .toggle-btn:hover {
            background: rgba(255,255,255,0.2);
        }

        .user-profile {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 12px;
            opacity: 0.8;
        }

        .sidebar.collapsed .user-info {
            display: none;
        }

        /* Menu Styles */
        .menu {
            padding: 10px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            border-left-color: #60a5fa;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.15);
            border-left-color: white;
        }

        .menu-item i {
            width: 24px;
            font-size: 18px;
            margin-right: 12px;
        }

        .sidebar.collapsed .menu-item {
            justify-content: center;
            padding: 12px;
        }

        .sidebar.collapsed .menu-item i {
            margin-right: 0;
        }

        .sidebar.collapsed .menu-item span {
            display: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .top-bar-left h1 {
            font-size: 24px;
            color: #1e3a8a;
            font-weight: 600;
        }

        .top-bar-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f0f2f5;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            color: #1e3a8a;
            position: relative;
        }

        .icon-btn:hover {
            background: #e0e7ff;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: bold;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        /* Content Area */
        .content {
            padding: 30px;
        }

        .date-filter {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .date-filter select,
        .date-filter input {
            padding: 10px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .date-filter select:focus,
        .date-filter input:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .date-filter button {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .date-filter button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        /* Chart Grid */
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }

        .chart-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .chart-card h3 {
            color: #1e3a8a;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .chart-placeholder {
            width: 100%;
            height: 300px;
            position: relative;
        }

        .chart-placeholder canvas {
            max-height: 300px;
        }

        /* Table Styles */
        .table-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h3 {
            color: #1e3a8a;
            font-size: 18px;
            font-weight: 600;
        }

        .table-controls {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .search-box {
            padding: 8px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            width: 250px;
            transition: all 0.3s;
        }

        .search-box:focus {
            outline: none;
            border-color: #3b82f6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 14px;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #64748b;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-style: italic;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .action-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar .sidebar-title,
            .sidebar .user-info,
            .sidebar .menu-item span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }

            .date-filter {
                flex-wrap: wrap;
            }

            .top-bar {
                padding: 16px 20px;
            }

            .content {
                padding: 20px;
            }
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        @include('components.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="top-bar-left">
                    <h1>Beranda</h1>
                </div>
                <div class="top-bar-right">
                    <button class="icon-btn">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </button>
                    <button class="icon-btn">
                        <i class="fab fa-whatsapp"></i>
                    </button>
                    <button class="icon-btn">
                        <i class="fas fa-qrcode"></i>
                    </button>
                    <button class="icon-btn">
                        <i class="fas fa-comments"></i>
                    </button>
                    <button class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Date Filter -->
                <div class="date-filter">
                    <select>
                        <option>(Semua Departemen)</option>
                    </select>
                    <input type="date" value="2025-11-13">
                    <span>s.d</span>
                    <input type="date" value="2025-11-20">
                    <button><i class="fas fa-edit"></i></button>
                </div>

                <!-- Charts -->
                <div class="chart-grid">
                    <div class="chart-card">
                        <h3>Grafik Kunjungan</h3>
                        <div class="chart-placeholder">
                            <canvas id="chartKunjungan"></canvas>
                        </div>
                    </div>
                    <div class="chart-card">
                        <h3>Grafik Pendapatan</h3>
                        <div class="chart-placeholder">
                            <canvas id="chartPendapatan"></canvas>
                        </div>
                    </div>
                </div>

                <div class="chart-grid">
                    <div class="chart-card">
                        <h3>Grafik Pasien</h3>
                        <div class="chart-placeholder">
                            <canvas id="chartPasien"></canvas>
                        </div>
                    </div>
                    <div class="chart-card">
                        <h3>Grafik Kunjungan Jenis Pembayaran</h3>
                        <div class="chart-placeholder">
                            <canvas id="chartPembayaran"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Tables -->
                <div class="table-card">
                    <div class="table-header">
                        <h3>Booking Online</h3>
                        <div class="table-controls">
                            <select>
                                <option>10 entries</option>
                            </select>
                            <input type="text" class="search-box" placeholder="Search...">
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Antrian</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Pasien</th>
                                <th>Keluhan</th>
                                <th>Sumber</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9" class="no-data">Tidak ada data booking online</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <div>Showing 0 to 0 of 0 entries</div>
                        <div>
                            <button>Previous</button>
                            <button>Next</button>
                        </div>
                    </div>
                </div>

                <div class="table-card">
                    <div class="table-header">
                        <h3>Obat akan habis</h3>
                        <div class="table-controls">
                            <select>
                                <option>10 entries</option>
                            </select>
                            <input type="text" class="search-box" placeholder="Search...">
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Obat</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th>No Batch</th>
                                <th>Vendor</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="no-data">No data available in table</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <div>Showing 0 to 0 of 0 entries</div>
                        <div>
                            <button>Previous</button>
                            <button>Next</button>
                        </div>
                    </div>
                </div>

                <div class="table-card">
                    <div class="table-header">
                        <h3>Obat akan kadaluarsa</h3>
                        <div class="table-controls">
                            <select>
                                <option>10 entries</option>
                            </select>
                            <input type="text" class="search-box" placeholder="Search...">
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Obat</th>
                                <th>Tanggal Kadaluarsa</th>
                                <th>Hari Kadaluarsa</th>
                                <th>No Batch</th>
                                <th>Vendor</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="no-data">No data available in table</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <div>Showing 0 to 0 of 0 entries</div>
                        <div>
                            <button>Previous</button>
                            <button>Next</button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="action-btn btn-primary">
                        <i class="fas fa-desktop"></i>
                        Tampilkan Antrian
                    </button>
                    <button class="action-btn btn-secondary">
                        <i class="fas fa-desktop"></i>
                        Tampilkan Antrian (Tab Baru)
                    </button>
                    <button class="action-btn btn-warning">
                        <i class="fas fa-phone"></i>
                        Log Panggilan
                    </button>
                    <button class="action-btn btn-primary">
                        <i class="fas fa-file-medical"></i>
                        APM Antrean FKTP
                    </button>
                    <button class="action-btn btn-primary">
                        <i class="fas fa-file-medical"></i>
                        APM Antrian Saja
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }

        // Close sidebar on mobile when clicking menu item
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    document.getElementById('sidebar').classList.add('collapsed');
                }
            });
        });

        // Chart.js Configuration
        const chartColors = {
            orange: '#fb923c',
            green: '#34d399',
            blue: '#60a5fa',
            cyan: '#22d3ee',
            pink: '#f472b6',
            purple: '#a78bfa',
            red: '#f87171',
            yellow: '#fbbf24'
        };

        // Chart 1: Grafik Kunjungan (Bar Chart)
        const ctxKunjungan = document.getElementById('chartKunjungan').getContext('2d');
        const chartKunjungan = new Chart(ctxKunjungan, {
            type: 'bar',
            data: {
                labels: ['Kamis, 13 Nov 2025', 'Jumat, 14 Nov 2025', 'Sabtu, 15 Nov 2025', 'Senin, 16 Nov 2025', 'Senin, 17 Nov 2025', 'Selasa, 18 Nov 2025', 'Rabu, 19 Nov 2025', 'Kamis, 20 Nov 2025'],
                datasets: [
                    {
                        label: 'Kunjungan Sakit',
                        data: [0, 1, 0, 1, 0, 0, 0, 1],
                        backgroundColor: chartColors.orange,
                        borderRadius: 6
                    },
                    {
                        label: 'Kunjungan Sehat',
                        data: [0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: chartColors.green,
                        borderRadius: 6
                    },
                    {
                        label: 'Rawat Jalan',
                        data: [0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: chartColors.blue,
                        borderRadius: 6
                    },
                    {
                        label: 'Rawat Inap',
                        data: [0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: chartColors.cyan,
                        borderRadius: 6
                    },
                    {
                        label: 'Apotek',
                        data: [0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: chartColors.pink,
                        borderRadius: 6
                    },
                    {
                        label: 'Lab',
                        data: [0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: chartColors.purple,
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5]
                        }
                    }
                }
            }
        });

        // Chart 2: Grafik Pendapatan (Line Chart)
        const ctxPendapatan = document.getElementById('chartPendapatan').getContext('2d');
        const chartPendapatan = new Chart(ctxPendapatan, {
            type: 'line',
            data: {
                labels: ['Kamis, 13 Nov 2025', 'Jumat, 14 Nov 2025', 'Sabtu, 15 Nov 2025', 'Minggu, 16 Nov 2025', 'Senin, 17 Nov 2025', 'Selasa, 18 Nov 2025', 'Rabu, 19 Nov 2025', 'Kamis, 20 Nov 2025'],
                datasets: [
                    {
                        label: 'UMUM / SWASDAYA',
                        data: [0, 1, 0, 0, 0, 0, 0, 1],
                        borderColor: chartColors.blue,
                        backgroundColor: chartColors.blue + '33',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'UMUM DALAM WILAYAH',
                        data: [0, 0, 0, 0, 0, 0, 0, 0],
                        borderColor: chartColors.green,
                        backgroundColor: chartColors.green + '33',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5]
                        }
                    }
                }
            }
        });

        // Chart 3: Grafik Pasien (Bar Chart)
        const ctxPasien = document.getElementById('chartPasien').getContext('2d');
        const chartPasien = new Chart(ctxPasien, {
            type: 'bar',
            data: {
                labels: ['Jumlah Pasien'],
                datasets: [
                    {
                        label: 'UMUM / SWASDAYA',
                        data: [310],
                        backgroundColor: chartColors.blue,
                        borderRadius: 6
                    },
                    {
                        label: 'SKTM',
                        data: [0],
                        backgroundColor: chartColors.green,
                        borderRadius: 6
                    },
                    {
                        label: 'BPJS PBI',
                        data: [55],
                        backgroundColor: chartColors.red,
                        borderRadius: 6
                    },
                    {
                        label: 'BPJS NON PBI',
                        data: [50],
                        backgroundColor: chartColors.yellow,
                        borderRadius: 6
                    },
                    {
                        label: 'JAMKESDA',
                        data: [0],
                        backgroundColor: chartColors.purple,
                        borderRadius: 6
                    },
                    {
                        label: 'UKS',
                        data: [0],
                        backgroundColor: chartColors.pink,
                        borderRadius: 6
                    },
                    {
                        label: 'FDC',
                        data: [0],
                        backgroundColor: '#4338ca',
                        borderRadius: 6
                    },
                    {
                        label: 'MDT',
                        data: [0],
                        backgroundColor: chartColors.orange,
                        borderRadius: 6
                    },
                    {
                        label: 'POSYANDU',
                        data: [10],
                        backgroundColor: chartColors.cyan,
                        borderRadius: 6
                    },
                    {
                        label: 'GRATIS LAINNYA',
                        data: [0],
                        backgroundColor: '#db2777',
                        borderRadius: 6
                    },
                    {
                        label: 'BERBAYAR (Rp 10.000,-)',
                        data: [0],
                        backgroundColor: '#ca8a04',
                        borderRadius: 6
                    },
                    {
                        label: 'BERBAYAR (Rp 20.000,-)',
                        data: [0],
                        backgroundColor: '#65a30d',
                        borderRadius: 6
                    },
                    {
                        label: 'KIR',
                        data: [0],
                        backgroundColor: '#0891b2',
                        borderRadius: 6
                    },
                    {
                        label: 'UMUM DALAM WILAYAH',
                        data: [30],
                        backgroundColor: '#059669',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 10,
                            font: {
                                size: 10
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        max: 350,
                        grid: {
                            borderDash: [5, 5]
                        }
                    }
                }
            }
        });

        // Chart 4: Grafik Kunjungan Jenis Pembayaran (Line Chart)
        const ctxPembayaran = document.getElementById('chartPembayaran').getContext('2d');
        const chartPembayaran = new Chart(ctxPembayaran, {
            type: 'line',
            data: {
                labels: ['Kamis, 13 Nov 2025', 'Jumat, 14 Nov 2025', 'Sabtu, 15 Nov 2025', 'Minggu, 16 Nov 2025', 'Senin, 17 Nov 2025', 'Selasa, 18 Nov 2025', 'Rabu, 19 Nov 2025', 'Kamis, 20 Nov 2025'],
                datasets: [
                    {
                        label: 'UMUM / SWASDAYA',
                        data: [0, 1, 0, 0, 0, 0, 0, 1],
                        borderColor: chartColors.blue,
                        backgroundColor: chartColors.blue + '33',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'UKS',
                        data: [0, 0, 0, 1, 0, 0, 0, 0],
                        borderColor: chartColors.pink,
                        backgroundColor: chartColors.pink + '33',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'UMUM DALAM WILAYAH',
                        data: [0, 0, 0, 0, 0, 0, 0, 1],
                        borderColor: chartColors.green,
                        backgroundColor: chartColors.green + '33',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5]
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>