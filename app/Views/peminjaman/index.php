<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1100px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .top-action {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: #fff;
            color: #16a085;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn:hover {
            background: #16a085;
            color: #fff;
            transform: scale(1.05);
        }

        .btn-pinjam {
            background: #3498db;
            color: #fff;
        }

        .btn-pinjam:hover {
            background: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 15px;
        }

        th {
            background: rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.05);
        }

        tr:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .status-pinjam {
            color: #f1c40f;
            font-weight: 600;
        }

        .status-kembali {
            color: #2ecc71;
            font-weight: 600;
        }

        .btn-action {
            padding: 6px 10px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 5px;
            font-size: 13px;
        }

        .btn-kembali {
            background: #3498db;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 20px;
            color: #ddd;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            opacity: 0.8;
        }

        .footer b {
            color: #fff;
        }

        @media(max-width:768px) {

            table,
            th,
            td {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>📚 Data Peminjaman</h2>

        <div class="top-action">
            <a href="/dashboard" class="btn">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>

            <a href="/peminjaman/tambah" class="btn btn-pinjam">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($peminjaman)): ?>
                        <?php $no = 1;
                        foreach ($peminjaman as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>

                                <!-- FIX ERROR -->
                                <td><?= esc($p['nama_anggota'] ?? '-') ?></td>
                                <td><?= esc($p['judul_buku'] ?? '-') ?></td>

                                <td><?= esc($p['tanggal_pinjam']) ?></td>

                                <td>
                                    <?php if ($p['status'] == 'dipinjam'): ?>
                                        <span class="status-pinjam">Dipinjam</span>
                                    <?php else: ?>
                                        <span class="status-kembali">Kembali</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($p['status'] == 'dipinjam'): ?>
                                        <a href="/peminjaman/kembali/<?= $p['id'] ?>"
                                            class="btn-action btn-kembali">
                                            <i class="fas fa-undo"></i>
                                        </a>
                                    <?php endif; ?>

                                    <a href="/peminjaman/delete/<?= $p['id'] ?>"
                                        onclick="return confirm('Yakin hapus data ini?')"
                                        class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty">Tidak ada data peminjaman</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            © <?= date('Y') ?> Sistem Perpustakaan | Developed by <b>Imam Riyadi</b> 🚀
        </div>

    </div>

</body>

</html>