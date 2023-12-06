<?php
require 'fungsi.php';

if (isset($_POST['masuk'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are empty
    if (empty($username) || empty($password)) {
        $error_message = "Nama pengguna dan kata sandi wajib diisi.";
    } else {
        // Kueri database untuk mencari pengguna
        $query = "SELECT iduser, username, password, user_type FROM pengguna  WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && $user = mysqli_fetch_assoc($result)) {
            // Verifikasi kata sandi
            if ($password == $user['password']) {
                // Otentikasi berhasil
                $_SESSION['iduser'] = $user['iduser']; // Setel variabel sesi untuk mengidentifikasi pengguna
                $_SESSION['user_type'] = $user['user_type']; // Setel tipe pengguna dalam sesi
                $_SESSION['log'] = 'True'; // Setel sesi untuk menunjukkan pengguna masuk

                if ($user['user_type'] == 'petugas') {
                    echo '<script>alert("Sukses Masuk Sistem");window.location="beranda.php"</script>';
                } elseif ($user['user_type'] == 'pimpinan') {
                    echo '<script>alert("Sukses Masuk Sistem");window.location="beranda_pimpinan.php"</script>';
                }
                exit;
            } else {
                // Password salah, tampilkan pesan kesalahan
                $error_message = "Nama pengguna atau kata sandi salah. Silakan coba lagi.";
            }
        } else {
            // Username tidak ditemukan, tampilkan pesan kesalahan
            $error_message = "Nama pengguna atau kata sandi salah. Silakan coba lagi.";
        }
    }
}

if (isset($_SESSION['iduser']) && $_SESSION['log'] == 'True') {
    // Pengguna sudah masuk, alihkan mereka ke beranda sesuai tipe pengguna
    if ($_SESSION['user_type'] == 'petugas') {
        header('location: beranda.php');
    } elseif ($_SESSION['user_type'] == 'pimpinan') {
        header('location: beranda_pimpinan.php');
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href='img/logo-ajm.jpeg' rel='shortcut icon'>
    <title>Masuk Sistem</title>
    <style>
        .loginform {
            background-color: #87CEFA
        }
    </style>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="loginform">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center">
                                    <img src="./img/logo-ajm.jpeg" class="rounded-circle mx-auto" style="width: 100px; height: 100px;">
                                    <h3 class="font-weight-light my-4">Silahkan Masuk</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="username" type="text" placeholder="username" />
                                            <label for="inputUsername">Nama Pengguna</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="password" type="password" placeholder="password" />
                                            <label for="inputPassword">Kata Sandi</label>
                                        </div>
                                        <?php if (isset($error_message)) {
                                            echo '<div class="text-danger">' . $error_message . '</div>';
                                        } ?>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary hover" name="masuk">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>

</html>
