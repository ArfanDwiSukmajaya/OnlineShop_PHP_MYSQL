<?php 

  $sqlp = mysqli_query($kon, "DELETE FROM jasakirim WHERE id_jasa='$_GET[idj]'");

  if($sqlp){
    echo "Jasa Kirim berhasil dihapus";
  }else{
    echo "Gagal Dihapus";
  }
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=jasakirim'>";

?>