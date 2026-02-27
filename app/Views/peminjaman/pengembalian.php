<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Dikembalikan</title>

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
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease forwards;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #fff;
            color: #27ae60;
            font-weight: 600;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background: #27ae60;
            color: #fff;
            transform: translateY(-3px) scale(1.05);
        }

        .btn i {
            transition: transform 0.3s ease;
        }

        .btn:hover i {
            transform: rotate(20deg);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media(max-width:500px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 1.8rem;
            }

            p {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2><i class="fas fa-check-circle"></i> Buku Dikembalikan!</h2>
        <p>Buku berhasil dikembalikan ke perpustakaan.</p>
        <a href="/peminjaman" class="btn"><i class="fas fa-arrow-left"></i> Kembali ke Peminjaman</a>
    </div>
</body>

</html>