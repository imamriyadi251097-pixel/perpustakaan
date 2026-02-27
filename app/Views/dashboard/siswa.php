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
            display: flex;
            color: #fff;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            overflow-x: hidden;
        }

        /* Overlay background image */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/assets/img/bg-dashboard.jpg') no-repeat center center/cover;
            filter: blur(6px) brightness(0.6);
            z-index: -1;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(0, 0, 0, 0.85);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            border-radius: 0 20px 20px 0;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.4);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 2rem;
            color: #1abc9c;
            letter-spacing: 1px;
            margin-bottom: 40px;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.5);
        }

        /* Sidebar menu cards */
        .menu-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.08);
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .menu-card i {
            font-size: 1.5rem;
            color: #1abc9c;
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            background: rgba(26, 188, 156, 0.9);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(26, 188, 156, 0.6);
        }

        .menu-card:hover i {
            transform: rotate(20deg) scale(1.3);
            color: #fff;
        }

        .menu-card span {
            transition: color 0.3s ease;
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
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            animation: fadeIn 1s ease;
        }

        .main-content h2 {
            font-size: 2.5rem;
            color: #1abc9c;
            margin-bottom: 20px;
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.5);
        }

        .welcome {
            font-size: 1.3rem;
            margin-bottom: 30px;
        }

        /* Flash messages */
        .flash-message {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            opacity: 0;
            animation: fadeInUp 0.5s forwards;
        }

        .flash-success {
            background-color: rgba(26, 188, 156, 0.85);
            color: #fff;
        }

        .flash-error {
            background-color: rgba(231, 76, 60, 0.85);
            color: #fff;
        }

        /* Animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(15px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
                padding: 15px;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                padding: 15px;
                border-radius: 20px 20px 0 0;
                gap: 10px;
            }

            .sidebar h2 {
                display: none;
            }

            .menu-card {
                flex: 1;
                justify-content: center;
                padding: 12px;
            }

            .main-content {
                margin: 15px 0;
                padding: 25px;
                border-radius: 20px;
            }

            .main-content h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Siswa</h2>
        <a href="/siswa/buku" class="menu-card">
            <i class="fas fa-book"></i>
            <span>Lihat Buku</span>
        </a>
        <a href="/siswa/peminjaman" class="menu-card">
            <i class="fas fa-calendar-check"></i>
            <span>Data Peminjaman Saya</span>
        </a>
        <a href="/logout" class="menu-card">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Dashboard Siswa</h2>
        <p class="welcome">Selamat datang, <?= session()->get('username') ?> 👋</p>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-message flash-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-message flash-error">
                <i class="fas fa-exclamation-triangle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <p>Gunakan menu di sebelah kiri untuk mengakses semua fitur. Nikmati pengalaman dashboard modern dan interaktif!</p>
    </div>
</body>

</html>