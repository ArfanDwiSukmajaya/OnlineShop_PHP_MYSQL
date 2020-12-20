<a href="<?= "p?order&st=Semua"; ?>">
  <button type="button" class="btn btn-add">TRANSAKSI SEMUA</button>
</a>
<br>
<a href="<?= "p?order&st=Baru"; ?>">
  <button type="button" class="btn btn-add">Baru</button>
</a>

<a href="<?= "p?order&st=Lunas"; ?>">
  <button type="button" class="btn btn-add">Lunas</button>
</a>

<a href="<?= "p?order&st=Dikirim"; ?>">
  <button type="button" class="btn btn-add">Dikirim</button>
</a>

<a href="<?= "p?order&st=Diterima"; ?>">
  <button type="button" class="btn btn-add">Diterima</button>
</a>
<br>

<?php 
  $batas = 4;
  // $halaman = $_GET["pg"];

  if(empty($halaman)){
    $posisi = 0;
    $halaman = 1;
  }else{
    $posisi = ($halaman - 1) * $batas;
  }

  if($_GET["st"] == "Semua"){
    $status = "";
  }else{
    $status = "WHERE statusorder='$_GET[st]'";
  }

  $sqlo = mysqli_query($kon,"SELECT * FROM orders $status ORDER BY tglorder DESC");

  $no = 1;
  while($ro = mysqli_fetch_array($sqlo)) :
    if($ro["statusorder"] == "Baru"){
      $pilb = " selected";
      $pill = "";
      $pilk = "";
      $pilt = "";
    }
    if($ro["statusorder"] == "Lunas"){
      $pilb = "";
      $pill = " selected";
      $pilk = "";
      $pilt = "";
    }
    if($ro["statusorder"] == "Dikirim"){
      $pilb = "";
      $pill = "";
      $pilk = " selected";
      $pilt = "";
    }
    if($ro["statusorder"] == "Diterima"){
      $pilb = "";
      $pill = "";
      $pilk = "";
      $pilt = " selected";
    }

    $sqlod = mysqli_query($kon, "SELECT * FROM orders WHERE id_order = $ro[id_order]" );
    $rod = mysqli_fetch_array($sqlod);
    $sqlag = mysqli_query($kon, "SELECT * FROM anggota WHERE id_anggota = $rod[id_anggota]");
    $rag = mysqli_fetch_array($sqlag);
  ?>

  <div class="dh12">
    <div class="card">
      <div class="kepalacard">  
        <?= $ro["no_order"]; ?>
      </div>
      <div class="isicard">
        <br>
        Dipesan Oleh : <b><?= $rag["nama"]; ?></b>
        <br>
        Handphone &nbsp; &nbsp; <b><?= $rag['nohp']; ?></b>
        <br>
        Alamat Email : <b><?= $rag["email"]; ?></b>
        <br>
        Dipesan  Pada : <b><?= $ro["tglorder"]?> WIB </b>
        <br>
        Dikirim Ke : <b><?= $ro["alamatkirim"]?></b>

        <table border="0" cellspacing="3px">
          <?php 
            $sqlordt = mysqli_query($kon, "SELECT * FROM orderdetail WHERE id_order =$ro[id_order]");
            while($rordt = mysqli_fetch_array($sqlordt)) :
              $sqlpr = mysqli_query($kon, "SELECT * FROM produk WHERE id_produk=$rordt[id_produk]");
              $rpr = mysqli_fetch_array($sqlpr);
              $sqlj = mysqli_query($kon, "SELECT * FROM jasakirim WHERE id_jasa=$rordt[id_jasa]");
              $rj = mysqli_fetch_array($sqlj);

              $hrg = number_format($rpr["harga"]);
              $disk = ($rpr["harga"] * $rpr["diskon"]) / 100;
              $hargabaru = $rpr["harga"] - $disk;
              $hrgbr = number_format($hargabaru);
              $brt = $rordt["jumlahbeli"] * $rpr["berat"];
              $berat = $berat + $brt;

              if($rp["diskon"] > 0){
                $diskon = "<font color='red'>-$rp[diskon]</font>";
                $hargalama = "<font style='text-decoration:line-through'>IDR $hrg </font>";
              }else{
                $diskon = "";
                $hargalama = "";
              }
            endwhile;   
        ?>
          <tr valign="top">
            <td width="50px">
              <img src="../fotoproduk/<?= $rpr["foto"]; ?>" height="50px" alt="">
            </td>
            <td><b><?= $rpr["jumlahbeli"]; ?></b>
            <br>
            <?php 
            echo "$brt Kg * $rj[tarif] (<b>$rj[nama]</b>)</td>";
            ?>
          </tr>
        </table>

        <?php 
        $sqlbyr = mysqli_query($kon, "SELECT * FROM pembayaran WHERE id_order = $ro[id_order]");
        $rbyr = mysqli_fetch_array($sqlbyr);
        $rowbyr = mysqli_fetch_array($sqlbyr);
        $jmltrs = number_format($rbyr["jumlahtransfer"]);
          
        if($rowbyr > 0) : ?>
          <table width="100%" border="0">
            <tr>
              <td width="100px">
                <a href="../buktibayar/<?= $rbyr['bukti']; ?>" target="_blank">
                  <img src="../fotobayar/<?= $rbyr['bukti']; ?>" width="100px" alt="">
                </a>
              </td>
              <td>
                Ditransfer oleh :
                <br>
                <b><?= $rbyr['namapengirim']; ?></b>
                <br>
                dari b : <b><?= $rbyr['namabankpengirim']?> </b>
                <br>
                ke <b><?= $rbyr['namabankpenerima']; ?></b>
                <br>
                pada <b><?= $rbyr['tgltransfer']; ?></b>
                <br>
                sebesar <br>
                <big><b>IDR <?php $jmltrs ?></b></big>
              </td>
            </tr>
          </table>

        <?php endif ?>

        <form action="?p=orderstatus" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="idorder" value="<?= $ro['id_order']; ?>">
          <input type="hidden" name="st" id="" value="<?= $_GET['st']; ?>">
          <select name="statusorder" id="">
            <option value="Baru" <?= $pilb; ?> >Baru</option>
            <option value="Lunas" <?= $pill; ?> >Lunas</option>
            <option value="Dikirim" <?= $pilk; ?> >Baru</option>
            <option value="Diterima" <?= $pilt; ?> >Diterima</option>
          </select>
          <input type="submit" value="Ubah Status Pesanan">
        </form>
      <?php $total = number_format($ro["total"]) ?>
      </div>
      <div class="kepalacard">Total : IDR <?= $total; ?></div>
    </div>
  </div>
<?php endwhile; ?>


  <div class="dh12" align="right">
    Halaman
    <?php 
      $sqlhal = mysqli_query($kon, "SELECT * FROM orders $status");
      $jmldata = mysqli_num_rows($sqlhal);
      $jmlhal = ceil($jmldata / $batas);

      for($i = 1; $i <= $jmlhal; $i++){
        if($i == $halaman){
          echo "<span class='kotak'><b>$i</b></span>";
        }
      }

      if($halaman > 1){
        echo "<span class='kotak'>
              <a href='?p=order&pg=$prev&st=$_GET[st]'>&laquo;Prev</a>
              </span>";
      }else{
        echo "<span class='kotak'>&laquo; Prev</span>";
      }

      if($halaman < $jmlhal){
        $next = $halaman + 1;
        echo "<span class='kotak'>
              <a href='?p=order&pg=$next&st=$_GET[st]'>Next &raquo;</a>
              </span>";
      }else{
        echo "<span class='kotak'>Next &raquo;></span>";
      }
    ?>
    Transaksi <?= $_GET['st']; ?> <span class='kotak'>
      <b><?= $jmldata; ?></b>
    </span>

  <p></div>
  <p>&nbsp;</p>



