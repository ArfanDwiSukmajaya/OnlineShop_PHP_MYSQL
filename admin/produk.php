<button type="button" class="btn btn-dis">PRODUK</button> &raquo;
<a href="<?= "?p=produkadd"; ?>"><button type="button" class="btn btn-add">Tambah Produk</button></a>
<br>
<?php 

  $batas = 8;
  // $halaman = $_GET["pg"];
  
  if(empty($halaman)){
    $posisi = 0;
    $halaman = 1;
  }else{
    $posisi = ($halaman - 1) * $batas;
  }

  $sqlp = mysqli_query($kon, "SELECT * FROM produk ORDER BY tglproduk DESC limit $posisi, $batas");

  while($rp = mysqli_fetch_array($sqlp)){
    $sqlk = mysqli_query($kon, "SELECT * FROM kategori WHERE idkat = '$rp[idkat]'");
    $rk = mysqli_fetch_array($sqlk);
    $hrg = number_format($rp["harga"]);
    $nm = substr($rp["nama"], 0, 25);

    if($rp["stok"] > 0){
      $stok = "<font color='#00CC00'>Stok Tersedia</font>";
    }else{
      $stok = "<font color='#FF0000'>Stok Habis</font>";
    }

    if($rp["diskon"] > 0){
      $disk = ($rp["diskon"] * $rp["harga"]) / 100;
      $hrgbaru = $rp["harga"] - $disk;
      $hrgbr = number_format($hrgbaru);
      $diskon = "<font color='FF0000'> -$rp[diskon] %</font>";
      $hrglama = "<font style='text-decoration:line-through'><small> IDR $hrg</small></font> </font>";
    }else{
      $hrgbr = "";
      $diskon = "";
      $hrglama = "<b>$hrg</b>";
    }

    echo "<div class='dh3'>
            <div class='card'>
              <div class='kepalacard'><small>Kategori : </small> $rk[namakat]</div>
              <div class='isicard' style='text-align:center'>
                <br>
                <img src='../fotoproduk/$rp[foto1]' border='1' width='100px'>
                <img src='../fotoproduk/$rp[foto2]' border='1' width='100px'>
                <br>
                <big>$nm</big>
                <br> IDR $hrgbr</br> $diskon $hrglama
                <br>
                <b>$stok</b>
                <br>
                <small>
                  <i>Dibuat pada $rp[tglproduk] WIB
                  <br>
                  oleh $ra[namalengkap]
                  </i>
                </small>
              </div>
              <div class='kakicard'>
                <br>
                <a href='?p=produkdetail&id=$rp[idproduk]'><button type='button' class='btn btn-add'>Detail</button></a>
                <a href='?p=produkedit&id=$rp[idproduk]'><button type='button' class='btn btn-add'>Ubah Produk</button></a>
                <a href='?p=produkdel&id=$rp[idproduk]'><button type='button' class='btn btn-add'>Hapus Produk</button></a>
              </div>`
            </div> <br>
          </div>";
  }
  
  
  $sqlhal = mysqli_query($kon, "SELECT * FROM produk");
  $jmldata = mysqli_num_rows($sqlhal);
  $jmlhal = ceil($jmldata / $batas);
  echo "
        <div class='dh12' align='right'>
          Halaman";
        for ($i=1; $i < $jmlhal; $i++) { 
          if($i == $halaman){
            echo "<span class='kotak'><b>$i</b></span>";
          }
        }
        
        if($halaman > 1){
          $prev = $halaman - 1;
          echo "<span class='kotak'><a href='?p=produk&pg=$prev'>&laquo; Prev</a></span>";
        }else{
          echo "<span class='kotak'>&laquo; Prev</span>";
        }

        if($halaman < $jmlhal){
          $next = $halaman + 1;
          echo "<span class='kotak'><a href='?p=produk&pg=$next'>&raquo; Next</a></span>";
        }else{
          echo "<span class='kotak'>Next &raquo</span>";
        }

  echo "
        Total Produk <span class='kotak'><b>$jmldata</b></span>
        </div>
        <p>&nbsp;</p>
        ";
?>