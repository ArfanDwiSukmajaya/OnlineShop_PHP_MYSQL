<button type="button" class="btn btn-dis">JASA PENGIRIMAN</button>
<a href="<?= "?p=jasakirimadd"; ?>">&raquo;
  <button type="button" class="btn btn-add">Tambah Jasa Pengiriman</button>
</a>

<br>

<?php 
  $sql = "SELECT * FROM jasakirim ORDER BY nama asc";
  $sqlj = mysqli_query($kon, $sql);
?>

<?php while($rj  = mysqli_fetch_array($sqlj)) :
  $tarif = number_format($rj["tarif"]); ?>
<div class="dh3">
  <div class="card">
    <div class="isicard" style="text-align:center">
      <img src="../logojasakirim/<?= $rj['logo']; ?>" border="0" width="200px" height="120px">
      <hr>
      <big><?= $rj['nama']; ?></big>
      <hr>
      <b> IDR <?= $tarif ?></b>
      <br>
    </div>
    <div class="kakicard">
      <?php           
      echo "
      <a href='?p=jasakirimedit&idj=$rj[id_jasa]'>
        <button type='button' class='btn btn-add'>Ubah Jasa Kirim</button>
      </a>";
      echo "
      <a href='?p=jasakirimdel&idj=$rj[id_jasa]'>
        <button type='button' class='btn btn-add'>Hapus Jasa Kirim</button>
      </a>";
      ?>
    </div>
  </div>
</div>
<?php endwhile; ?>