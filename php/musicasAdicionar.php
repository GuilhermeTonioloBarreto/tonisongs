<!-- receber nome do artista da página anterior -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $artistaMusica = test_input($_POST["artistaMusica"]);
  $estiloMusica = test_input($_POST["estiloMusica"]);
  $idiomaMusica = test_input($_POST["idiomaMusica"]);
  $tituloMusica = test_input($_POST["tituloMusica"]);
  $letraMusica = test_input($_POST["letraMusica"]);
}else{
	echo "Nenhum nome de estilo foi enviado";
	header("Location: /musicasAdicionarForm.php");
}
?>

<!-- função que testa a entrada de dados do php -->
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!-- conexão banco de dados -->
<?php require 'database.php' ?>

<!-- inserir música -->
<?php
$sql = "
		INSERT INTO musicas(artistaID, idiomaID, estiloID, titulo, letra) 
		VALUES ('" . $artistaMusica . "','" . $idiomaMusica . "','" . $estiloMusica . 
		"','" . $tituloMusica . "','" . $letraMusica ."')
		
		";
$respostaSql = "";
if ($conn->query($sql) === TRUE) {
	$respostaSql = "Nova música adicionada";
} else {
 	$respostaSql = "Erro: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

<!-- html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Letras de Músicas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  
<div class="container">
<!-- Modal com a resposta do banco de dados -->
	<div class="modal fade" id="myModal" data-bs-backdrop='static'>
		<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">

 	    		<!-- Modal Header -->
      			<div class="modal-header">
        			<h4 class="modal-title">Mensagem do sistema</h4>
        			<button type="button" class="btn-close" data-bs-dismiss="modal"
        				onclick="voltarPagina()"></button>
      			</div>

      			<!-- Modal body -->
      			<div class="modal-body">
        			<?php echo $respostaSql; ?>
      			</div>

      			<!-- Modal footer -->
      			<div class="modal-footer">
        			<button type="button" class="btn btn-success" data-bs-dismiss="modal"
        				onclick="voltarPagina()">OK</button>
      			</div>

    		</div>
  		</div>
	</div>
</div>

<script>
// exibir modal automaticamente
let myModal = new bootstrap.Modal(document.getElementById("myModal"));
myModal.show();

function voltarPagina() {
	window.location.href="musicasAdicionarForm.php";
}

</script>

</body>
</html>





