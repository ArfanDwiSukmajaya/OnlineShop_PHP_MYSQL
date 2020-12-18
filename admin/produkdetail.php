<button type="button" class="btn btn-dis">PRODUK</button> &raquo;
<a href="<?= "?p=produkadd"; ?>">
  <button type="button" class="btn btn-add">Produk Detail</button>
</a>
<br>

<?php 

  $sqlp = mysqli_query($kon, "SELECT * FROM produk WHERE id_produk='$_GET[id]'");
  $rp = mysqli_fetch_array($sqlp);

  $sqlk = mysqli_query($kon, "SELECT * FROM kategori WHERE id_kat='$rp[id_kat]'");
  $rk = mysqli_fetch_array($sqlk);

  $hrg = number_format($rp["harga"]);

  $rp["stock"] > 0 ? $stock = "<font color='#00CC00'>Stock Tersedia</font>" : $stock = "<font color='#FF0000'>Stock Habis</font>";

  if($rp["diskon"] > 0){
    $disk  = ($rp["diskon"] * $rp["harga"]) / 100; 
    $hrgbaru = $rp["harga"] - $disk;
    $hrgbr = number_format($hrgbaru);
    $diskon = "<font color='#FF0000'> -$rp[diskon]% </font>";
    $hrglama = "<font style='text-decoration:line-through'><small>IDR $hrg</small></font>";
  }else{
    $hrgbr = "";
    $diskon = "";
    $hrglama = "<b>$hrg</b>";
  }
  echo "
      <div class='dh12'>
        <div class='card'>
          <div class='kepalacard'>
            <small>Kategori : </small> $rk[namakat]
          </div>
          <div class='isicard' style='text-align:center'>
            <br>
            <img src='../fotoproduk/$rp[foto1]' border='1' width='100px' alt=''>
            <img src='../fotoproduk/$rp[foto2]' border='1' width='100px' alt=''>
            <hr>
            <big>$rp[nama]</big>
            <hr>
            <b>IDR $hrgbr</b> $diskon $hrglama
            <hr>
            <b>$stock</b>
            <hr>
            <b>Berat : $rp[berat] Kg</b>
            <hr>
            <b>Spesifikasi</b> <br> $rp[spesifikasi]
            <hr>
            <b>Detail Produk</b> <br> $rp[detail]
            <hr>
            <b>Isi dalam Kotak</b> <br> $rp[isikotak]
            <hr>
            <small>
              <i>Dibuat pada $rp[tglproduk] WIB <br> oleh $ra[namalengkap]</i>
            </small>
          </div>
          <div class='kakicard'>
            <br>
            <a href='?p=produkedit&id=$rp[id_produk]'>
              <button type='button' class='btn btn-add'>Ubah Produk </button>
            </a>
            <a href='?p=produkdel&id=$rp[id_produk]'>
              <button type='button' class='btn btn-add'>Hapus Produk </button>
            </a>
          </div>
        </div>
      </div>
      ";

?>
