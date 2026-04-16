<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #ec4899;
            --bg: #f4f7fb;
            --card: #ffffff;
            --text: #0f172a;
            --sub: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #4f46e5, #6366f1);
            padding: 25px;
            color: #fff;
        }

        .sidebar h2 {
            font-weight: 700;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.85);
            transition: .2s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .main {
            flex: 1;
            padding: 25px;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 20px;
            font-weight: 600;
        }

        .btn {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            color: white;
            cursor: pointer;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: var(--card);
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            position: relative;
            overflow: hidden;
            transition: .3s;
        }

        .card::before {
            content: "";
            height: 4px;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card i {
            font-size: 22px;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .card h2 {
            font-size: 26px;
            font-weight: 700;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .calendar {
            background: var(--card);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        }

        .calendar table {
            width: 100%;
            border-collapse: collapse;
        }

        .calendar td {
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }

        .highlight {
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
        }

        .footer {
            margin-top: auto;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: var(--sub);
        }

        /* ===== TAMBAHAN KALENDER ===== */
        .calendar h3 {
            font-size: 16px;
            font-weight: 600;
            text-align: center;
        }

        .calendar td {
            text-align: center;
            padding: 12px;
            border-radius: 10px;
            transition: 0.2s;
        }

        .calendar td:hover {
            background: #eef2ff;
            cursor: pointer;
        }

        .calendar tr:first-child td {
            font-weight: 600;
            color: var(--sub);
        }

        .calendar button {
            padding: 6px 12px;
            border-radius: 8px;
            border: none;
            background: linear-gradient(45deg, var(--primary), var(--secondary));
            color: #fff;
            cursor: pointer;
        }

        body.dark {
            --bg: #0f172a;
            --card: #1e293b;
            --text: #f1f5f9;
            --sub: #94a3b8;
        }
    </style>
</head>

<body>

    <div id="notif" style="
position:fixed;
top:20px;
right:20px;
background:#4f46e5;
color:#fff;
padding:10px 20px;
border-radius:10px;
display:none;
z-index:999;
">
        Login Berhasil 👋
    </div>

    <?php
    $dataBuku = $dataBuku ?? 0;
    $dataAnggota = $dataAnggota ?? 0;
    $dataPinjam = $dataPinjam ?? 0;
    $dataKembali = $dataKembali ?? 0; // TAMBAHAN
    $tanggalPinjam = $tanggalPinjam ?? [];
    $chartBulanan = $chartBulanan ?? [];
    $chartJenis = $chartJenis ?? [];
    $jumlahHari = date('t');
    ?>

    <div class="sidebar">
        <h2>⚡ Admin Pro</h2>
        <a href="/dashboard"><i class="fas fa-home"></i>Dashboard</a>
        <a href="/buku"><i class="fas fa-book"></i>Buku</a>
        <a href="/anggota"><i class="fas fa-users"></i>Anggota</a>
        <a href="/peminjaman"><i class="fas fa-file-alt"></i>Peminjaman</a>

        <!-- INI YANG KURANG -->
        <a href="<?= base_url('logout') ?>">
            <i class="fas fa-sign-out-alt"></i>Logout
        </a>
    </div>

    <div class="main">

        <div class="topbar">
            <h1>Halo, <?= session()->get('username') ?> 👋</h1>
            <button onclick="toggleDark()" class="btn">🌙</button>
        </div>

        <!-- STATS -->
        <div class="stats">
            <div class="card">
                <i class="fas fa-book"></i>
                <h2><?= $dataBuku ?></h2>
                <p>Total Buku</p>
            </div>

            <div class="card">
                <i class="fas fa-users"></i>
                <h2><?= $dataAnggota ?></h2>
                <p>Total Anggota</p>
            </div>

            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h2><?= $dataPinjam ?></h2>
                <p>Total Peminjaman</p>
            </div>

            <!-- TAMBAHAN -->
            <div class="card">
                <i class="fas fa-check-circle"></i>
                <h2><?= $dataKembali ?></h2>
                <p>Pengembalian</p>
            </div>
        </div>

        <!-- CHART -->
        <div class="chart-grid">
            <div class="card"><canvas id="barChart"></canvas></div>
            <div class="card"><canvas id="lineChart"></canvas></div>
            <div class="card"><canvas id="donutChart"></canvas></div>

            <!-- TAMBAHAN -->
            <div class="card"><canvas id="statusChart"></canvas></div>
        </div>

        <!-- CALENDAR -->
        <div class="calendar">

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                <button onclick="prevMonth()" class="btn">←</button>
                <h3 id="calendarTitle"></h3>
                <button onclick="nextMonth()" class="btn">→</button>
            </div>

            <table id="calendarTable">
            </table>

        </div>

        <!-- FOOTER -->
        <div class="footer">
            © <?= date('Y') ?> Sistem Perpustakaan | Developed by Imam Riyadi 🚀
        </div>

    </div>

    <script>
        const chartBulanan = <?= json_encode($chartBulanan) ?> || [];
        const chartJenis = <?= json_encode($chartJenis) ?> || [];

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Buku', 'Anggota', 'Pinjam'],
                datasets: [{
                    data: [<?= $dataBuku ?>, <?= $dataAnggota ?>, <?= $dataPinjam ?>]
                }]
            }
        });

        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: chartBulanan.map(i => i.bulan),
                datasets: [{
                    data: chartBulanan.map(i => i.total)
                }]
            }
        });

        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                labels: chartJenis.map(i => i.jenis),
                datasets: [{
                    data: chartJenis.map(i => i.total)
                }]
            }
        });

        /* TAMBAHAN */
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: ['Dipinjam', 'Dikembalikan'],
                datasets: [{
                    data: [<?= $dataPinjam - $dataKembali ?>, <?= $dataKembali ?>]
                }]
            }
        });
    </script>
    <script>
        const bulanNama = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        let currentDate = new Date();

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            document.getElementById("calendarTitle").innerText =
                bulanNama[month] + " " + year;

            let html = `
            <tr style="color: var(--sub); font-weight:600;">
                <td>Min</td><td>Sen</td><td>Sel</td>
                <td>Rab</td><td>Kam</td><td>Jum</td><td>Sab</td>
            </tr><tr>
        `;

            for (let i = 0; i < firstDay; i++) {
                html += "<td></td>";
            }

            for (let i = 1; i <= lastDate; i++) {

                let highlight = "";

                <?php
                // kirim tanggalPinjam ke JS
                $tanggalJS = array_map(function ($t) {
                    return (int)$t['hari'];
                }, $tanggalPinjam);
                ?>
                const hariPinjam = <?= json_encode($tanggalJS) ?>;

                if (hariPinjam.includes(i)) {
                    highlight = "highlight";
                }

                html += `<td class="${highlight}">${i}</td>`;

                if ((i + firstDay) % 7 === 0) {
                    html += "</tr><tr>";
                }
            }

            html += "</tr>";

            document.getElementById("calendarTable").innerHTML = html;
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        }

        function prevMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        }

        renderCalendar();
    </script>
    <script>
        function toggleDark() {
            document.body.classList.toggle('dark');
        }
    </script>
    <script>
        function animateValue(el, start, end, duration) {
            let startTime = null;

            function step(currentTime) {
                if (!startTime) startTime = currentTime;
                const progress = Math.min((currentTime - startTime) / duration, 1);
                el.innerText = Math.floor(progress * (end - start) + start);

                if (progress < 1) {
                    requestAnimationFrame(step);
                }
            }

            requestAnimationFrame(step);
        }

        document.querySelectorAll('.card h2').forEach(el => {
            let val = parseInt(el.innerText);
            animateValue(el, 0, val, 800);
        });
    </script>
    <script>
        function showNotif() {
            const n = document.getElementById('notif');
            n.style.display = 'block';
            setTimeout(() => n.style.display = 'none', 3000);
        }

        showNotif();
    </script>

</body>

</html>