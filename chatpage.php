<?php
session_start();
if (isset($_SESSION['name'])) {
	include "layouts/header2.php";
	require_once("BaseDatos/Conexion.php");
	require_once("BaseDatos/GestionBd.php");

	$con = new BaseDatos\Conexion;

	$sql = "SELECT * FROM `mensajes`";

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

		.container {
			margin-top: 3%;
			width: 60%;
			border: #26262b9e 1px solid;
			border-radius: 5px;
			padding-right: 10%;
			padding-left: 10%;
		}

		.btn-primary {
			
			background-color: #002c38;
		}

		.display-chat {
			height: 300px;
			margin-bottom: 4%;
			overflow: auto;
			padding: 15px;
		}

		.message {
			background-color: #1617e469;
			color: white;
			/*height: 40px;*/
			border-radius: 5px;
			padding: 5px;
			margin-bottom: 3%;
		}
	</style>

	<meta http-equiv="refresh" content="20">
	<script>
		$(document).ready(function() {
			// Set trigger and container variables
			var trigger = $('.container .display-chat '),
				container = $('#content');

			// Fire on click
			trigger.on('click', function() {
				// Set $this for re-use. Set target from data attribute
				var $this = $(this),
					target = $this.data('target');

				// Load target page into container
				container.load(target + '.php');

				// Stop normal link behavior
				return false;
			});
		});
	</script>


	<div class="container">
		<center>
			<h2>Bienvenid@ <span style="color:#817ff3;"><?php echo $_SESSION['name']; ?> !</span></h2>
			<label>Acá puedes hablar tranquil@</label>
		</center></br>
		<div class="display-chat" id="display-chat">
			<?php
			$gestor = new BaseDatos\GestionBd;
			if (mysqli_num_rows($query) > 0) {
				while ($row = mysqli_fetch_assoc($query)) {
			?>
					<div class="message">
						<p>
							<span><?php echo $row['name']; ?> :</span>
							<?php echo $gestor->retornar_mensaje($row['comprimido'], $row['diccionario']) . "<br><br>"; ?>
							<?php echo "Comprimido: ";
							var_dump($gestor->arrayDecode($row['comprimido']));
							echo "<br><br>" ?>
							<?php echo "Diccionario: ";
							var_dump($gestor->arrayDecode($row['diccionario'])); ?>
						</p>
					</div>
				<?php
				}
			} else {
				?>
				<div class="diccionario">
					<p>
						No hay ninguna conversación previa.
					</p>
				</div>
			<?php
			}
			?>

		</div>



		<form class="form-horizontal" method="post" action="sendMessage.php">
			<div class="form-group">
				<div class="col-sm-10">
					<textarea name="msg" class="form-control" placeholder="Ingresa tu mensaje acá..."></textarea>
				</div>

				<div class="col-sm-2">
					<button type="submit" class="btn btn-primary">Enviar</button>
				</div>

			</div>
		</form>
	</div>


	</body>

	</html>
<?php
} else {
	header('location:index.php');
}
?>