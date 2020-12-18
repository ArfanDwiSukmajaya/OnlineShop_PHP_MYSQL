<button type="button" class="btn btn-dis">ANGGOTA</button>
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


$sqlag = mysqli_query($kon, "SELECT * FROM anggota ORDER BY tgldaftar DESC limit $posisi, $batas");

// var_dump($kon);

while($rag = mysqli_fetch_array($sqlag)) : ?>
<div class="dh3">
  <div class="card">
    <div class="isicard"> 
      <img src="../foto/<?= $rag['foto']; ?>" alt="" height="80px" style="border-radius:50%">
      <hr>
      <b><?= $rag["nama"]; ?></b>
      <hr>
      <b><?= $rag["email"]; ?></b>
      <hr>
      <b><?= $rag["nohp"]; ?></b>
      <hr>
      <b><?= $rag["alamat"]; ?></b>
      <hr>
      <small><i>Terdaftar sejak <?= $rag["tgldaftar"]; ?> WIB</i></small>
    </div>
    <div class="kakicard">
      <br>
      <!-- <a href="?p=anggotadel&idag=<?= $rag["id_anggota"]; ?>">
        <button type="button" class="btn btn-add">Hapus Anggota</button>
      </a> -->
      <?php 
        echo "<a href='?p=anggotadel&idag=$rag[id_anggota]'><button type='button' class='btn btn-add'>Hapus Anggota</button></a>";
      ?>
    </div>
  </div>
  <br>
</div>
<?php endwhile ?>

<div class='dh12' align='right'>
  Halaman
  <?php 
  $sqlhal = mysqli_query($kon, "SELECT * FROM anggota");
  $jmldata = mysqli_num_rows($sqlhal);
  $jmlhal = ceil($jmldata/$batas);

  for($i = 1; $i <= $jmlhal; $i++){
    if($i == $halaman){
      echo "<span class='kotak'><b>$i</b></span>";
    }
  }

  if($halaman > 1){
    $prev = $halaman - 1;
    echo "<span class='kotak'><a href='?p=anggota&pg=$prev'>&laquo; Prev</a></span>";
  }

  if($halaman < $jmlhal){
    $next = $halaman + 1;
    echo "<span class='kotak'><a href='?p=anggota&pg=$next'>Next &laquo;</a></span>";
  }else{
    echo "<span class='kotak'>Next &raquo;</span>";
  }
  ?>

  Total Anggota <span class='kotak'><b><?= $jmldata; ?></b> </span>
  <p>
</div>
<p>&nbsp;</p>

