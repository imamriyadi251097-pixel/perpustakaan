<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - Admin</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
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
            color: #fff;
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            margin-bottom: 20px;
            background: #fff;
            color: #16a085;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #16a085;
            color: #fff;
            transform: translateY(-3px) scale(1.05);
        }

        .btn i {
            transition: transform 0.3s ease;
        }

        .btn:hover i {
            transform: rotate(20deg);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background: rgba(26, 188, 156, 0.9);
            color: #fff;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.05);
        }

        tr:hover {
            background: rgba(26, 188, 156, 0.3);
            transform: scale(1.02);
            transition: all 0.3s ease;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-kembali {
            background: rgba(255, 255, 255, 0.85);
            color: #16a085;
        }

        .btn-kembali:hover {
            background: #16a085;
            color: #fff;
            transform: translateY(-2px) scale(1.05);
        }

        .btn-kembali i {
            transition: transform 0.3s ease;
        }

        .btn-pinjam {
            background: rgba(52, 152, 219, 0.85);
            color: #fff;
        }

        .btn-pinjam:hover {
            background: #2980b9;
            transform: translateY(-2px) scale(1.05);
        }

        .btn-pinjam i {
            transition: transform 0.3s ease;
        }

        .btn-pinjam:hover i {
            transform: rotate(15deg) scale(1.2);
        }

        @media(max-width:768px) {

            table,
            th,
            td {
                font-size: 0.9rem;
            }

            .btn {
                padding: 8px 15px;
                font-size: 0.9rem;
            }

            th,
            td {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Data Peminjaman</h2>

        <a href="/dashboard" class="btn btn-kembali"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
        <a href="/peminjaman/tambah" class="btn btn-pinjam"><i class="fas fa-plus-circle"></i> Tambah Peminjaman</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peminjaman as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nama'] ?></td>
                        <td><?= $p['judul'] ?></td>
                        <td><?= $p['tanggal_pinjam'] ?></td>
                        <td><?= ucfirst($p['status']) ?></td>
                        <td>
                            <?php if ($p['status'] == 'dipinjam'): ?>
                                <a href="/peminjaman/pengembalian/<?= $p['id'] ?>" class="btn-action btn-pinjam"><i class="fas fa-undo-alt"></i> Kembalikan</a>
                            <?php else: ?>
                                <span>Sudah Kembali</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>