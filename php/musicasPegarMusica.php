<?php
// conexão banco de dados
require 'database.php' 
?>

<?php
// pegar detalhes da musica baseado no indice
$q = intval($_GET['q']);

$sql = "
	select musicas.indice, musicas.artistaID, musicas.idiomaID, musicas.estiloID, musicas.titulo, musicas.letra
	from musicas
	where musicas.indice=" . $q;

  	
$result = $conn->query($sql);
$conn->close();

if ($result->num_rows == 1) {
  	$row = $result->fetch_assoc();
  	$array = array(
  		$row["indice"],
  		$row["artistaID"],
  		$row["estiloID"],
  		$row["idiomaID"],
  		$row["titulo"],
  		$row["letra"]
	);
  	echo json_encode($array);
 }
?>