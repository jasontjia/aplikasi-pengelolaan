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
    <title>Data Barang</title>
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
                            <a class="nav-link text-white" href="kartustok.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-note-sticky fs-5 text-dark"></i></div>
                                <p class="mb-0 fs-5 hover-effect text-dark" style="font-weight: bold;">Kartu Stok</p>
                            </a>
                            <button onclick="confirmLogout()" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-dark fs-5" style="font-weight: bold; text-decoration: none; display: flex; align-items: center;">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt fs-5 text-dark" style="margin-left: 8px;"></i></div>
                                <span style="margin-left: 10px;">Keluar</span>
                            </button>
                        </li>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Barang</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Barang
                            </button>
                            <a href="cetaklaporanstok.php" class="btn btn-secondary">Cetak Laporan</a>
                        </div>
                        <div class="card-body">
                            <?php
                            $ambildatastok = mysqli_query($conn, "select * from stok where stock <= 3");

                            while ($fetch =  mysqli_fetch_array($ambildatastok)) {
                                $barang = $fetch['namabarang'];
                                $stock = $fetch['stock'];
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Perhatian!</strong> Stok <?php echo $barang; ?> tersisa <?php echo $stock; ?> harap segera dipesan kembali melalui supplier !
                                </div>
                            <?php
                            }
                            ?>
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Satuan</th>
                                            <th>Jumlah Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatastok = mysqli_query($conn, "select * from stok");
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatastok)) {
                                            $namabarang = $data['namabarang'];
                                            $jenisbarang = $data['jenisbarang'];
                                            $satuan = $data['satuan'];
                                            $keterangan = $data['keterangan'];
                                            $Tanggal_Expired = $data['Tanggal_Expired'];
                                            $stock = $data['stock'];
                                            $idb = $data['idbarang'];
                                        ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $namabarang; ?></td>
                                                <td><?php echo $jenisbarang; ?></td>
                                                <td><?php echo $satuan; ?></td>
                                                <td><?php echo $stock; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#lihatdata<?php echo $idb; ?>">
                                                        Lihat
                                                    </button>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?php echo $idb; ?>">
                                                        Ubah
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $idb; ?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="lihatdata<?php echo $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h4 class="modal-title text-white">Lihat Data Barang</h4>
                                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        Nama Barang<br>
                                                                        Jenis Barang<br>
                                                                        Satuan<br>
                                                                        Jumlah Stok<br>
                                                                        Keterangan<br>
                                                                        Tanggal Expired<br>
                                                                    </div>
                                                                    <div class="col"> <strong>
                                                                            : <?php echo $namabarang; ?> <br>
                                                                            : <?php echo $jenisbarang; ?> <br>
                                                                            : <?php echo $satuan; ?> <br>
                                                                            : <?php echo $stock; ?> <br>
                                                                            : <?php echo $keterangan; ?> <br>
                                                                            : <?php echo $Tanggal_Expired; ?> <br>
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="ubah<?php echo $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h4 class="modal-title text-black">Ubah Data Barang</h4>
                                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <h6>Nama Barang</h6>
                                                                <input type="text" name="namabarang" value="<?php echo $namabarang; ?>" class="form-control" required>
                                                                <br>
                                                                <h6>Jenis Barang</h6>
                                                                <select name="jenisbarang" value="<?php echo $jenisbarang; ?>" class="form-control">
                                                                    <?php
                                                                    $ambilsemuadatajenis = mysqli_query($conn, "SELECT * FROM `jenis-barang`");
                                                                    while ($datajenis = mysqli_fetch_array($ambilsemuadatajenis)) {
                                                                        $jenisbarang = $datajenis['jenisbarang'];
                                                                    ?>
                                                                        <option value="<?= $jenisbarang; ?>"><?= $jenisbarang; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <br>
                                                                <h6>Satuan</h6>
                                                                <select name="satuan" value="<?php echo $satuan; ?>" class="form-control">
                                                                    <?php
                                                                    $ambilsemuadatasatuan = mysqli_query($conn, "SELECT * FROM `satuan`");
                                                                    while ($datasatuan = mysqli_fetch_array($ambilsemuadatasatuan)) {
                                                                        $satuan = $datasatuan['satuan'];
                                                                    ?>
                                                                        <option value="<?= $satuan; ?>"><?= $satuan; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <br>
                                                                <h6>Keterangan</h6>
                                                                <textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $keterangan; ?></textarea>
                                                                <br>
                                                                <h6>Tanggal Expired</h6>
                                                                <input type="text" name="Tanggal_Expired" value="<?php echo $Tanggal_Expired; ?>" class="form-control">
                                                                <input type="hidden" name="idbarang" value="<?php echo $idb; ?>">
                                                                <br>
                                                                <button type="submit" class="btn btn-warning" name="ubahbarang" onclick="return confirm('Apakah Anda yakin akan mengubah data barang ini?')">Ubah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="hapus<?php echo $idb; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h4 class="modal-title text-white">Hapus Data Barang</h4>
                                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus data barang berikut?</p>
                                                                <p><strong><?php echo $namabarang; ?></strong></p>
                                                                <input type="hidden" name="idbarang" value="<?php echo $idb; ?>">
                                                                <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@13"></script>
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
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-white">Data Barang</h4>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                </div>

                <form method="post">
                    <div class="modal-body">
                        <h6>Nama Barang</h6>
                        <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                        <br>
                        <h6>Jenis Barang</h6>
                        <select name="jenisbarang" class="form-control">
                            <?php
                            $ambilsemuadatajenis = mysqli_query($conn, "SELECT * FROM `jenis-barang`");
                            while ($datajenis = mysqli_fetch_array($ambilsemuadatajenis)) {
                                $jenisbarang = $datajenis['jenisbarang'];
                            ?>
                                <option value="<?= $jenisbarang; ?>"><?= $jenisbarang; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <br>
                        <h6>Satuan</h6>
                        <select name="satuan" class="form-control">
                            <?php
                            $ambilsemuadatasatuan = mysqli_query($conn, "SELECT * FROM `satuan`");
                            while ($data = mysqli_fetch_array($ambilsemuadatasatuan)) {
                                $satuan = $data['satuan'];
                            ?>
                                <option value="<?= $satuan; ?>"><?= $satuan; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <br>
                        <h6>Keterangan</h6>
                        <textarea name="keterangan" placeholder="Keterangan" class="form-control"><?php echo $keterangan; ?></textarea>
                        <br>
                        <h6>Tanggal Expired</h6>
                        <input type="text" name="Tanggal_Expired" placeholder="Tanggal Expired" class="form-control">
                        <br>
                        <input type="hidden" name="stock" value="<?php echo $stock; ?>">
                        <button type="submit" class="btn btn-success" name="addnewbarang" onclick="return confirm('Apakah Anda yakin akan menambah data barang ini?')">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
