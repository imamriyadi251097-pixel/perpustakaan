<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>

    <!-- Google Fonts & Font Awesome -->
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
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 30px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2rem;
            color: #1abc9c;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="number"],
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
            margin-bottom: 20px;
            text-align: center;
        }

        .cover-preview img {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .cover-preview img:hover {
            transform: scale(1.1) rotate(2deg);
        }

        /* ------------------------- */
        /* Tombol Bawah Form */
        /* ------------------------- */
        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 10px;
        }

        .button-group button,
        .button-group a {
            flex: 1;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button-group button {
            background: #1abc9c;
            color: #fff;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .button-group button:hover {
            background: #16a085;
            transform: translateY(-2px) scale(1.05);
        }

        .button-group a {
            background: #e74c3c;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .button-group a:hover {
            background: #c0392b;
            transform: translateY(-2px) scale(1.05);
        }

        @media(max-width:600px) {
            .container {
                padding: 20px;
            }

            .cover-preview img {
                width: 100px;
                height: 130px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tambah Buku</h2>

        <form method="post" action="/buku/save" enctype="multipart/form-data">
            <label>Judul:</label>
            <input type="text" name="judul" placeholder="Masukkan judul buku" required>

            <label>Penulis:</label>
            <input type="text" name="penulis" placeholder="Masukkan nama penulis" required>

            <label>Jenis:</label>
            <input type="text" name="jenis" placeholder="Contoh: Matematika, IPA" required>

            <label>Stok:</label>
            <input type="number" name="stok" min="1" placeholder="Jumlah stok buku" required>

            <label>Cover Buku:</label>
            <input type="file" name="cover" accept="image/*" onchange="previewCover(event)">

            <div class="cover-preview" id="coverPreview">
                <!-- Preview gambar akan muncul di sini -->
            </div>

            <!-- Tombol Bawah Form -->
            <div class="button-group">
                <button type="submit"><i class="fas fa-save"></i> Simpan Buku</button>
                <a href="/buku"><i class="fas fa-times"></i> Batal</a>
            </div>
        </form>
    </div>

    <script>
        function previewCover(event) {
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