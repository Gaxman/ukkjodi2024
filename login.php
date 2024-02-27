</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galery Foto</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

</head>

<body>


    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body bg-dark">
                        <div class="text-white">
                            <h5>Halaman Login</h5>
                        </div>
                        <form action="proses_login.php" method="post">
                            <label class="form-label text-white">Username</label>
                            <input type="text" name="username" class="form-control" required>
                            <label class="form-label text-white">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            <div class="d-grid mt-3">
                                <button class="btn btn-danger" type="submit">Login</button>
                            </div>
                        </form>
                        <hr>
                        <p class="text-white">Belum punya akun ? <a href="register.php">Silahkan Register dulu</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>PUTU JODI SWASTIKA | UKK 2024</p>
    </footer>

    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>