<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman Saya</title>
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

        /* Blur background image */
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

        /* Table styles */
        .buku-table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(6px);
        }

        .buku-table th,
        .buku-table td {
            padding: 15px 20px;
            text-align: left;
            font-weight: 500;
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

        /* Status labels */
        .status-dipinjam {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            background: rgba(241, 196, 15, 0.8);
            border-radius: 8px;
            font-weight: 500;
            color: #fff;
            animation: pulse 2s infinite;
        }

        .status-kembali {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            background: rgba(46, 204, 113, 0.8);
            border-radius: 8px;
            font-weight: 500;
            color: #fff;
        }

        /* Pulse animation for dipinjam */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
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
        <h2>Riwayat Peminjaman Saya</h2>

        <!-- Tombol Kembali ke Dashboard -->
        <a href="/dashboard" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <table class="buku-table">
            <tr>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
            <?php foreach ($peminjaman as $p): ?>
                <tr>
                    <td><?= $p['judul_buku'] ?? $p['buku_id'] ?></td>
                    <td><?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?></td>
                    <td>
                        <?php if ($p['tanggal_kembali']): ?>
                            <span class="status-kembali"><i class="fas fa-check-circle"></i> Kembali</span>
                        <?php else: ?>
                            <span class="status-dipinjam"><i class="fas fa-book-reader"></i> Dipinjam</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>