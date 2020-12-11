<button type="button" class="btn btn-dis">Kategori</button> &raquo;
<a href="<?= "?p=kategoriadd"; ?>">
  <button type="button" class="btn btn-add">Tambah Kategori</button>
</a>
<br>

<?php 

  $sqlk = mysqli_query($kon, "SELECT * FROM kategori ORDER BY namakat ASC");
  
  while ($rk = mysqli_fetch_array($sqlk)) {

    $sqlp = mysqli_query($kon, "SELECT * from produk WHERE id_kat='$rk[id_kat]'");

    // $rowp = mysqli_num_rows($sqlp);
    
    echo "
      <div class='dh3'> 
        <div class='card'>
          <div class='isicard'>
          <br>
          <big>$rk[namakat]</big><div class='badge'></div>
          <hr>
          $rk[ketkat]
          <hr>
          <small>
          <i>Dibuat pada $rk[tglkat] WIB
          <hr>
          Oleh $ra[namalengkap]
          </i>
          </small>
          </div>
          <hr>
          <div class='kakicard'>
            <a href='?p=kategoriedit&id=$rk[id_kat]'>
              <button type='button' class='btn btn-add'>Ubah Kategori</button>
            </a>
            <a href='?p=kategoridel&id=$rk[id_kat]'>
              <button type='button' class='btn btn-add'>Hapus Kategori</button>
            </a>
          </div>
        </div>
      </div> 
    ";
  }

  ?>
