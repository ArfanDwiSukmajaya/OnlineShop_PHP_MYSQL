<?php 

  // $id_anggota = $_GET['idag'];
  $sqlag = mysqli_query($kon, "DELETE FROM anggota WHERE id_anggota = '$_GET[idag]' ");

  if($sqlag){
    echo "Anggota Berhasil Dihapus";
  }else{
    echo "Gagal Menghapus";
  }

  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=anggota'>";

?>