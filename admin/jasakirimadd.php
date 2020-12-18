<a href="<?= "?p=jasakirim"; ?>">
  <button type="button" class="btn btn-add">JASA PENGIRIMAN</button>&raquo;
</a>
<button type="button" class="btn btn-dis">Tambah Jasa Pengiriman</button>

<div class="card">
  <div class="kepalacard">Tambah Jasa Pengiriman</div>
  <br>
  <div class="isicard" style="text-align:center">
    <form action="" method="POST" action="" enctype="multipart/form-data">
      <label for="nama">Nama Jasa Pengiriman</label>
      <input type="text" name="nama" id="nama">
      <br><br>
      <label for="detail">Detail Jasa Pengirim</label>
      <input type="text" name="detail" id="detail">

      <br><br>
      <label for="tarif">Tarif Jasa</label>
      <br>
      <input type="text" name="tarif" id="tarif">

      <br><br>
      <label for="logo">Logo</label>
      <br>
      <input type="file" name="logo" id="logo">

      <input type="submit" name="simpan" id="simpan" value="SIMPAN JASA PENGIRIMAN">
    </form>

    <?php 
    
      if(isset($_POST["simpan"])){
        if(!empty($_POST["nama"]) and !empty($_POST["tarif"]) and !empty($_POST["detail"])){
          $nmlogo = $_FILES["logo"]["name"];
          $loklogo = $_FILES["logo"]["tmp_name"];
          if(!empty($loklogo)){
            move_uploaded_file($loklogo, "../logojasakirim/$nmlogo");
          }

          $id_Admin = $ra["id_admin"];
          $nama = $_POST["nama"];
          $detail = nl2br($_POST["detail"]);
          $tarif = $_POST["tarif"];

          $sql = "INSERT INTO jasakirim (id_admin, nama, logo, detail, tarif) values ('$id_Admin', '$nama', '$nmlogo', '$detail', '$tarif')";

          $sqlj = mysqli_query($kon, $sql);

          if($sqlj){
            echo "Jasa Pengiriman Berhasil Disimpan";
          }else{
            echo "Gagal Menyimpan";
          }


          echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=jasakirim'>";

        }else{
          echo "Data hasrus diisi dngan lengkap";
        }
      }
    
    ?>

  </div>
</div>