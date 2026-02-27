<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Admin</title>

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
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.2rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        /* Tombol Kembali */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.85);
            color: #16a085;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #16a085;
            color: #fff;
            transform: translateY(-2px) scale(1.05);
        }

        .btn-back i {
            transition: transform 0.3s ease;
        }

        .btn-back:hover i {
            transform: rotate(-15deg) scale(1.2);
        }

        /* Tambah Buku Button */
        .btn-tambah {
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

        .btn-tambah:hover {
            background: #16a085;
            color: #fff;
            transform: translateY(-3px) scale(1.05);
        }

        .btn-tambah i {
            transition: transform 0.3s ease;
        }

        .btn-tambah:hover i {
            transform: rotate(20deg);
        }

        /* Table Styles */
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
            padding: 15px 20px;
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

        /* Action Buttons */
        .btn-edit,
        .btn-delete,
        .btn-view {
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

        .btn-edit {
            background: rgba(52, 152, 219, 0.85);
            color: #fff;
        }

        .btn-edit:hover {
            background: #2980b9;
            transform: translateY(-2px) scale(1.05);
        }

        .btn-delete {
            background: rgba(231, 76, 60, 0.85);
            color: #fff;
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: translateY(-2px) scale(1.05);
        }

        .btn-view {
            background: rgba(241, 196, 15, 0.85);
            color: #fff;
        }

        .btn-view:hover {
            background: #f39c12;
            transform: translateY(-2px) scale(1.05);
        }

        .btn-edit i,
        .btn-delete i,
        .btn-view i {
            transition: transform 0.3s ease;
        }

        .btn-edit:hover i,
        .btn-delete:hover i,
        .btn-view:hover i {
            transform: rotate(15deg) scale(1.2);
        }

        /* Cover Thumbnail */
        .cover-thumb {
            width: 50px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.4);
        }

        /* Responsive */
        @media(max-width:768px) {

            table,
            th,
            td {
                font-size: 0.85rem;
            }

            .btn-tambah,
            .btn-back {
                padding: 8px 15px;
                font-size: 0.9rem;
            }

            th,
            td {
                padding: 8px 10px;
            }

            .cover-thumb {
                width: 40px;
                height: 55px;
            }
        }
    </style>
</head>

<body>
    <h2>Data Buku</h2>

    <a href="/dashboard" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    <a href="/buku/tambah" class="btn-tambah"><i class="fas fa-plus-circle"></i> Tambah Buku</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Jenis</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($buku as $b): ?>
                <tr>
                    <td><?= $b['id'] ?></td>
                    <td>
                        <?php if (!empty($b['cover'])): ?>
                            <img src="/assets/img/<?= $b['cover'] ?>" alt="Cover <?= $b['judul'] ?>" class="cover-thumb">
                        <?php else: ?>
                            <span>Tidak ada</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $b['judul'] ?></td>
                    <td><?= $b['penulis'] ?></td>
                    <td><?= $b['jenis'] ?></td>
                    <td><?= $b['stok'] ?></td>
                    <td>
                        <a href="/buku/edit/<?= $b['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <a href="/buku/delete/<?= $b['id'] ?>" onclick="return confirm('Hapus data?')" class="btn-delete"><i class="fas fa-trash-alt"></i> Hapus</a>
                        <a href="/buku/cover/<?= $b['id'] ?>" class="btn-view"><i class="fas fa-eye"></i> Lihat Cover</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>