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
	<!-- navbar -->
	<?php require 'navbar.php' ?>

  	<h1>Letras de Músicas</h1>
  	
  	<!-- conexão banco de dados -->
  	<?php require 'database.php' ?>
  
	<!-- pegar música selecionada -->
  	<?php
  	$sql = "
  		select musicas.titulo, artistas.artista, musicas.letra FROM musicas
		inner join artistas on artistas.indice = musicas.artistaID
		where musicas.indice =" . $_POST["indiceMusica"];
  	;
  	
	$result = $conn->query($sql);
	$conn->close();
	?>
	
	<!-- exibir titulo e artista -->
	<?php
	if ($result->num_rows == 1) {
  		$row = $result->fetch_assoc();				
	?>
	
	<h2><?php echo $row["titulo"]; ?></h2>
    <p>Artista: <?php echo $row["artista"]; ?></p>
   	
   	<!-- exibir letra da música -->
    <?php
    	// array da letra dividida em estrofes
    	$estrofesArray = explode("\n\n", $row["letra"]);

		// array da letra dividida em estrofe, e cada verso da estrofe é um elemento de array
		// arrays de versos de letras dentro de um array maior    	
    	$letra= array();
    	foreach($estrofesArray as $estrofe){
			$arrayProv = explode("\n", $estrofe);
			array_push($letra, $arrayProv); 	
    	}

		// exibir letra de música no html
		foreach($letra as $estrofe){
			?><p><?php
			
			foreach($estrofe as $verso){
				echo $verso . "<br>";
			}
			
			?></p><?php		
		}
    	
    	
    ?>
    
    <?php	
	} else {
  		echo "0 results";
	}
	?>




</div>

</body>
</html>