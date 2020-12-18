<?php 

  $sql = "SELECT * FROM jasakirim WHERE id_jasa='$_GET[idj]'";
  $sqlj = mysqli_query($kon, $sql);
  $rj = mysqli_fetch_array($sqlj);

?>

<a href="<?= "?p=jasakirim"; ?>">
  <button type="button" class="btn btn-add">JASA PENGIRIMAN</button>&raquo;
</a>
<button type="button" class="btn btn-dis">Tambah Jasa Pengiriman</button>


<div class="card">
  <div class="kepalacard">Tambah Jasa Pengiriman</div>
  <br>
  <div class="isicard" style="text-align:center">
    <form action="" method="POST" action="" enctype="multipart/form-data">
      <input type="hidden" name="id_jasa" value="<?= $rj["id_jasa"]; ?>">
      <label for="nama">Nama Jasa Pengiriman</label>
      <input type="text" name="nama" id="nama" value="<?= $rj["nama"]; ?>">
      <br><br>
      <label for="detail">Detail Jasa Pengirim</label>
      <input type="text" name="detail" id="detail" value="<?= $rj["detail"]; ?>">

      <br><br>
      <label for="tarif">Tarif Jasa</label>
      <br>
      <input type="text" name="tarif" id="tarif" value="<?= $rj["tarif"]; ?>">

      <br><br>
      <label for="logo">Logo</label>
      <p><img src="<?= "../logojasakirim/$rj[logo]"; ?>" alt="" width="400px"></p>
      <br>
      <input type="file" name="logo" id="logo">

      <input type="submit" name="simpan" id="simpan" value="SIMPAN JASA PENGIRIMAN">
    </form>

    <?php 

      if(isset($_POST["simpan"])){

        $id_jasa = $_POST["id_jasa"];
        $nama = $_POST["nama"];
        $tarif = $_POST["tarif"];
        $detail = nl2br($_POST["detail"]);

        if(!empty($nama) and !empty($tarif) and !empty($detail)){

          $nmlogo = $_FILES["logo"]["name"];
          $loklogo = $_FILES["logo"]["tmp_name"];

          if(!empty($loklogo)){
            move_uploaded_file($loklogo, "../logojasakirim/$nmlogo");
            $logo = ", logo='$nmlogo'";
          }else{
            $logo = "";
          }
          $sql = "UPDATE jasakirim SET nama='$nama',
                                      detail='$detail'
                                      $logo,
                                      tarif=$tarif
                                      WHERE id_jasa=$id_jasa";
          $sqlj = mysqli_query($kon, $sql);
          if($sqlj){
            echo "Jasa Pengirim Berhasil Disimpan";
          }else{
            echo "Gagal Menyimpan";
            var_dump($id_jasa, $nama, $detail, $logo, $tarif); 
          }

          // echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=jasakirim'>";

        }else{
          echo "Data harus di isi dengan lengkap";
        }
      }
    
    ?>