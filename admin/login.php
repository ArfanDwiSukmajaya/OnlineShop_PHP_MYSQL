<div id="signin">
  <fieldset>
  <img src="../foto/arfan.png" width="120px" alt="">
  <form action="" method="post" name="form1" enctype="multipart/form-data">
    <h3>Administrator</h3>
    <p>Silahkan Login</p>
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="text" name="password" id="password" placeholder="Password">
    <input type="submit" name="login" id="login" value="Login Admin">
  </form>


<?php 
  if(isset($_POST["login"])){
    $sqla = mysqli_query($kon, "SELECT * FROM admin WHERE username='$_POST[username]' AND password='$_POST[password]'");
    $ra = mysqli_fetch_array($sqla);
    $row = mysqli_num_rows($sqla);
    if($row > 0){
      // session_start();
      $_SESSION["useradm"] = $ra["username"];
      $_SESSION["passadm"] = $ra["password"];
      echo "<div align='center'>Login Berhasil</div>";
    }else{
      echo "<div align='center'>Login Gagal</div>";
    }
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?p=home'>";
  }

?>

  </fieldset>
  </div>

