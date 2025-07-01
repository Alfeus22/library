<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>

    <!-- CSS INTERNAL -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        fieldset {
            border: none;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .register-style p {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #74ebd5;
            outline: none;
        }

        button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background-color: #74ebd5;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #4ecdc4;
        }

        /* TOAST STYLES */
        .toast {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            z-index: 9999;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            animation: slideDownFade 4s ease-in-out forwards;
            text-align: center;
            max-width: 90%;
        }

        .toast.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .toast.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .toast a {
            color: inherit;
            text-decoration: underline;
        }

        @keyframes slideDownFade {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }

            10% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(-20px);
            }
        }

        .info-text {
            background-color: #ffffff;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #2d3436;
            font-size: 16px;
        }

        .info-text a {
            color: #0984e3;
            text-decoration: none;
            font-weight: bold;
        }

        .info-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include('koneksi.php'); ?>

    <form action="" method="POST">
        <fieldset>
            <h3>Registrasi</h3>
            <div class="register-style">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" name="username" required>
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" required>
                </p>
                <button type="submit" name="submit">OK</button>
            </div>
            <div class="info-text">
                sudah memiliki akun? <a href="ConLogin.php">login disini</a>
            </div>
        </fieldset>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = htmlspecialchars(trim($_POST['username']));
        $password_raw = trim($_POST['password']);
        $password = password_hash($password_raw, PASSWORD_DEFAULT);

        $check = $conn->prepare("SELECT * FROM tabel_user WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='toast error'>Username sudah digunakan</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO tabel_user (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()) {
                echo "<div class='toast success'>Registrasi berhasil! <a href='ConLogin.php'>Login di sini</a></div>";
            } else {
                echo "<div class='toast error'>Registrasi gagal, silakan coba lagi.</div>";
            }
        }
    }
    ?>

</body>

</html>