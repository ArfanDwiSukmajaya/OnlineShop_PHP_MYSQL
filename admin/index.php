<?php 
  session_start();
  include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrator</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
  if(!empty($_SESSION["useradm"]) and !empty($_SESSION["passadm"])){
    $sqla = mysqli_query($kon, "SELECT * FROM admin WHERE username ='$_SESSION[useradm]' and password ='$_SESSION[passadm]'");
    $ra = mysqli_fetch_array($sqla);
?>
  <div class="grid">
    <div class="dh12">
      <div class="container1">
        <span style="font-size:20px;cursor:pointer; padding-right:15px" onclick="openNav()">&#9776</span>
        <a href="<?echo "?p=home"; ?>">ADS Online Shop Admin</a>
      </div>
    </div>
  </div>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn "onclick="closeNav()">&times</a>
    <img src="../foto/arfan.png" alt="">
    <p>Selamat Datang</p>
    <h3><?= "$ra[namalengkap]" ?></h3>
    <hr><a href="<?= "?p=home"; ?>">Beranda</a>
    <hr><a href="<?= "?p=kategori"; ?>">Kategori</a>
    <hr><a href="<?= "?p=produk"; ?>">Produk</a>
    <hr><a href="<?= "?p=jasakirim"; ?>">Jasa Kirim</a>
    <hr><a href="<?= "?p=anggota"; ?>">Anggota</a>
    <hr><a href="<?= "?p=order&st=semua"; ?>">Transaksi</a>
    <hr><a href="<?= "?p=logout"; ?>">Logout</a>
  </div>

  <div class="grid">
    <div class="dh12">
      <div class="container2">
        <?php 
        if($_GET["p"] == "logout"){
          include "logout.php";
        }else if($_GET["p"]== "kategori"){
          include "kategori.php";
        }else if($_GET["p"]== "kategoriadd"){
          include "kategoriadd.php";
        }else if($_GET["p"]== "kategoriedit"){
          include "kategoriedit.php";
        }else if($_GET["p"]== "kategoridel"){
          include "kategoridel.php";
        }else{
          include "home.php";
        } 
    
        ?>
      </div>
    </div>
  </div>

  <script>
    function openNav(){
      document.getElementById("mySidenav").style.width = "350px";
    }
    function closeNav(){
      document.getElementById("mySidenav").style.width = "0px";
    }
  </script>

  <div class="grid">
    <div class="dh12">
      <div class="container3">
        Copyright &copy; Arfan Dwi Sukmajaya, 2020
      </div>
    </div>
  </div>

<?php 
  }else{
    include 'login.php';
  }
?>




</body>
</html>