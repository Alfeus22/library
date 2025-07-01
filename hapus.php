<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Buku</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f4f4;
            padding: 40px;
        }

        form {
            background: #fff;
            max-width: 400px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        button,
        .btn-back {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        button[name="delete"] {
            background-color: #e74c3c;
            color: white;
        }

        button[name="delete"]:hover {
            background-color: #c0392b;
        }

        .btn-back {
            background-color: #7f8c8d;
            color: white;
            line-height: 42px;
        }

        .btn-back:hover {
            background-color: #636e72;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    include('koneksi.php');

    $stmt = $conn->prepare("SELECT * FROM buku");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['delete']) && isset($_POST['judul']) && $_POST['judul'] != '') {
            $id = $_POST['judul'];
            $deleteStmt = $conn->prepare("DELETE FROM buku WHERE id_buku = ?");
            $deleteStmt->bind_param("i", $id);
            $deleteStmt->execute();
            echo "<p style='color: green;'>Buku berhasil dihapus.</p>";

            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    ?>

    <form action="" method="POST">
        <fieldset style="border: none;">
            <h1>Hapus Buku</h1>
            <select name="judul" id="judul" required>
                <option value="">Pilih Judul</option>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['id_buku']) . "'>" . htmlspecialchars($row['judul']) . "</option>";
                }
                ?>
            </select>

            <div class="button-group">
                <button name="delete">DELETE</button>
                <a href="menu.php" class="btn-back">Kembali</a>
            </div>
        </fieldset>
    </form>

</body>

</html>
