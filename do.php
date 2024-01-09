<?php
require 'fungsi.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='img/logo-ajm.jpeg' rel='shortcut icon'>
    <title>Barang Keluar</title>
    <style>
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

        #datatablesSimple th,
        #datatablesSimple td {
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
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
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
                    <h1 class="mt-4">Drop Order</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Jumlah Barang Keluar</th>
                                        <th>Penerima</th>
                                        <th>NO DO</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                </tfoot>
                                <tbody>
                                    <?php
                                    if (isset($_POST['saringtanggal'])) {
                                        $mulai = $_POST['tanggal_mulai'];
                                        $selesai = $_POST['tanggal_selesai'];

                                        if ($mulai != null || $selesai != null) {

                                            $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM `barang-keluar` k, stok s WHERE s.idbarang = k.idbarang
                                                    AND tanggal BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY idkeluar DESC");
                                        } else {
                                            $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM `barang-keluar` k, stok s WHERE s.idbarang = k.idbarang");
                                        }
                                    } else {
                                        $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM `barang-keluar` k, stok s WHERE s.idbarang = k.idbarang");
                                    }
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                        $idk = $data['idkeluar'];
                                        $idb = $data['idbarang'];
                                        $namabarang = $data['namabarang'];
                                        $satuan = $data['satuan'];
                                        $qty_keluar = $data['qty_keluar'];
                                        $penerima = $data['penerima'];
                                        $no_do = $data['no_do'];
                                        $foto_barang = $data['foto_barang'];
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $namabarang; ?></td>
                                            <td><?php echo $satuan; ?></td>
                                            <td><?php echo $qty_keluar; ?></td>
                                            <td><?php echo $penerima; ?></td>
                                            <td><?php echo $no_do; ?></td>
                                            <td>
                                                <?php if (!empty($foto_barang)) { ?>
                                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#lihatgambar<?php echo $idk; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="lihatgambar<?php echo $idk; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h4 class="modal-title text-white">Lihat Gambar</h4>
                                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="<?php echo $foto_barang; ?>" alt="Foto Gambar" style="width:100%;">
                                                    </div>
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
            <footer class="py-4 mt-auto text-dark fs-5 footer" style="font-weight: bold;">
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
    <script src="js/jquery.js"></script>
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

</html>
