<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galery Foto</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg text-bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="index.php">WEBSITE GALERY FOTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <?php
                    session_start();
                    if (!isset($_SESSION['userid'])) {
                        ?>
                        <a href="register.php" class="btn btn-outline-primary m-1">Register</a>
                        <a href="login.php" class="btn btn-outline-primary m-1">Login</a>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="album.php">Galery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="foto.php">Image</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="logout.php">Logout</a>
                        </li>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            ADD Data
        </button>
        <div class="card mt-2">
            <div class="card-header text-bg-primary">Data Image</div>
            <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Unggah</th>
                            <th>Gambar</th>
                            <th>Album</th>
                            <th>Disukai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksi.php";
                        $userid = $_SESSION['userid'];
                        $no = 1;
                        $sql = mysqli_query($conn, "select * from foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
                        while ($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= $data['judulfoto'] ?>
                                </td>
                                <td>
                                    <?= $data['deskripsifoto'] ?>
                                </td>
                                <td>
                                    <?= $data['tanggalunggah'] ?>
                                </td>
                                <td>
                                    <img src="galeri/<?= $data['lokasifile'] ?>" width="200px">
                                </td>
                                <td>
                                    <?= $data['namaalbum'] ?>
                                </td>
                                <td>
                                    <?php
                                    $fotoid = $data['fotoid'];
                                    $sql2 = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                                    echo mysqli_num_rows($sql2);
                                    ?>
                                </td>
                                <td>
                                    <a href="hapus_foto.php?fotoid=<?= $data['fotoid'] ?>"
                                        class="btn btn-outline-warning">Delete</a>
                                    <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $no ?>">Edit</a>
                                </td>
                            </tr>


                            <div class="modal fade" id="edit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Image</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="update_foto.php" method="post" enctype="multipart/form-data">
                                            <input type="text" name="fotoid" value="<?= $data['fotoid'] ?>" hidden>
                                            <div class="modal-body">
                                                <label class="form-label">Judul Foto</label>
                                                <input type="text" name="judulfoto" class="form-control"
                                                    value="<?= $data['judulfoto'] ?>">
                                                <label class="form-label">deskripsi</label>
                                                <input type="text" name="deskripsifoto" class="form-control"
                                                    value="<?= $data['deskripsifoto'] ?>">
                                                <label class="form-label">gambar</label>
                                                <input type="file" name="lokasifile" class="form-control">
                                                <label class="form-label">album</label>
                                                <select name="albumid" class="form-select">
                                                    <?php
                                                    $userid = $_SESSION['userid'];
                                                    $sql2 = mysqli_query($conn, "select * from album where userid='$userid'");
                                                    while ($data2 = mysqli_fetch_array($sql2)) {
                                                        ?>
                                                        <option value="<?= $data2['albumid'] ?>" <?php if ($data2['albumid'] == $data['albumid']) {
                                                              echo 'selected';
                                                          } ?>>
                                                            <?= $data2['namaalbum'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah foto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="tambah_foto.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label class="form-label">Judul foto</label>
                        <input type="text" name="judulfoto" class="form-control" required>
                        <label class="form-label">deskripsi foto</label>
                        <input type="text" name="deskripsifoto" class="form-control" required>
                        <label class="form-label">Gambar</label>
                        <input type="file" name="lokasifile" class="form-control" required>
                        <label class="form-label">Album</label>
                        <select name="albumid" class="form-select">
                            <?php
                            include "koneksi.php";
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($conn, "select * from album where userid='$userid'");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?= $data['albumid'] ?>">
                                    <?= $data['namaalbum'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <footer class="d-flex justify-content-center border-top mt-5 bg-light fixed-bottom">
        <p>PUTU JODI SWASTIKA | UKK 2024</p>
    </footer>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- <script>
        new DataTable('#example');
    </script> -->
</body>

</html>