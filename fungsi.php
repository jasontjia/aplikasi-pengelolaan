<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "stokbarang");

//Fungsi untuk menambahkan data barang
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $jenisbarang = $_POST['jenisbarang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $satuan = $_POST['satuan'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "insert into stok(namabarang, jenisbarang, harga_beli, harga_jual, satuan, stock) values('$namabarang','$jenisbarang', '$harga_beli', '$harga_jual', '$satuan', '$stock')");
    if ($addtotable) {
        echo '<script>alert("Berhasil Simpan Data Barang");window.location="databarang.php"</script>';
    } else {
        echo 'Gagal';
        header('location:databarang.php');
    }
}

//Fungsi untuk mengubah data barang
if (isset($_POST['ubahbarang'])) {
    $namabarang = $_POST['namabarang'];
    $jenisbarang = $_POST['jenisbarang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $satuan = $_POST['satuan'];
    $idb = $_POST['idbarang'];

    $ubahbarang = mysqli_query($conn, "UPDATE stok SET namabarang='$namabarang', jenisbarang='$jenisbarang', harga_beli='$harga_beli', harga_jual='$harga_jual', satuan='$satuan'  WHERE idbarang = $idb");
    if ($ubahbarang) {
        echo '<script>alert("Berhasil Ubah Data Barang");window.location="databarang.php"</script>';
    } else {
        echo 'Gagal';
        header('location:databarang.php');
    }
}

//Fungsi menhapus data barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idbarang'];

    $hapusbarang = mysqli_query($conn, "DELETE from stok WHERE idbarang = '$idb'");
    if ($hapusbarang) {
        echo '<script>alert("Berhasil Hapus Data Barang");window.location="databarang.php"</script>';
    } else {
        echo 'Gagal';
        header('location:databarang.php');
    }
}

//Fungsi untuk menambahkan barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $harga_beli = $_POST['harga_beli'];
    $nama_supplier = $_POST['nama_supplier'];
    $satuan = $_POST['satuan'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];

    $cekstokbarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstokbarang);

    $stoksekarang = $ambildatanya['stock'];
    $tambahkanstoksekarangdenganquantity = $stoksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO `barang-masuk` (idbarang, harga_beli, nama_supplier, qty, total) VALUES ('$barangnya', '$harga_beli', '$nama_supplier', '$qty', '$total')");
    $updatestokmasuk = mysqli_query($conn, "UPDATE stok SET stock = '$tambahkanstoksekarangdenganquantity' WHERE idbarang = '$barangnya'");

    if ($addtomasuk && $updatestokmasuk) {
        echo '<script>alert("Berhasil Simpan Barang Masuk");window.location="barangmasuk.php"</script>';
    } else {
        echo 'Gagal';
        header('location:barangmasuk.php');
    }
}

// Fungsi mengubah barang masuk
if (isset($_POST['ubahbarangmasuk'])) {
    $idb = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
    $harga_beli = $_POST['harga_beli'];
    $nama_supplier = $_POST['nama_supplier'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];

    // Ambil stok sekarang dari tabel stock
    $lihatstok = mysqli_query($conn, "SELECT stock FROM stok WHERE idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stock'];

    // Ambil qty sekarang dari tabel masuk
    $qtyskrg = mysqli_query($conn, "SELECT qty FROM `barang-masuk` WHERE idmasuk = '$idm'");
    $qtynya =  mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    // Menghitung selisih antara qty baru dan qty saat ini
    $selisih = $qty - $qtyskrg;

    // Menghitung stok baru
    $stokbaru = $stokskrg + $selisih;

    $kurangistoknya = mysqli_query($conn, "UPDATE stok SET stock = '$stokbaru' WHERE idbarang='$idb'");
    $ubahnya = mysqli_query($conn, "UPDATE `barang-masuk` SET qty='$qty', harga_beli='$harga_beli', nama_supplier='$nama_supplier', total='$total' WHERE idmasuk = $idm");

    if ($kurangistoknya && $ubahnya) {
        echo '<script>alert("Berhasil Ubah Barang Masuk");window.location="barangmasuk.php"</script>';
    } else {
        echo 'Gagal';
        header('location:barangmasuk.php');
    }
}

//Fungsi untuk menghapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idm = $_POST['idmasuk'];

    $getdatastok = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $selisih = $stok - $qty;
    $update = mysqli_query($conn, "UPDATE stok SET stock = '$selisih' WHERE idbarang = '$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM `barang-masuk` WHERE idmasuk = '$idm'");

    if ($update && $hapusdata) {
        echo '<script>alert("Berhasil Hapus Barang Masuk");window.location="barangmasuk.php"</script>';
    } else {
        echo 'Gagal';
        header('location:barangmasuk.php');
    }
}

//Fungsi untuk menambahkan barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $harga_jual = $_POST['harga_jual'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];

    $cekstokbarang = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstokbarang);

    $stoksekarang = $ambildatanya['stock'];

    if ($stoksekarang >= $qty) {
        //apabila barang cukup
        $tambahkanstoksekarangdenganquantity = $stoksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO `barang-keluar` (idbarang, harga_jual, penerima, qty, total) VALUES ('$barangnya', '$harga_jual', '$penerima', '$qty', '$total')");
        $updatestokmasuk = mysqli_query($conn, "UPDATE stok SET stock = '$tambahkanstoksekarangdenganquantity' WHERE idbarang = '$barangnya'");

        if ($addtokeluar && $updatestokmasuk) {
            echo '<script>alert("Berhasil Simpan Barang Keluar");window.location="barangkeluar.php"</script>';
        } else {
            echo 'Gagal';
            header('location:barangkeluar.php');
        }
    } else {
        //apabila barang tidak cukup
        echo '
        <script>
            alert("Jumlah berang keluar saat ini sudah melebihi jumlah stok tersisa");
            window.location.href= keluar.php;
        </script>
        ';
    }
}

//Fungsi untuk mengubah barang keluar
if (isset($_POST['ubahbarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $idk = $_POST['idkeluar'];
    $harga_jual = $_POST['harga_jual'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];

    // Ambil stok sekarang dari tabel stock
    $lihatstok = mysqli_query($conn, "SELECT stock FROM `stok` WHERE idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stokskrg = $stoknya['stock'];

    // Ambil qty sekarang dari tabel masuk
    $qtyskrg = mysqli_query($conn, "SELECT qty FROM `barang-keluar` WHERE idkeluar = '$idk'");
    $qtynya =  mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurang = $stokskrg - $selisih;

        if ($selisih <= $stokskrg) {
            $kurangistoknya = mysqli_query($conn, "UPDATE stok SET stock = '$kurang' WHERE idbarang='$idb'");
            $ubahnya = mysqli_query($conn, "UPDATE `barang-keluar` SET qty='$qty', harga_jual='$harga_jual', penerima='$penerima', total='$total' WHERE idkeluar = $idk");
            if ($kurangistoknya && $ubahnya) {
                echo '<script>alert("Berhasil Ubah Barang Keluar");window.location="barangkeluar.php"</script>';
            } else {
                echo 'Gagal';
                header('location:barangkeluar.php');
            }
        } else {
            echo '
            <script> alert ("Stok Tidak Cukup");
            window.location.href="barangkeluar.php";
            </script>
            ';
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurang = $stokskrg + $selisih;
        $kurangistoknya = mysqli_query($conn, "UPDATE stok SET stock = '$kurang' WHERE idbarang='$idb'");
        $ubahnya = mysqli_query($conn, "UPDATE barang-keluar SET qty='$qty', harga_jual='$harga_jual', penerima='$penerima', total='$total' WHERE idkeluar = $idk");
        if ($kurangistoknya && $ubahnya) {
            echo '<script>alert("Berhasil Ubah Barang Keluar");window.location="barangkeluar.php"</script>';
        } else {
            echo 'Gagal';
            header('location:barangkeluar.php');
        }
    }
}

//Fungsi menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idk = $_POST['idkeluar'];

    $getdatastok = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $selisih = $stok + $qty;
    $update = mysqli_query($conn, "UPDATE stok SET stock = '$selisih' WHERE idbarang = '$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM `barang-keluar` WHERE idkeluar = '$idk'");

    if ($update && $hapusdata) {
        echo '<script>alert("Berhasil Hapus Barang Keluar");window.location="barangkeluar.php"</script>';
    } else {
        echo 'Gagal';
        header('location:barangkeluar.php');
    }
}

// Fungsi untuk menambahkan jenis barang
if (isset($_POST['jenisbarangmasuk'])) {
    $jenisbarang = $_POST['jenisbarang'];
    $addjenis = mysqli_query($conn, "INSERT INTO `jenis-barang` (`jenisbarang`) VALUES ('$jenisbarang')");

    if ($addjenis) {
        echo '<script>alert("Berhasil Simpan Jenis Barang ");window.location="jenis-barang.php"</script>';
    } else {
        echo 'Gagal';
        header('location: jenis-barang.php');
    }
}

// Fungsi untuk mengubah jenis barang
if (isset($_POST['ubahjenis'])) {
    $id_jenis = $_POST['id_jenis'];
    $jenisbarang = $_POST['jenisbarang'];
    $updatejenis = mysqli_query($conn, "UPDATE `jenis-barang` SET `jenisbarang`='$jenisbarang' WHERE `id_jenis`='$id_jenis'");

    if ($updatejenis) {
        echo '<script>alert("Berhasil Ubah Jenis Barang");window.location="jenis-barang.php"</script>';
    } else {
        echo 'Gagal';
        header('location: jenis-barang.php');
    }
}
// Fungsi untuk menghapus jenis barang
if (isset($_POST['hapusjenis'])) {
    $id_jenis = $_POST['id_jenis'];
    $hapusjenis = mysqli_query($conn, "DELETE FROM `jenis-barang` WHERE `id_jenis`='$id_jenis'");

    if ($hapusjenis) {
        echo '<script>alert("Berhasil Hapus Jenis Barang");window.location="jenis-barang.php"</script>';
    } else {
        echo 'Gagal';
        header('location: jenis-barang.php');
    }
}

// Fungsi untuk menambahkan data supplier
if (isset($_POST['supplierbarang'])) {
    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $no_telephone = $_POST['no_telephone'];
    $keterangan = $_POST['keterangan'];

    $addsupplier = mysqli_query($conn, "INSERT INTO `supplier` (`nama_supplier`, `alamat_supplier`, `no_telephone`, `keterangan`) VALUES ('$nama_supplier', '$alamat_supplier', '$no_telephone', '$keterangan')");

    if ($addsupplier) {
        echo '<script>alert("Berhasil Simpan Data Supplier ");window.location="supplier.php"</script>';
    } else {
        echo 'Gagal';
        header('location: supplier.php');
    }
}

// Fungsi untuk mengubah data supplier
if (isset($_POST['ubahsupplier'])) {
    $ids = $_POST['id_supplier'];
    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $no_telephone = $_POST['no_telephone'];
    $keterangan = $_POST['keterangan'];
    $updatesupplier = mysqli_query($conn, "UPDATE `supplier` SET `nama_supplier`='$nama_supplier', `alamat_supplier`='$alamat_supplier', `no_telephone`='$no_telephone', `keterangan`='$keterangan' WHERE `id_supplier`='$ids'");

    if ($updatesupplier) {
        echo '<script>alert("Berhasil Ubah Data Supplier ");window.location="supplier.php"</script>';
    } else {
        echo 'Gagal';
        header('location: supplier.php');
    }
}

// Fungsi untuk menghapus data supplier
if (isset($_POST['hapussupplier'])) {
    $id_supplier = $_POST['id_supplier'];

    $hapussupplier = mysqli_query($conn, "DELETE FROM `supplier` WHERE `id_supplier`='$id_supplier'");

    if ($hapussupplier) {
        echo '<script>alert("Berhasil Hapus Data Supplier ");window.location="supplier.php"</script>';
    } else {
        echo 'Gagal';
        header('location: supplier.php');
    }
}

// Fungsi untuk menambahkan satuan barang
if (isset($_POST['satuanbarangmasuk'])) {
    $satuan = $_POST['satuan'];
    $satuanbarangmasuk = mysqli_query($conn, "INSERT INTO `satuan` (`satuan`) VALUES ('$satuan')");

    if ($satuanbarangmasuk) {
        echo '<script>alert("Berhasil Simpan Satuan Barang ");window.location="satuan.php"</script>';
    } else {
        echo 'Gagal';
        header('location: satuan.php');
    }
}

// Fungsi untuk mengubah satuan barang
if (isset($_POST['ubahsatuan'])) {
    $id_satuan = $_POST['id_satuan'];
    $satuan = $_POST['satuan'];
    $ubahsatuan = mysqli_query($conn, "UPDATE `satuan` SET `satuan`='$satuan' WHERE `id_satuan`='$id_satuan'");

    if ($ubahsatuan) {
        echo '<script>alert("Berhasil Ubah Satuan Barang ");window.location="satuan.php"</script>';
    } else {
        echo 'Gagal';
        header('location: satuan.php');
    }
}

// Fungsi untuk menghapus satuan barang
if (isset($_POST['hapussatuan'])) {
    $id_satuan = $_POST['id_satuan'];
    $hapussatuan = mysqli_query($conn, "DELETE FROM `satuan` WHERE `id_satuan`='$id_satuan'");

    if ($hapussatuan) {
        echo '<script>alert("Berhasil Hapus Satuan Barang ");window.location="satuan.php"</script>';
    } else {
        echo 'Gagal';
        header('location: satuan.php');
    }
}

//Melakukan Validasi Persetujuan Barang Masuk Oleh Pimpinan
if (isset($_POST['approvebarangmasuk'])) {
    // Memastikan $idm adalah integer
    $idm = (int)$_POST['idmasuk'];

    // Lakukan query untuk mengubah status barang masuk menjadi "Approved" dalam database
    $query = "UPDATE `barang-masuk` SET status = 'Disetujui' WHERE idmasuk = ?";

    // Membuat prepared statement
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $idm);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Barang masuk disetujui.');
            window.location.href = 'barangmasuk_pimpinan.php';
        </script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup prepared statement
    mysqli_stmt_close($stmt);
}

//Melakukan Validasi Penolakan Barang Masuk Oleh Pimpinan
if (isset($_POST['tolakbarangmasuk'])) {
    // Memastikan $idm adalah integer
    $idm = (int)$_POST['idmasuk'];

    // Lakukan query untuk mengubah status barang masuk menjadi "Rejected" dalam database
    $query = "UPDATE `barang-masuk` SET status = 'Ditolak' WHERE idmasuk = ?";

    // Membuat prepared statement
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idm);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
            alert('Barang masuk ditolak.');
            window.location.href = 'barangmasuk_pimpinan.php';
        </script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Tutup prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement.";
    }
}

//Fungsi untuk menghapus barang masuk
if (isset($_POST['hapusbarangmasukpimpinan'])) {
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idm = $_POST['idmasuk'];

    $getdatastok = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $selisih = $stok - $qty;
    $update = mysqli_query($conn, "UPDATE stok SET stock = '$selisih' WHERE idbarang = '$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM `barang-masuk` WHERE idmasuk = '$idm'");

    if ($update && $hapusdata) {
        echo '<script>alert("Berhasil Hapus Barang Masuk");window.location="barangmasuk_pimpinan.php"</script>';
    } else {
        echo 'Gagal';
        header('location:barangmasuk.php');
    }
}

// Melakukan Validasi Persetujuan Barang Keluar Oleh Pimpinan
if (isset($_POST['approvebarangkeluar'])) {
    // Memastikan $idk adalah integer
    $idm = (int)$_POST['idkeluar'];

    // Lakukan query untuk mengubah status barang keluar menjadi "Disetujui" dalam database
    $query = "UPDATE `barang-keluar` SET status = 'Disetujui' WHERE idkeluar = ?";

    // Membuat prepared statement
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $idm);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
            alert('Barang keluar disetujui.');
            window.location.href = 'barangkeluar_pimpinan.php';
        </script>";
        exit;
        header('Location: barangkeluar_pimpinan.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup prepared statement
    mysqli_stmt_close($stmt);
}

// Melakukan Validasi Penolakan Barang Keluar Oleh Pimpinan
if (isset($_POST['tolakbarangkeluar'])) {
    // Memastikan $idk adalah integer
    $idm = (int)$_POST['idkeluar'];

    // Lakukan query untuk mengubah status barang keluar menjadi "Ditolak" dalam database
    $query = "UPDATE `barang-keluar` SET status = 'Ditolak' WHERE idkeluar = ?";

    // Membuat prepared statement
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $idm);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
            alert('Barang keluar ditolak.');
            window.location.href = 'barangkeluar_pimpinan.php';
        </script>";
            exit;
            header('Location: barangkeluar_pimpinan.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Tutup prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement.";
    }
}

//Fungsi barang keluar pimpinan
if (isset($_POST['hapusbarangkeluarpimpinan'])) {
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idk = $_POST['idkeluar'];

    $getdatastok = mysqli_query($conn, "SELECT * FROM stok WHERE idbarang = '$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stock'];

    $selisih = $stok + $qty;
    $update = mysqli_query($conn, "UPDATE stok SET stock = '$selisih' WHERE idbarang = '$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM `barang-keluar` WHERE idkeluar = '$idk'");

    if ($update && $hapusdata) {
        echo '<script>alert("Berhasil Hapus Barang Keluar");window.location="barangkeluar_pimpinan.php"</script>';
    } else {
        echo 'Gagal';
        header('location:barangkeluar.php');
    }
}

//Menampilkan jumlah data jenis barang di menu beranda
// Query untuk menghitung jumlah data jenis barang
$query = "SELECT COUNT(*) as jenisbarang FROM `jenis-barang`";
$result = mysqli_query($conn, $query);

// Ambil hasil query
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $jenisbarang = $row['jenisbarang'];
} else {
    $jenisbarang = 0; // Jika terjadi kesalahan, jumlah default adalah 0
}

//Menampilkan jumlah data supplier di menu beranda
// Query untuk menghitung jumlah data supplier barang
$query = "SELECT COUNT(*) as nama_supplier FROM `supplier`";
$result = mysqli_query($conn, $query);

// Ambil hasil query
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $nama_supplier = $row['nama_supplier'];
} else {
    $nama_supplier = 0; // Jika terjadi kesalahan, jumlah default adalah 0
}

//Menampilkan jumlah data satuan barang di menu beranda
// Query untuk menghitung jumlah data satuan barang
$query = "SELECT COUNT(*) as satuan FROM `satuan`";
$result = mysqli_query($conn, $query);

// Ambil hasil query
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $satuan = $row['satuan'];
} else {
    $satuan = 0; // Jika terjadi kesalahan, jumlah default adalah 0
}
