<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota - Admin</title>

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
            margin-bottom: 20px;
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
            transition: all 0.3s ease;
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

        .btn-edit,
        .btn-delete {
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

        .btn-edit i,
        .btn-delete i {
            transition: transform 0.3s ease;
        }

        .btn-edit:hover i,
        .btn-delete:hover i {
            transform: rotate(15deg) scale(1.2);
        }

        .foto {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .foto:hover {
            transform: scale(1.2);
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

            .foto {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Data Anggota</h2>

        <a href="/dashboard" class="btn"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
        <a href="/anggota/tambah" class="btn"><i class="fas fa-plus-circle"></i> Tambah Anggota</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anggota as $a): ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['alamat'] ?></td>
                        <td>
                            <?php
                            $fotoPath = FCPATH . 'assets/foto/' . $a['foto'];
                            ?>
                            <?php if (!empty($a['foto']) && file_exists($fotoPath)): ?>
                                <img src="/assets/foto/<?= $a['foto'] ?>" alt="Foto <?= $a['nama'] ?>" class="foto">
                            <?php else: ?>
                                <img src="/assets/foto/default.png" alt="Tidak ada foto" class="foto">
                            <?php endif; ?>
                        </td>
                        <td><?= ucfirst($a['jenis']) ?></td>
                        <td>
                            <a href="/anggota/edit/<?= $a['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/anggota/delete/<?= $a['id'] ?>" onclick="return confirm('Hapus data?')" class="btn-delete"><i class="fas fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>