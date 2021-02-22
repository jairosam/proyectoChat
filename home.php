<?php
session_start();
if (isset($_SESSION['name'])) {

	require_once("layouts/header2.php");
	require_once("BaseDatos/Conexion.php");

	$sql = "SELECT * FROM `mensajes`";

	$con = new BaseDatos\Conexion;

	$query = mysqli_query($con->con, $sql);
?>
	<style>
		h2 {
			color: black;
		}

		label {
			color: black;
		}

		span {
			color: white;
			font-weight: bold;
		}
		.container{
			margin-top: 150px;
		}
		.btn-primary {
			background-color: #002c38;
		}

		.display-chat {
			height: 300px;
			background-color: #d69de0;
			margin-bottom: 4%;
			overflow: auto;
			padding: 15px;
		}

		.message {
			background-color: #c616e469;
			color: black;
			border-radius: 5px;
			padding: 5px;
			margin-bottom: 3%;
		}
	</style>

	<div class="container">
		<center>
			<h2>Bienvenido <span style="color:#817ff3;"><?php echo $_SESSION['name']; ?> !</span></h2>
			<br><br>
			<label>Clic abajo para ingresar al chat</label><br>
			<br><br>
			<a href="chatpage.php" class="btn btn-primary">Abre el chat</a>
		</center>
	</div>

	</body>

	</html>
<?php
} else {
	header('location:index.php');
}
?>