<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rekam Medis Elektronik</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
/* Tata letak agar isi dashboard tidak tertutup sidebar */
.main-content {
    margin-left: 260px;
    padding: 24px 24px 24px 24px;
    transition: margin-left 0.3s;
}
.sidebar.collapsed ~ .main-content {
    margin-left: 70px;
}
@media (max-width: 900px) {
    .main-content {
        margin-left: 70px !important;
    }
}
.chart-grid {
    display: flex;
    gap: 24px;
    margin-bottom: 24px;
}
.chart-card {
    flex: 1;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    padding: 18px 18px 12px 18px;
    min-width: 0;
    min-height: 320px;
    display: flex;
    flex-direction: column;
}
.chart-placeholder {
    flex: 1;
    min-height: 220px;
}
.table-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    margin-bottom: 24px;
    padding: 18px;
}
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.table-controls {
    display: flex;
    gap: 8px;
    align-items: center;
}
.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 12px;
}
.table th, .table td {
    padding: 8px 10px;
    border: 1px solid #e5e7eb;
    text-align: left;
    font-size: 14px;
}
.no-data {
    text-align: center;
    color: #888;
}
.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
}
.action-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 24px;
}
.action-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    border: none;
    border-radius: 5px;
    padding: 8px 16px;
    font-size: 15px;
    cursor: pointer;
}
.btn-primary {
    background: #185a9d;
    color: #fff;
}
.btn-secondary {
    background: #43cea2;
    color: #fff;
}
.btn-warning {
    background: #fbbf24;
    color: #222;
}
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}
.top-bar-left h1 {
    font-size: 2rem;
    margin: 0;
}
.top-bar-right {
    display: flex;
    align-items: center;
    gap: 12px;
}
.icon-btn {
    background: none;
    border: none;
    color: #185a9d;
    font-size: 20px;
    position: relative;
    cursor: pointer;
}
.icon-btn .badge {
    position: absolute;
    top: -6px;
    right: -8px;
    background: #f87171;
    color: #fff;
    border-radius: 50%;
    font-size: 11px;
    padding: 2px 6px;
}
.logout-btn {
    background: #f87171;
    border: none;
    color: #fff;
    padding: 6px 16px;
    border-radius: 5px;
    font-size: 15px;
    cursor: pointer;
    margin-left: 10px;
}
.date-filter {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
}
.search-box {
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    padding: 4px 8px;
}
.table-responsive {
    max-height: 400px;
    overflow-y: auto;
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
                    <div class="table-responsive">
                        <table class="table">
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
                    </div>
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
                    <div class="table-responsive">
                        <table class="table">
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
                    </div>
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
                    <div class="table-responsive">
                        <table class="table">
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
                    </div>
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