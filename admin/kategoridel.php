<?php 

  $sqlk = mysqli_query($kon, "DELETE FROM kategori WHERE idkat='$_GET[id]'");

  if($sqlk){
    echo "Katerogi berhasil dihapus";
  }else{
    echo "Gagal Dihapus";
  }
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=kategori'>";

?>