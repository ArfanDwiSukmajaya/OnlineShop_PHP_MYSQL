<a href="<?php echo "?p=produk"; ?>"><button type="button" class="btn btn-add">Product</button></a>
<button type="button" class="btn btn-dis">Ubah Produk</button>
<br>
<div class="card">
<div class="cardhead">Ubah Produk</div>
<div class="cardbody" style="text-align:center;">
<?php 

$sqlp = mysqli_query($kon, "SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
$rp = mysqli_fetch_array($sqlp);

?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id_produk" id="id_produk" value="<?= "$rp[id_produk]"; ?>">
    Nama :
    <input type="text" name="nama" id="nama" value="<?= "$rp[nama]"; ?>">
    <br>
    Harga :
    <input type="text" name="harga" id="harga" placeholder="Harga Pprduk (IDR)" value="<?= "$rp[harga]"; ?>">
    <br>
    Stock :
    <input type="text" name="stock" id="stock" placeholder="Stok Produk" value="<?= "$rp[stock]"; ?>">
    <br>
    Spesifikasi :
    <textarea name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi Produk"><?= $rp['spesifikasi']; ?></textarea>
    <br>
    Detail :
    <textarea name="detail" id="detail" placeholder="Detail Produk"><?= "$rp[detail]" ?></textarea>
    <br>
    Diskon :
    <input type="text" name="diskon" id="diskon" placeholder="Diskon (%)" value="<?= "$rp[diskon]"; ?>">
    <br>
    Berat :
    <input type="text" name="berat" id="berat"placeholder="Berat (kg)" value="<?= "$rp[berat]"; ?>">
    <br>
    Isi Kotak :
    <textarea name="isikotak" id="isikotak" placeholder="Isi dalam kotak"><?= $rp["isikotak"]; ?></textarea>
    <br>
    Foto 1 :
    <p><img src="<?= "../fotoproduk/$rp[foto1]"; ?>" alt="" width="600px"></p>
    <input type="file" name="foto1" id="foto1">
    <br>
    <input type="file" name="foto2" id="foto2">
    <input type="submit" name="simpan" value="SIMPAN PRODUK">
</form>

<?php 
    if (isset($_POST["simpan"])) {

        $id_produk = $_POST["id_produk"];
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stock = $_POST['stock'];
        $diskon = $_POST['diskon'];
        $berat= $_POST['berat'];
        $spek = nl2br($_POST["spesifikasi"]);
        $detail = nl2br($_POST["detail"]);
        $isikotak = nl2br($_POST["isikotak"]);
        
        if (!empty($nama) and !empty($harga) and !empty($stock) and !empty($spek) and !empty($detail) and !empty($berat) and !empty($isikotak)) {
            $nmfoto1 = $_FILES["foto1"]["name"];
            $lokfoto1 = $_FILES["foto1"]["tmp_name"];
            if (!empty($lokfoto1)) {
                move_uploaded_file($lokfoto1, "../fotoproduk/$nmfoto1");
                $foto1 = ", foto1='$nmfoto1";
            }else{
                $foto1 = "";
            }

            $nmfoto2 = $_FILES["foto2"]["name"];
            $lokfoto2 = $_FILES["foto2"]["tmp_name"];
            if (!empty($lokfoto2)) {
                move_uploaded_file($lokfoto2, "../fotoproduk/$nmfoto2");
                $foto2 = ", foto2 ='$nmfoto2'";
            }else{
                $foto2 = "";
            }

            $sql = "UPDATE produk SET
                    nama = '$nama',
                    harga = '$harga',
                    stock = '$stock',
                    spesifikasi = '$spek',
                    detail = '$detail',
                    diskon = '$diskon',
                    berat = '$berat',
                    isikotak = '$isikotak'
                    foto1 = '$foto1',
                    foto2 = '$foto2'
                    WHERE id_poduk = '$id_produk'
                    ";
            $sqlp = mysqli_query($kon, $sql);
            
            $sqlp ? "Perubahan Produk Berhasil Disimpan" :  "Gagal Menyimpan";
            echo $sqlp;

            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=produk'>";

        } else {
            echo "DATA HARUS DIISI DENGAN LENGKAP!";
        }
    }
?>