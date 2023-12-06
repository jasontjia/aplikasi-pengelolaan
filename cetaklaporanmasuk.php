<?php
require 'fungsi.php';
require 'cek.php';
?>
<html>

<head>
    <title>Laporan Barang Masuk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href='img/logo-ajm.jpeg' rel='shortcut icon'>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container align-content-center">
        <h2 class="text-center">Laporan Stok Barang Masuk Toko Asia Jaya Motor</h2>
        <h4 class="text-center">Barang Masuk</h4>
        <div class="data-tables datatable-dark">
            <div class="row mt-4">
                <div class="col">
                    <form method="post" class="form-inline">
                        <input type="date" name="tanggal_mulai" class="form-control">
                        <input type="date" name="tanggal_selesai" class="form-control ml-3">
                        <br>
                        <button type="submit" name="saringtanggal" class="btn btn-info ml-3">Filter</button>
                    </form>
                </div>
            </div>
            <table id="tabelmasuk" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Satuan</th>
                        <th>Nama Supplier</th>
                        <th>Jumlah Barang Masuk</th>
                        <th>Total</th>
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
                        </tr>
                    <?php
                    };
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabelmasuk').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>
