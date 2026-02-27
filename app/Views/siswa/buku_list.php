<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Siswa</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
            color: #fff;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/assets/img/bg-books.jpg') no-repeat center center/cover;
            filter: blur(8px) brightness(0.5);
            z-index: -1;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #fff;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        /* Tombol Kembali */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(52, 152, 219, 0.9);
            color: #fff;
            border-radius: 10px;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-btn i {
            transition: transform 0.3s ease;
        }

        .back-btn:hover {
            background: #2980b9;
        }

        .back-btn:hover i {
            transform: rotate(-20deg) scale(1.2);
        }

        /* Flash messages */
        .flash-success,
        .flash-error {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .flash-success {
            background-color: rgba(26, 188, 156, 0.85);
            color: #fff;
        }

        .flash-error {
            background-color: rgba(231, 76, 60, 0.85);
            color: #fff;
        }

        /* Table Styles */
        .buku-table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .buku-table th,
        .buku-table td {
            padding: 15px 20px;
            text-align: left;
        }

        .buku-table th {
            background: rgba(26, 188, 156, 0.9);
            color: #fff;
            font-size: 1.1rem;
            letter-spacing: 1px;
        }

        .buku-table tr {
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .buku-table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.05);
        }

        .buku-table tr:hover {
            transform: scale(1.02);
            background: rgba(26, 188, 156, 0.3);
        }

        /* Pinjam button */
        .pinjam-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 15px;
            background: rgba(26, 188, 156, 0.9);
            color: #fff;
            border-radius: 10px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pinjam-btn i {
            transition: transform 0.3s ease;
        }

        .pinjam-btn:hover {
            background: #16a085;
        }

        .pinjam-btn:hover i {
            transform: rotate(20deg) scale(1.3);
        }

        .stok-habis {
            padding: 8px 15px;
            background: rgba(231, 76, 60, 0.8);
            color: #fff;
            border-radius: 10px;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .buku-table th,
            .buku-table td {
                padding: 10px;
                font-size: 0.9rem;
            }

            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div style="width:100%; max-width:1000px;">
        <h2>Daftar Buku</h2>

        <!-- Tombol Kembali ke Dashboard -->
        <a href="/dashboard" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="flash-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <table class="buku-table">
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($buku as $b): ?>
                <tr>
                    <td><?= $b['judul'] ?></td>
                    <td><?= $b['penulis'] ?></td>
                    <td><?= $b['stok'] ?></td>
                    <td>
                        <?php if ($b['stok'] > 0): ?>
                            <a href="/siswa/buku/pinjam/<?= $b['id'] ?>" class="pinjam-btn">
                                <i class="fas fa-book-reader"></i> Pinjam
                            </a>
                        <?php else: ?>
                            <span class="stok-habis"><i class="fas fa-times-circle"></i> Stok Habis</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>