<div class="grid">
  Halaman Utama Administrator
  <h3>Selamat Datang <?= $ra['namalengkap']; ?></h3>
  <!-- Untuk Kategori -->
  <?php 
    $sqlk = mysqli_query($kon, "SELECT * FROM kategori");
    $rowk = mysqli_num_rows($sqlk);
    $sqlkl = mysqli_query($kon, "SELECT * FROM kategori ORDER BY tglkat DESC LIMIT 2");
    ?>
    <div class="dh3">
      <div class="boxval">
        <p>Kategori</p>
        <h3><?= "$rowk"; ?></h3>
      </div>
      <div class="card">
        <div class="kepalacard">Kategori Terbaru</div>
        <div class="isicard">
            <?php 
                if($rowk == 0){
                    echo "Belum ada kategori di tambahkan";
                }else{
                    echo "<hr>";
                    while($rkl = mysqli_fetch_array($sqlk)) : ?>
                        <big><?= $rkl['namakat']; ?></big>
                        <br>
                        <?= $rkl['ketkat']; ?>
                        <hr>
                    <?php endwhile;
                }
            ?>
          </div>
          <div class="kakicard">
              <a href="<?= "?p=kategori"; ?>"><button type="button" class="btn btn-padd">Lihat Semua Kategori &raquo;</button></a>
          </div>
        </div>
    <br>
    </div>

    

    <!-- Untuk Produk -->
    <?php 
      $sqlp = mysqli_query($kon, "SELECT * FROM produk");
      $rowag = mysqli_num_rows($sqlp);
      $sqlpl = mysqli_query($kon, "SELECT * FROM produk ORDER BY tglproduk DESC LIMIT 1");
    ?>
    <div class="dh3">
      <div class="boxval">
        <p>Produk</p>
        <h3><?= $rowag; ?></h3>
      </div>
      <div class="card">
        <div class="kepalacard">Produk Terbaru</div>
        <div class="isicard">
        <?php 
          if($rowag == 0){
            echo "<div align='center'>Belum Ada Produk Ditambahkan</div>";
          }else{
            echo "<hr>";
            while($rpl = mysqli_fetch_array($sqlpl)) : 
              $hrg = number_format($rpl["harga"]);
              $nm = substr($rpl["nama"],0,30);
              if($rpl["stock"] > 0){
                $stock = "<font color='00CC00'>Stock Tersedia</font>";
              }else{
                $stock = "<font color='FF0000'>Stock Habis</font>";
              }
              if($rpl["diskon"] > 0){
                $disk = ($rpl["diskon"] * $rpl['harga']) / 100;
                $hrgbaru = $rpl["harga"] - $disk;
                $hrgbr = number_format($hrgbaru);
                $diskon = "<font color='FF00000'>-$rpl[diskon]%</font>";
                $hrglama = "<font style='text-decoration:line-through><small>IDR $hrg</small></font>";
              }else{
                $hrgbr = "";
                $diskon = "";
                $hrglama = "<b>$hrg</b>";
              }              
            ?>
            <br>
            <img src="../fotoproduk/<?= $rpl['foto1']; ?> height='60px' alt="">
            <img src="../fotoproduk/<?= $rpl['foto2']; ?> height='60px' alt="">
            <hr>
            <b><?= $nm; ?></b>
            <hr>
            <b>IDR <?= $hrgbr; ?></b> <?= $diskon, $hrglama; ?>
            <hr>
            <b><?= $stock; ?></b>
            <hr>  
            <?php endwhile;
          }
        ?>
        </div>
        <div class="kakicard">
        <a href="<?= "?p=produk"; ?>"><button type="button" class="btn btn-padd">Lihat Semua Produk &raquo;</button></a>
        </div>
        <br>
      </div>
    </div>

    <!-- Untuk Anggota -->
    <?php 
      $sqlag = mysqli_query($kon, "SELECT * FROM anggota");
      $rowag = mysqli_num_rows($sqlag);
      $sqlagl = mysqli_query($kon, "SELECT * FROM anggota ORDER BY tgldaftar DESC LIMIT 1");
    ?>
    <div class="dh3">
      <div class="boxval">
        <p>Anggota</p>
        <h3><?= $rowag; ?></h3>
      </div>
      <div class="card">
        <div class="kepalacard">Anggota Terbaru</div>
        <div class="isicard">
        <?php 
          if($rowag == 0){
            echo "<hr>";
            echo "<div align='center'>Belum Ada Anggota Terdaftar</div>";
            echo "<hr>";
          }else{
            echo "<hr>";
            while($ragl = mysqli_fetch_array($sqlagl)) : ?>
              <br>
              <img src="../foto/<?= $ragl['foto']; ?> height='60px' alt=" style="border-radius:50%">
              <br>
              <b><?= $ragl['nama']; ?></b>
              <br>
              <b><?= $ragl['email']; ?></b>
              <br>
              <b><?= $ragl['nohp']; ?></b>
            <?php endwhile;
          }
        ?>
        </div>
        <div class="kakicard">
        <a href="<?= "?p=anggota"; ?>"><button type="button" class="btn btn-padd">Lihat Semua Anggota &raquo;</button></a>
        </div>
        <br>
      </div>
    </div>

     <!-- Untuk Transaksi -->
     <?php 
      $sqlo = mysqli_query($kon, "SELECT * FROM orders");
      $rowo = mysqli_num_rows($sqlo);
      $sqlol = mysqli_query($kon, "SELECT * FROM orders  WHERE statusorder='Baru' ORDER BY tglorder DESC LIMIT 1");
    ?>
    <div class="dh3">
      <div class="boxval">
        <p>Transaksi</p>
        <h3><?= $rowo; ?></h3>
      </div>
      <div class="card">
        <div class="kepalacard">Transaksi Terbaru</div>
        <div class="isicard">
        <hr>
        Status Order <br>
        <a href="<?= "?p=order&st=Baru" ?>">
          <button type="button" class="btn btn-add">Baru</button>
        </a>
        <a href="<?= "?p=order&st=Lunas" ?>">
          <button type="button" class="btn btn-add">Lunas</button>
        </a>
        <a href="<?= "?p=order&st=Dikirm" ?>">
          <button type="button" class="btn btn-add">Dikirm</button>
        </a>
        <a href="<?= "?p=order&st=Diterima" ?>">
          <button type="button" class="btn btn-add">Ditermia</button>
        </a>
        <?php 
          if($rowo == 0){
            echo "<hr>";
            echo "<div align='center'>Belum Ada Transaksi Terdaftar</div>";
            echo "<hr>";
          }else{
            echo "<hr>";
            while($rol = mysqli_fetch_array($sqlol)) : ?>
              <big><?= $rol['no_order'], $rol['statusorder']; ?></big>
              <br>
              <small><i>pada <?= $rol['tglorder']; ?> WIB</i></small>
            <?php endwhile;
          }
        ?>
        </div>
        <div class="kakicard">
        <a href="<?= "?p=order&set=Semua"; ?>"><button type="button" class="btn btn-padd">Lihat Semua Transaksi &raquo;</button></a>
        </div>
        <br>
      </div>
    </div>


  

</div>