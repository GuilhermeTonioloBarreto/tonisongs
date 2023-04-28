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
  
  	<!-- pegar lista de músicas -->
  	<?php
  	$sql = "
  		select musicas.indice, artistas.artista, idiomas.idioma, estilos.estilo, musicas.titulo 
		from musicas
		inner join artistas on artistas.indice = musicas.artistaID
		inner join idiomas on idiomas.indice = musicas.idiomaID
		inner join estilos on estilos.indice = musicas.estiloID
  	";
  	
	$result = $conn->query($sql);
	$conn->close();
	?>

	<!-- exibir lista de músicas -->
    <?php
		if ($result->num_rows > 0) {
			?>
			<table class="table table-hover">
    		
    		<thead>
      			<tr>
        		<th>Titulo</th>
        		<th>Artista</th>
        		<th>Estilo</th>
        		<th>Idioma</th>
      			</tr>
    		</thead>
    		
			<tbody>
			<?php
  			// output data of each row
  			while($row = $result->fetch_assoc()) {	
    			?>
    			<tr onclick="exibirLetraRequest(' <?php echo $row["indice"] ?>')">
    			<td class="align-middle"><?php echo $row["titulo"] ?></td>
    			<td class="align-middle"><?php echo $row["artista"] ?></td>
    			<td class="align-middle"><?php echo $row["estilo"] ?></td>
    			<td class="align-middle"><?php echo $row["idioma"] ?></td>
    			</tr>
    		<?php
 			}
 			?>
 			</tbody>
 			
 			</table>
 			<?php
		} else{
		?><p>Nenhuma música cadastrada</p><?php
		}
  	?>

</div>

<script>
function exibirLetraRequest(indiceMusica) {
	// criar formulário	
	let form = document.createElement('form');
	form.method = "post";
	form.action = "musicasExibir.php";
	form.type = 'hidden';
	
	// criar input com o índice da row clicada
	let input = document.createElement('input');
	input.type = 'hidden';
	input.name = 'indiceMusica';
	input.value = indiceMusica;
	
	//adicionar input ao formulário
	form.appendChild(input);
	
	document.body.appendChild(form);
	form.submit();	
}

</script>

</body>
</html>


  	