<!-- app/Views/dashboard_siswa.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa Premium</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset & Font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: url('/assets/img/bg-dashboard.jpg') no-repeat center center/cover;
            display: flex;
            color: #fff;
        }

        /* Overlay gelap untuk readability */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: -1;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            transition: all 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1abc9c;
            font-size: 2rem;
            letter-spacing: 1px;
        }

        /* Menu Kartu */
        .menu-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .menu-card i {
            font-size: 1.5rem;
            color: #1abc9c;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .menu-card span {
            font-size: 1.1rem;
            color: #fff;
            transition: color 0.3s ease;
        }

        .menu-card:hover {
            background: rgba(26, 188, 156, 0.85);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 15px 30px rgba(26, 188, 156, 0.6);
        }

        .menu-card:hover i {
            transform: rotate(20deg) scale(1.3);
            color: #fff;
        }

        .menu-card:hover span {
            color: #fff;
        }

        /* Main content */
        .main-content {
            flex: 1;
            padding: 50px;
            margin: 30px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        .main-content h2 {
            font-size: 2.5rem;
            color: #1abc9c;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .welcome {
            font-size: 1.3rem;
            margin-bottom: 30px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-content {
                margin: 20px 15px;
                padding: 35px;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                padding: 15px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .sidebar h2 {
                display: none;
            }

            .menu-card {
                flex: 1;
                justify-content: center;
            }

            .menu-card span {
                display: none;
            }

            .main-content {
                margin: 20px 10px;
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Siswa</h2>
        <a href="/buku" class="menu-card">
            <i class="fas fa-book"></i>
            <span>Lihat Buku</span>
        </a>
        <a href="/peminjaman" class="menu-card">
            <i class="fas fa-calendar-check"></i>
            <span>Data Peminjaman Saya</span>
        </a>
        <a href="/logout" class="menu-card">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <div class="main-content">
        <h2>Dashboard Siswa</h2>
        <p class="welcome">Selamat datang, <?= session()->get('username') ?> 👋</p>
        <p>Gunakan menu di sebelah kiri untuk mengakses semua fitur. Nikmati pengalaman dashboard modern, elegan, dan interaktif!</p>
    </div>
</body>

</html>