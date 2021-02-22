<?php include "layouts/header.php"; ?>
<style>
  h2 {
    color: black;
  }

  label {
    color: black;
    font-weight: 100;
  }

  .container {
    margin-top: 5%;
    width: 50%;
    padding-top: 5%;
    padding-bottom: 5%;
    padding-right: 10%;
    padding-left: 10%;
  }

  .btn-primary {
    background-color:#002c38;
  }
</style>
<?php

require_once("BaseDatos/Conexion.php");

use BaseDatos\Conexion;

if ($_POST) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $con = new Conexion;

  $sql = "SELECT * FROM usuarios where email = '$email' and password = '$password'";
  $query =  mysqli_query($con->con, $sql);
  if ($row = mysqli_fetch_array($query)) {
    session_start();
    $_SESSION['name'] = $row['name'];
    header('Location: home.php');
  } else {
    echo "<script> alert('Correo o contraseña incorrectas.'); </script>";
  }
}
?>

<div class="container">
  <center>
    <h2>Formulario de ingreso</h2>
  </center></br>
  <form class="form-horizontal" method="post" action="">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Correo:</label>

      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="ingresa tu correo" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Pass:</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="pwd" placeholder="ingresa una contraseña" name="password">
      </div>
    </div>
    <center>
    <button type="submit" class="btn btn-primary">Ingresar</button>
    </center>
  </form>
</div>

</body>

</html>