<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        img {
            width: 250px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 15px;
            background: white;
            color: #16a085;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        a:hover {
            background: #16a085;
            color: white;
        }
    </style>
</head>

<body>

    <div class="card">
        <h2><?= esc($buku['judul']) ?></h2>
        <p><strong>Penulis:</strong> <?= esc($buku['penulis']) ?></p>
        <p><strong>Jenis:</strong> <?= esc($buku['jenis']) ?></p>
        <p><strong>Stok:</strong> <?= esc($buku['stok']) ?></p>

        <?php if (!empty($buku['cover'])): ?>
            <img src="<?= base_url('assets/img/' . $buku['cover']) ?>" alt="Cover">
        <?php else: ?>
            <p>Tidak ada cover</p>
        <?php endif; ?>

        <br>
        <a href="<?= base_url('buku') ?>">Kembali</a>
    </div>

</body>

</html>