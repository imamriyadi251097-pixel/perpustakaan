<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>

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
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
        }

        .container {
            width: 100%;
            max-width: 500px;
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

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        form select {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            transition: all 0.3s ease;
        }

        form select:hover {
            transform: scale(1.02);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            margin-bottom: 15px;
            background: #fff;
            color: #2980b9;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #2980b9;
            color: #fff;
            transform: translateY(-3px) scale(1.05);
        }

        .btn i {
            transition: transform 0.3s ease;
        }

        .btn:hover i {
            transform: rotate(20deg);
        }

        button[type="submit"] {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #fff;
            color: #2980b9;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button[type="submit"]:hover {
            background: #2980b9;
            color: #fff;
            transform: translateY(-3px) scale(1.05);
        }

        button[type="submit"] i {
            transition: transform 0.3s ease;
        }

        button[type="submit"]:hover i {
            transform: rotate(20deg);
        }

        @media(max-width:600px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tambah Peminjaman</h2>

        <a href="/peminjaman" class="btn"><i class="fas fa-arrow-left"></i> Kembali ke Peminjaman</a>

        <form method="post" action="/peminjaman/save">
            <label>Anggota:</label>
            <select name="anggota_id" required>
                <option value="" disabled selected>Pilih Anggota</option>
                <?php foreach ($anggota as $a): ?>
                    <option value="<?= $a['id'] ?>"><?= $a['nama'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Buku:</label>
            <select name="buku_id" required>
                <option value="" disabled selected>Pilih Buku</option>
                <?php foreach ($buku as $b): ?>
                    <option value="<?= $b['id'] ?>"><?= $b['judul'] ?> (Stok: <?= $b['stok'] ?>)</option>
                <?php endforeach; ?>
            </select>

            <button type="submit"><i class="fas fa-save"></i> Simpan Peminjaman</button>
        </form>
    </div>
</body>

</html>