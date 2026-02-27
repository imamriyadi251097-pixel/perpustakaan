<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>

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
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2rem;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="file"],
        form select {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 1rem;
        }

        form button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #fff;
            color: #16a085;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        form button:hover {
            background: #16a085;
            color: #fff;
            transform: translateY(-2px) scale(1.05);
        }

        form button i {
            transition: transform 0.3s ease;
        }

        form button:hover i {
            transform: rotate(20deg);
        }

        .cover-preview {
            margin-bottom: 20px;
            text-align: center;
        }

        .cover-preview img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            margin-bottom: 20px;
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

        @media(max-width:600px) {
            .container {
                padding: 20px;
            }

            .cover-preview img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Anggota</h2>

        <a href="/anggota" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Data Anggota</a>

        <form method="post" action="/anggota/update/<?= $anggota['id'] ?>" enctype="multipart/form-data">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= $anggota['nama'] ?>" required>

            <label>Alamat:</label>
            <input type="text" name="alamat" value="<?= $anggota['alamat'] ?>" required>

            <label>Jenis:</label>
            <select name="jenis">
                <option value="siswa" <?= $anggota['jenis'] == 'siswa' ? 'selected' : '' ?>>Siswa</option>
                <option value="petugas" <?= $anggota['jenis'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
            </select>

            <label>Foto Anggota:</label>
            <input type="file" name="foto" accept="image/*" onchange="previewFoto(event)">

            <div class="cover-preview" id="coverPreview">
                <?php if (!empty($anggota['foto']) && file_exists(FCPATH . 'assets/foto/' . $anggota['foto'])): ?>
                    <img src="/assets/foto/<?= $anggota['foto'] ?>" alt="Foto <?= $anggota['nama'] ?>">
                <?php else: ?>
                    <img src="/assets/foto/default.png" alt="Tidak ada foto">
                <?php endif; ?>
            </div>

            <button type="submit"><i class="fas fa-save"></i> Update</button>
        </form>
    </div>

    <script>
        function previewFoto(event) {
            const preview = document.getElementById('coverPreview');
            preview.innerHTML = '';
            const file = event.target.files[0];
            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                preview.appendChild(img);
            }
        }
    </script>
</body>

</html>