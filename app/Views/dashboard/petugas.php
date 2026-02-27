<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Petugas</title>
</head>

<body>
    <h2>Dashboard Petugas</h2>
    <p>Selamat datang, <?= session()->get('username') ?></p>
    <ul>
        <li><a href="/buku">Data Buku</a></li>
        <li><a href="/peminjaman">Data Peminjaman</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</body>

</html>