<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f6d365, #fda085);
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-style form {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        fieldset {
            border: none;
        }

        legend {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #ff9a76;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ff704d;
        }

        /* Toast Styles */
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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM tabel_user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Redirect ke halaman tambah buku
                header("Location:menu.php");
                exit;
            } else {
                echo "<div class='toast error'>Password salah. Silakan coba lagi.</div>";
            }
        } else {
            echo "<div class='toast error'>Username tidak ditemukan.</div>";
        }
    }
    ?>
    <div class="register-style">
        <form action="" method="POST">
            <fieldset>
                <legend>Login</legend>
                <p>
                    <label>Username:</label>
                    <input type="text" name="username" id="username" required />
                </p>
                <p>
                    <label>Password:</label>
                    <input type="password" name="password" id="password" required />
                </p>
                <p>
                    <input type="submit" name="submit" value="Login" />
                </p>
                <div class="info-text">
                    belum memiliki akun? <a href="register.php">Daftar disini</a>
                </div>
            </fieldset>
        </form>
    </div>




</body>

</html>