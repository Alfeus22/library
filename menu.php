<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Buku</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            max-width: 600px;
            width: 100%;
            padding: 30px;
        }

        .card {
            background-color: #ffffffcc;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            padding: 25px 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            transition: transform 0.2s ease, background-color 0.3s;
            cursor: pointer;
        }

        .card:hover {
            transform: scale(1.05);
            background-color: #dfe6e9;
        }

        h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 30px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>

    <?php include('koneksi.php'); ?>

    <div>
        <h2>Menu Buku</h2>
        <div class="menu-container">
            <a href="cekBuku.php"><div class="card">📖 Cek Buku</div></a>
            <a href="tambah_buku.php"><div class="card">➕ Tambah Buku</div></a>
            <a href="hapus.php"><div class="card">❌ Hapus Buku</div></a>
            <a href="cari_buku.php"><div class="card">🔍 Cari Buku</div></a>
            <a href="ConLogin.php"><div class="card">🚪 Exit</div></a>
        </div>
    </div>

</body>
</html>
