<?php 

  $sqlp = mysqli_query($kon, "DELETE FROM produk WHERE id_produk='$_GET[id]'");

  if($sqlp){
    echo "Produk berhasil dihapus";
  }else{
    echo "Gagal Dihapus";
  }
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=produk'>";

?>