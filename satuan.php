<?php
require 'fungsi.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='img/logo-ajm.jpeg' rel='shortcut icon'>
    <title>Satuan Barang</title>
    <style>
        .hover-effect:hover {
            font-weight: bold;
            color: black;
        }

        .hover-effect:hover {
            font-weight: bold;
            color: black;
        }

        .navmain {
            background-color: #87CEFA
        }

        .navsecond {
            background-color: #FFEFD5
        }

        .footer {
            background-color: #87CEFA
        }
        /* Gaya umum untuk tabel */
        #datatablesSimple {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #datatablesSimple th, #datatablesSimple td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        #datatablesSimple th {
            background-color: #87CEFA;
        }

        #datatablesSimple tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Gaya untuk hover pada baris tabel */
        #datatablesSimple tr:hover {
            background-color: #d4ebf9;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script>
        function confirmLogout() {
            var result = confirm("Apakah Anda yakin ingin keluar dari aplikasi?");
            if (result) {
                window.location.href = "keluar.php";
            } else {}
        }
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navmain">
        <a class="navbar-brand ps-3 text-dark" style="font-weight: bold;" href="index.php">Toko Asia Jaya Motor</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-dark" style="font-weight: bold;"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion navsecond" id="sidenavAccordion">
                <div class="container text-center mt-5">
                    <img src="./img/logo-ajm.jpeg" class="rounded-circle mx-auto" style="width: 100px; height: 100px;">
                    <p class="mt-2 text-dark fs-5" style="font-weight: bold;">Karyawan Gudang</p>
                </div>
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link text-white" href="beranda.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fs-5 text-dark"></i></div>
                            <p class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Beranda</p>
                        </a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" id="stokBarangDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fas fa-database fs-5 text-dark"></i></div>
                                <span class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Data Master</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="stokBarangDropdown">
                                <a class="dropdown-item" href="databarang.php">Data Barang</a>
                                <a class="dropdown-item" href="jenis-barang.php">Jenis Barang</a>
                                <a class="dropdown-item" href="supplier.php">Data Supplier</a>
                                <a class="dropdown-item" href="satuan.php">Satuan Barang</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" id="stokBarangDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt fs-5 text-dark"></i></div>
                                <span class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Transaksi</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="stokBarangDropdown">
                                <a class="dropdown-item" href="barangmasuk.php">Barang Masuk</a>
                                <a class="dropdown-item" href="barangkeluar.php">Barang Keluar</a>
                                <a class="dropdown-item" href="do.php">Drop Order</a>
                            </div>
                        </li>
                        <a class="nav-link text-white" href="kartustok.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-note-sticky fs-5 text-dark"></i></div>
                            <p class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Kartu Stok</p>
                        </a>
                        <button onclick="confirmLogout()" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-dark fs-5" style="font-weight: bold; text-decoration: none; display: flex; align-items: center;">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt fs-5 text-dark" style="margin-left: 8px;"></i></div>
                            <span style="margin-left: 10px;">Keluar</span>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Satuan Barang</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Satuan Barang</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $ambilsemuadatasatuan = mysqli_query($conn, "SELECT * FROM `satuan`");
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($ambilsemuadatasatuan)) {
                                        $satuan = $data['satuan'];
                                        $ids = $data['id_satuan'];
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $satuan; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?php echo $ids; ?>">
                                                    Ubah
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $ids; ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="ubah<?php echo $ids; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-warning">
                                                        <h4 class="modal-title text-black">Ubah Satuan Barang</h4>
                                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <h6>Satuan Barang</h6>
                                                            <input type="text" name="satuan" value="<?php echo $satuan; ?>" class="form-control" required>
                                                            <br>
                                                            <input type="hidden" name="id_satuan" value="<?php echo $ids; ?>">
                                                            <button type="submit" class="btn btn-warning" name="ubahsatuan" onclick="return confirm('Apakah Anda yakin akan mengubah data satuan barang ini?')">Ubah</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="hapus<?php echo $ids; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h4 class="modal-title text-white">Hapus Satuan Barang</h4>
                                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus satuan barang berikut?</p>
                                                            <p><strong><?php echo $satuan; ?></strong></p>
                                                            <br>
                                                            <input type="hidden" name="id_satuan" value="<?php echo $ids; ?>">
                                                            <button type="submit" class="btn btn-danger" name="hapussatuan">Hapus</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 mt-auto text-dark fs-5 footer fixed-bottom" style="font-weight: bold;">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-center small">
                        <div class="text-center font-weight-bold">Hak Cipta &copy; JC Developer</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = new simpleDatatables.DataTable('#datatablesSimple', {
                labels: {
                    // Sesuaikan dengan bahasa yang diinginkan
                    placeholder: 'Cari...',
                    perPage: ' entri per halaman',
                    noRows: 'Tidak ada data untuk ditampilkan',
                    info: 'Menampilkan {start} sampai {end} dari {rows} entri',
                },
            });
        });
    </script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Satuan Barang</h4>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <h6>Satuan Barang</h6>
                    <input type="text" name="satuan" placeholder="Satuan Barang" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-success" name="satuanbarangmasuk" onclick="return confirm('Apakah Anda yakin akan menambah data satuan barang ini?')">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>
