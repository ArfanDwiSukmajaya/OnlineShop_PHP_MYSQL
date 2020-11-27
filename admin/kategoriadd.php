<a href="<?= "?p=kategori"; ?>">
  <button type="button" class="btn btn-add">KATEGORI</button>
</a>
<button type="button" class="btn btn-dis">Tambah Kategori</button>
<br>
<div class="card">
  <div class="kepalacard">
    Tambah Kategori
  </div>
  <div class="isicard" style="text-align:center">
    <form action="" name="form1" method="post" enctype="multipart/form-data">
      <input type="text" name="namakat" id="namakat" placeholder="Nama Kategori">
      <textarea name="ketkat" id="ketkat" placeholder="Keterangan Kategori"></textarea>
      <br>
      <input type="submit" name="simpan"  id="simpan" placeholder="Simpan Kategori">
    </form>


    <?php 
      if(isset($_POST["simpan"])){
        if(!empty($_POST["namakat"]) and !empty($_POST["ketkat"])){
          $sqlk = mysqli_query($kon, "INSERT INTO kategori (id_admin, namakat, ketkat, tglkat) VALUES ('$ra[id_admin]', '$_POST[namakat]', '$_POST[ketkat]', NOW() )");
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