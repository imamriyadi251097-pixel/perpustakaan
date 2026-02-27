<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register Perpustakaan</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: url('/assets/images/perpustakaan.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 20px;
            width: 400px;
            max-width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.8s ease-in-out;
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

        .container img {
            width: 80px;
            margin-bottom: 20px;
            animation: logoBounce 1s ease-in-out;
        }

        @keyframes logoBounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-15px);
            }

            60% {
                transform: translateY(-7px);
            }
        }

        h2 {
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        /* Input Group */
        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background: #f7f7f7;
            border-radius: 50px;
            padding: 0 15px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        .input-group input {
            flex: 1;
            border: none;
            outline: none;
            padding: 12px;
            font-size: 14px;
            background: transparent;
            border-radius: 50px;
        }

        .input-group input:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
            border-color: #007BFF;
        }

        .input-group .input-icon {
            color: #999;
            margin-right: 10px;
            font-size: 16px;
        }

        .input-group .toggle-password {
            color: #999;
            cursor: pointer;
            margin-left: 10px;
            font-size: 16px;
        }

        /* Buttons */
        .btn-primary,
        .btn-success {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary {
            background: linear-gradient(45deg, #007BFF, #00C6FF);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-success {
            background: linear-gradient(45deg, #28a745, #5dd25d);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(40, 167, 69, 0.3);
        }

        /* Flash messages */
        .error-message,
        .success-message {
            margin-bottom: 15px;
            font-weight: 500;
            font-size: 14px;
            text-align: left;
            padding: 8px 12px;
            border-radius: 8px;
        }

        .error-message {
            background: #ffe5e5;
            color: #d32f2f;
        }

        .success-message {
            background: #e5ffe5;
            color: #388e3c;
        }

        /* Link */
        .link {
            margin-top: 15px;
            display: block;
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="/assets/images/logo-sekolah.jpg" alt="Logo Sekolah">

        <h2>Login Sistem Perpustakaan</h2>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message"><?= session()->getFlashdata('error') ?></div>
        <?php elseif (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post" action="/login">
            <div class="input-group">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="login_password" name="password" placeholder="Password" required>
                <i class="fas fa-eye toggle-password" toggle="#login_password"></i>
            </div>

            <button type="submit" class="btn-primary">Login</button>
        </form>

        <a class="link" href="/register">Belum punya akun? Daftar di sini</a>
    </div>

    <script>
        // Toggle password
        const togglePassword = document.querySelectorAll('.toggle-password');
        togglePassword.forEach(el => {
            el.addEventListener('click', function() {
                const input = document.querySelector(this.getAttribute('toggle'));
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>

</html>