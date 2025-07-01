<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Buku</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffffdd;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 90%;
            max-width: 500px;
        }

        h3 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        select,
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            transition: 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .hasil {
            margin-top: 20px;
        }

        .judul-buku {
            background-color: #ffeaa7;
            padding: 12px;
            margin: 8px 0;
            border-left: 6px solid #fdcb6e;
            border-radius: 6px;
            font-weight: bold;
            color: #2d3436;
        }

        .kosong {
            color: #d63031;
            font-style: italic;
            text-align: center;
        }

        h4 {
            color: #2d3436;
            margin-top: 25px;
            text-align: center;
        }

        .btn-back {
            display: inline-block;
            text-align: center;
            background-color:rgb(6, 219, 235);
            color: white;
            padding: 12px;
            width: 100%;
            margin-top: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-back:hover {
            background-color:rgb(0, 238, 255);
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include('koneksi.php'); ?>

        <form action="" method="POST">
            <fieldset style="border: none;">
                <h3>Cek The Book?</h3>
                <select name="genre" id="genre" required>
                    <option value="">Pilih Genre</option>
                    <option value="comedy">Comedy</option>
                    <option value="horor">Horor</option>
                    <option value="action">Action</option>
                </select>
                <button type="submit">CEK</button>
                <a href="menu.php" class="btn-back">Back</a>
            </fieldset>
        </form>

        <div class="hasil">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $genre = trim($_POST['genre']);

                $stmt = $conn->prepare("SELECT * FROM buku WHERE genre = ?");
                $stmt->bind_param("s", $genre);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<h4>Hasil untuk genre: <i>" . htmlspecialchars($genre) . "</i></h4>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='judul-buku'>" . htmlspecialchars($row['judul']) . "</div>";

                    }
                } else {
                    echo "<p class='kosong'>Tidak ada buku dengan genre tersebut.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>