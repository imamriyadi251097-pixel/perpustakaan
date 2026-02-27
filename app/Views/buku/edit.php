<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>

    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            color: #fff;
            display: flex;
            justify-content: center;
            padding: 30px;
        }

        .form-container {
            background: rgba(0, 0, 0, 0.85);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #1abc9c;
        }

        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: 500;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border-radius: 10px;
            border: none;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .cover-preview {
            margin: 10px 0 20px;
            text-align: center;
        }

        .cover-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Wrapper tombol agar berjajar */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 10px;
        }

        .button-group button,
        .button-group a {
            flex: 1;
            padding: 14px;
            border-radius: 10px;
            border: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .button-group button {
            background: #1abc9c;
            color: #fff;
        }

        .button-group button:hover {
            background: #16a085;
            transform: translateY(-2px) scale(1.02);
        }

        .button-group a {
            background: #e74c3c;
            color: #fff;
        }

        .button-group a:hover {
            background: #c0392b;
            transform: translateY(-2px) scale(1.02);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Edit Buku</h2>

        <form method="post" action="/buku/update/<?= $buku['id'] ?>" enctype="multipart/form-data">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" value="<?= $buku['judul'] ?>" required>

            <label for="penulis">Penulis:</label>
            <input type="text" id="penulis" name="penulis" value="<?= $buku['penulis'] ?>" required>

            <label for="jenis">Jenis:</label>
            <input type="text" id="jenis" name="jenis" value="<?= $buku['jenis'] ?>" required>

            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="<?= $buku['stok'] ?>" min="1" required>

            <label for="cover">Cover Buku:</label>
            <input type="file" id="cover" name="cover" accept="image/*" onchange="previewCover(event)">

            <div class="cover-preview" id="coverPreview">
                <?php if (!empty($buku['cover'])): ?>
                    <img src="/assets/img/<?= $buku['cover'] ?>" alt="Cover Buku">
                <?php endif; ?>
            </div>

            <!-- Tombol Update & Batal -->
            <div class="button-group">
                <button type="submit"><i class="fas fa-save"></i> Update Buku</button>
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