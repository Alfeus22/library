<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Buku</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            width: 400px;
            background-color: #ffffffdd;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(6px);
            border: 1px solid #ddd;
        }

        h2 {
            text-align: center;
            color: #2d3436;
            margin-bottom: 25px;
            font-size: 24px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 15px;
            background-color: #f9f9f9;
            transition: 0.3s ease;
        }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #5dade2;
            background-color: #ffffff;
            box-shadow: 0 0 5px #5dade299;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 30px;
        }

        .button-group button,
        .button-group a {
            flex: 1;
            padding: 12px 0;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
        }

        .button-group button {
            background: linear-gradient(135deg, #3498db, #6dd5fa);
            color: #fff;
        }

        .button-group button:hover {
            background: linear-gradient(135deg, #2980b9, #57c1eb);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .btn-back {
            background: linear-gradient(135deg, #7f8c8d, #b2bec3);
            color: white;
            text-decoration: none;
            line-height: 42px;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #636e72, #95a5a6);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .success {
            color: #27ae60;
        }

        .error {
            color: #c0392b;
        }
    </style>
</head>

<body>

    <?php include('koneksi.php'); ?>

    <form class="form-container" action="" method="POST">
        <h2>Penambahan Buku</h2>

        <label for="judul">Judul Buku:</label>
        <input type="text" name="judul" id="judul" required>

        <label for="genre">Genre Buku:</label>
        <select name="genre" id="genre" required>
            <option value="">Pilih Genre</option>
            <option value="Horor">Horor</option>
            <option value="Comedy">Comedy</option>
            <option value="Action">Action</option>
        </select>

        <div class="button-group">
            <button type="submit" name="submit">📘 Kirim</button>
            <a href="menu.php" class="btn-back">🔙 Back</a>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul = trim($_POST['judul']);
            $genre = trim($_POST['genre']);

            $stmt = $conn->prepare("SELECT * FROM buku WHERE judul = ?");
            $stmt->bind_param("s", $judul);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p class='message error'>Judul buku sudah ada.</p>";
            } else {
                $stmt = $conn->prepare("INSERT INTO buku (judul, genre) VALUES (?, ?)");
                $stmt->bind_param("ss", $judul, $genre);
                if ($stmt->execute()) {
                    echo "<p class='message success'>Data berhasil disimpan.</p>";
                } else {
                    echo "<p class='message error'>Gagal menyimpan data.</p>";
                }
            }
        }
        ?>
    </form>

</body>

</html>
        