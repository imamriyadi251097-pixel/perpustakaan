<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultimate Super Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #00f7ff;
            --secondary: #ff00ff;
            --glass: rgba(255, 255, 255, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif
        }

        body {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(-45deg, #0f172a, #1e293b, #111827, #1a1a2e);
            background-size: 400% 400%;
            animation: gradient 12s ease infinite;
            color: white;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .sidebar {
            width: 260px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(20px);
            padding: 25px;
            transition: 0.4s;
        }

        .sidebar.collapsed {
            width: 80px
        }

        .sidebar h2 {
            color: var(--primary);
            margin-bottom: 30px
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 12px;
            text-decoration: none;
            color: #cbd5e1;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(0, 247, 255, 0.15);
            box-shadow: 0 0 15px var(--primary);
        }

        .sidebar.collapsed span {
            display: none
        }

        .main {
            flex: 1;
            padding: 30px 40px
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn {
            padding: 8px 18px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            background: var(--secondary);
            color: white;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--glass);
            backdrop-filter: blur(25px);
            padding: 25px;
            border-radius: 20px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px var(--secondary);
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .calendar {
            background: var(--glass);
            padding: 20px;
            border-radius: 20px;
        }

        .calendar td {
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }

        .highlight {
            background: var(--primary);
            color: black;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php
    // Safety fallback agar tidak error
    $dataBuku = $dataBuku ?? 0;
    $dataAnggota = $dataAnggota ?? 0;
    $dataPinjam = $dataPinjam ?? 0;
    $tanggalPinjam = $tanggalPinjam ?? [];
    $chartBulanan = $chartBulanan ?? [];
    $chartJenis = $chartJenis ?? [];

    $jumlahHari = date('t'); // jumlah hari bulan ini
    ?>

    <div class="sidebar" id="sidebar">
        <h2>⚡ AdminLTE X</h2>

        <a href="/dashboard"><i class="fas fa-home"></i><span>Dashboard</span></a>
        <a href="/buku"><i class="fas fa-book"></i><span>Buku</span></a>
        <a href="/anggota"><i class="fas fa-users"></i><span>Anggota</span></a>
        <a href="/peminjaman"><i class="fas fa-file-alt"></i><span>Peminjaman</span></a>

        <a href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <div class="main">

        <div class="topbar">
            <h1>Halo, <?= session()->get('username') ?> 👋</h1>
            <button class="btn" onclick="toggleSidebar()">☰</button>
        </div>

        <!-- Statistik -->
        <div class="stats">
            <div class="card">
                <h2><?= $dataBuku ?></h2>
                <p>Total Buku</p>
            </div>
            <div class="card">
                <h2><?= $dataAnggota ?></h2>
                <p>Total Anggota</p>
            </div>
            <div class="card">
                <h2><?= $dataPinjam ?></h2>
                <p>Total Peminjaman</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="chart-grid">
            <div class="card"><canvas id="barChart"></canvas></div>
            <div class="card"><canvas id="lineChart"></canvas></div>
            <div class="card"><canvas id="donutChart"></canvas></div>
        </div>

        <!-- Kalender -->
        <div class="calendar">
            <h3>Kalender Peminjaman Bulan Ini</h3>
            <table>
                <tr>
                    <?php for ($i = 1; $i <= $jumlahHari; $i++):
                        $highlight = false;

                        foreach ($tanggalPinjam as $t) {
                            if ($t['hari'] == $i) {
                                $highlight = true;
                                break;
                            }
                        }
                    ?>
                        <td class="<?= $highlight ? 'highlight' : '' ?>">
                            <?= $i ?>
                        </td>

                        <?php if ($i % 7 == 0) echo "</tr><tr>"; ?>

                    <?php endfor; ?>
                </tr>
            </table>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
        }

        // Safe chart data
        const chartBulanan = <?= json_encode($chartBulanan) ?> || [];
        const chartJenis = <?= json_encode($chartJenis) ?> || [];

        const bulanLabel = chartBulanan.map(item => "Bulan " + item.bulan);
        const bulanData = chartBulanan.map(item => item.total);

        const jenisLabel = chartJenis.map(item => item.jenis);
        const jenisData = chartJenis.map(item => item.total);

        // BAR
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Buku', 'Anggota', 'Pinjam'],
                datasets: [{
                    data: [<?= $dataBuku ?>, <?= $dataAnggota ?>, <?= $dataPinjam ?>],
                    backgroundColor: ['#00f7ff', '#ff00ff', '#22d3ee']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // LINE
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: bulanLabel,
                datasets: [{
                    label: 'Peminjaman',
                    data: bulanData,
                    borderColor: '#00f7ff',
                    tension: 0.4
                }]
            }
        });

        // DONUT
        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                labels: jenisLabel,
                datasets: [{
                    data: jenisData,
                    backgroundColor: ['#ff00ff', '#00f7ff', '#22d3ee', '#facc15']
                }]
            }
        });
    </script>

</body>

</html>