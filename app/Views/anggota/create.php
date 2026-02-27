<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>

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
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
            color: #fff;
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
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        form input[type="text"],
        form select,
        form input[type="file"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 1rem;
        }

        .cover-preview {
            text-align: center;
            margin-bottom: 20px;
        }

        .cover-preview img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
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
        <h2>Tambah Anggota</h2>

        <!-- Tombol kembali ke Data Anggota -->
        <a href="/anggota" class="btn"><i class="fas fa-arrow-left"></i> Kembali ke Data Anggota</a>

        <form method="post" action="/anggota/save" enctype="multipart/form-data">
            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>Alamat:</label>
            <input type="text" name="alamat" required>

            <label>Jenis:</label>
            <select name="jenis" required>
                <option value="siswa">Siswa</option>
                <option value="petugas">Guru</option>
            </select>

            <label>Foto Anggota:</label>
            <input type="file" name="foto" accept="image/*" onchange="previewFoto(event)">

            <div class="cover-preview" id="fotoPreview">
                <!-- Preview foto akan muncul di sini -->
            </div>

            <button type="submit"><i class="fas fa-save"></i> Simpan</button>
        </form>
    </div>

    <script>
        function previewFoto(event) {
            const preview = document.getElementById('fotoPreview');
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