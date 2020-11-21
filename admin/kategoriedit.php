<?php 

  $sqlk = mysqli_query($kon, "SELECT * FROM kategori WHERE idkat='$_GET[id]'");
  $rk = mysqli_fetch_array($sqlk);

?>

<a href="<?= "?p=kategori"; ?>">
  <button type="button" class="btn btn-add">KATEGORI</button>
</a>
<button type="button" class="btn btn-dis">Ubah Kategori</button>
<br>
<div class="card">
  <div class="kepalacard">Ubah Kategori</div>
  <div class="isicard" style="text-align:center">
    <form action="" name="form1" method="post" enctype="multipart/form-data">
      <input type="hidden" name="idkat" id="idkat" value="<?= "$rk[idkat]"?>">
      <input type="text" name="namakat" id="namakat" value="<?= "$rk[namakat]"?>">
      <textarea name="ketkat" id="ketkat" placeholder="Keterangan Kategori"><?= "$rk[ketkat]"; ?></textarea>
      <br>
      <input type="submit" name="simpan"  id="simpan" placeholder="Simpan Kategori">
    </form>
    <?php 
      if(isset($_POST["simpan"])){
        if(!empty($_POST["namakat"]) and !empty($_POST["ketkat"])){
          $sqlk = mysqli_query($kon, "UPDATE kategori SET namakat='$_POST[namakat]', ketkat='$_POST[ketkat]' WHERE idkat='$_POST[idkat]'");
          if($sqlk){
            echo "Kategori Berhasil Disimpan";
          }else{
            echo "Gagal Simpan";
          }
          echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=kategori'>";
        }else{
          "Isi Data Dengan Lengkap";
        }
      }
    ?>
  </div>
</div>


