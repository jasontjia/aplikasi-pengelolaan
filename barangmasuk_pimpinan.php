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
    <link href='img/logo-ajm.jpeg' rel='shortcut icon'>
    <title>Barang Masuk</title>
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
                    <p class="mt-2 text-dark fs-5" style="font-weight: bold;">Pemilik Toko</p>
                </div>
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link text-white" href="beranda_pimpinan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt fs-5 text-dark"></i></div>
                            <p class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Beranda</p>
                        </a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" id="stokBarangDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fas fa-database fs-5 text-dark"></i></div>
                                <span class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Data Master</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="stokBarangDropdown">
                                <a class="dropdown-item" href="databarang_pimpinan.php">Data Barang</a>
                                <a class="dropdown-item" href="jenis-barang_pimpinan.php">Jenis Barang</a>
                                <a class="dropdown-item" href="supplier_pimpinan.php">Data Supplier</a>
                                <a class="dropdown-item" href="satuan_pimpinan.php">Satuan Barang</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" id="stokBarangDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt fs-5 text-dark"></i></div>
                                <span class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Transaksi</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="stokBarangDropdown">
                                <a class="dropdown-item" href="barangmasuk_pimpinan.php">Barang Masuk</a>
                                <a class="dropdown-item" href="barangkeluar_pimpinan.php">Barang Keluar</a>
                            </div>
                        </li>
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
                    <h1 class="mt-4">Barang Masuk</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="cetaklaporanmasuk.php" class="btn btn-secondary">Cetak Laporan</a>
                            <div class="row mt-4">
                                <div class="col">
                                    <form method="post" class="form-inline">
                                        <input type="date" name="tanggal_mulai" class="form-control">
                                        <br>
                                        <input type="date" name="tanggal_selesai" class="form-control ml-3">
                                        <br>
                                        <button type="submit" name="saringtanggal" class="btn btn-info">Filter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Tanggal Masuk</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Beli</th>
                                        <th>Satuan</th>
                                        <th>Nama Supplier</th>
                                        <th>Jumlah Barang Masuk</th>
                                        <th>Total</th>
                                        <th>Status</th>
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

                                            $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM `barang-masuk` m, stok s WHERE s.idbarang = m.idbarang
                                                    AND tanggal BETWEEN '$mulai' AND DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY idmasuk DESC");
                                        } else {
                                            $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM `barang-masuk` m, stok s WHERE s.idbarang = m.idbarang");
                                        }
                                    } else {
                                        $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM `barang-masuk` m, stok s WHERE s.idbarang = m.idbarang");
                                    }

                                    while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                        $idb = $data['idbarang'];
                                        $idm = $data['idmasuk'];
                                        $tanggal = $data['tanggal'];
                                        $namabarang = $data['namabarang'];
                                        $harga_beli = $data['harga_beli'];
                                        $satuan = $data['satuan'];
                                        $nama_supplier = $data['nama_supplier'];
                                        $qty = $data['qty'];
                                        $total = $data['total'];
                                        $status = $data['status'];
                                    ?>
                                        <tr>
                                            <td><?php echo $tanggal; ?></td>
                                            <td><?php echo $namabarang; ?></td>
                                            <td>Rp <?php echo number_format($harga_beli, 0, ',', '.'); ?></td>
                                            <td><?php echo $satuan; ?></td>
                                            <td><?php echo $nama_supplier; ?></td>
                                            <td><?php echo $qty; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($total) && is_numeric($total)) {
                                                    echo 'Rp ' . number_format($total, 0, ',', '.');
                                                } else {
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <span style="color:
                                                        <?php
                                                        if ($status == 'Menunggu') {
                                                            echo 'blue';
                                                        } elseif ($status == 'Disetujui') {
                                                            echo 'green';
                                                        } elseif ($status == 'Ditolak') {
                                                            echo 'red';
                                                        }
                                                        ?>">
                                                    <?php echo $status; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                if ($status == 'Menunggu') {
                                                    echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#validasi' . $idm . '">Validasi</button>';
                                                    echo '&nbsp;';
                                                    echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus' . $idm . '">Hapus</button>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <!-- Modal Persetujuan -->
                                        <div class="modal fade" id="validasi<?php echo $idm; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Persetujuan Barang Masuk</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <h6>Konfirmasi persetujuan untuk barang masuk <?php echo $namabarang; ?></h6>
                                                            <input type="hidden" name="idmasuk" value="<?php echo $idm; ?>">
                                                            <button type="submit" class="btn btn-success" name="approvebarangmasuk">Setujui</button>
                                                            <button type="submit" class="btn btn-danger" name="tolakbarangmasuk">Tolak</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="hapus<?php echo $idm; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang Masuk</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus <?php echo $namabarang; ?> berikut?</p>
                                                            <input type="hidden" name="idbarang" value="<?php echo $idb; ?>">
                                                            <input type="hidden" name="idmasuk" value="<?php echo $idm; ?>">
                                                            <input type="hidden" name="qty" value="<?php echo $qty; ?>">
                                                            <button type="submit" class="btn btn-danger" name="hapusbarangmasukpimpinan">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        </tr>
                                    <?php
                                    };
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
                        <div class="text-center font-weight-bold">Hak Cipta &copy; Toko Asia Jaya Motor 2023</div>
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

</html>
