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
  	<h2>Editar Músicas</h2>
  	
  	<!-- conexão banco de dados -->
  	<?php require 'database.php' ?>
  
  	<!-- pegar lista de músicas -->
  	<?php
  	$sql = "
  		select musicas.indice, musicas.titulo, artistas.artista 
		from musicas
		inner join artistas on artistas.indice = musicas.artistaID
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
        		<th>Música</th>
        		<th>Artista</th>
        		<th></th>
      			</tr>
    		</thead>
    		
			<tbody>
			<?php
  			// output data of each row
  			while($row = $result->fetch_assoc()) {	
    			?>  


    				<tr>
    					<td><?php echo $row["titulo"]?></td>			
						<td><?php echo $row["artista"]?></td>
						<td class="align-middle">
							<div class="dropdown text-end">
								<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown">&#9998;</button>
								<ul class="dropdown-menu">
    							<li class="dropdown-item" 
    								onclick="atualizar('<?php echo $row["indice"]?>')">Atualizar
    							</li>
    							<li class="dropdown-item"
							    	onclick="deletar('<?php echo $row["indice"]?>', '<?php echo $row["artista"]?>')">Deletar
    							</li>
  							</ul>
							</div>
						</td>
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
  	
  	
  	<!-- modal para deletar artista -->
	<div class="modal fade" id="modalDeletar" data-bs-backdrop='static'>
		<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">

 	    		<!-- Modal Header -->
      			<div class="modal-header">
        			<h4 class="modal-title">Deletar música</h4>
        			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      			</div>

      			<!-- Modal body -->
      			<div class="modal-body" id="modalBodyDeletar"></div>

      			<!-- Modal footer -->
      			<div class="modal-footer">
      				<form action="musicasDeletar.php" method="post">
						<input type="hidden" id="idDeletar" name="idDeletar" />
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
						<button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>    				
      				</form>
      			</div>

    		</div>
  		</div>
	</div>
	
	<!-- modal para atualizar artista -->
	<div class="modal fade" id="modalAtualizar" data-bs-backdrop='static'>
		<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">

				<form id="formAtualizar" action="musicasAtualizar.php" method="post">
 	    			<!-- Modal Header -->
      				<div class="modal-header">
        				<h4 class="modal-title">Atualizar música</h4>
        				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      				</div>

      				<!-- Modal body -->
      				<div class="modal-body">
      					<div class="mb-3 mt-3">
    						<label class="form-label">Atualize o artista:</label>
    		
							<!-- conexão banco de dados -->
  							<?php require 'database.php' ?>     		
    		
							<!-- pegar lista de artistas -->
  							<?php
  								$sql = "SELECT * FROM artistas WHERE 1";
								$result = $conn->query($sql);
								$conn->close();
							?>     		
    		
    						<select class="form-select" name="artistaMusica" id="artistaMusica" required>
    						<?php
  								// output data of each row
  								while($row = $result->fetch_assoc()) {
    								?><option value="<?php echo $row["indice"] ?>"> <?php echo $row["artista"] ?></option><?php
  								}?>
  							</select>
  					</div>
  		
  					<div class="mb-3 mt-3">
    					<label class="form-label">Selecione o estilo:</label>
    		
						<!-- conexão banco de dados -->
  						<?php require 'database.php' ?>     		
    		
						<!-- pegar lista de artistas -->
  						<?php
  							$sql = "SELECT * FROM estilos WHERE 1";
							$result = $conn->query($sql);
							$conn->close();
						?>     		
    		
    					<select class="form-select" name="estiloMusica" id="estiloMusica" required>
    					<?php
  						// output data of each row
  							while($row = $result->fetch_assoc()) {
    							?><option value="<?php echo $row["indice"] ?>"> <?php echo $row["estilo"] ?></option><?php
  							}?>
  						</select>
  					</div>
  		
  					<div class="mb-3 mt-3">
    					<label class="form-label">Selecione o idioma:</label>
    		
						<!-- conexão banco de dados -->
  						<?php require 'database.php' ?>     		
    		
						<!-- pegar lista de artistas -->
  						<?php
  							$sql = "SELECT * FROM idiomas ORDER BY idioma DESC;";
							$result = $conn->query($sql);
							$conn->close();
						?>     		
    		
    					<select class="form-select" name="idiomaMusica" id="idiomaMusica" required>
    					<?php
  						// output data of each row
  							while($row = $result->fetch_assoc()) {
    							?><option value="<?php echo $row["indice"] ?>"> <?php echo $row["idioma"] ?></option><?php
  							}?>
  						</select>
  					</div>
  					
  					<div class="mb-3 mt-3">
    					<label class="form-label">Digite o nome da música</label>
    					<input type="text" class="form-control" id="tituloMusica" name="tituloMusica" 
    						placeholder="Nome da Música" required />
  					</div>
  		
  					<div class="mb-3 mt-3">
    					<label class="form-label">Digite a letra da música</label>
  		  				<textarea class="form-control" rows="10" id="letraMusica" name="letraMusica" 
  		  					placeholder="Letra da Música" required></textarea>
  					</div>

      				<!-- Modal footer -->
      				<div class="modal-footer">
      					<input type="hidden" id="idAtualizar" name="idAtualizar" />
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
						<button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>    				
      				</div>
				</form>
				
    		</div>
  		</div>
	</div>


</div>

<script>

function deletar(indice, artista) {
	// escrever mensagem do corpo do modalDeletar
	let bodyMessage = "Tem certeza de que deseja deletar este artista: " + "<br>" + artista;
	document.getElementById("modalBodyDeletar").innerHTML = bodyMessage;
	
	// escrever valor do input do formulário
	document.getElementById("idDeletar").value = indice;
		
	// exibir modalDeletar
	let myModal = new bootstrap.Modal(document.getElementById("modalDeletar"));
	myModal.show();
}

// funcao usada para exibir o modal de atualizar e setar o indice e o artista
function atualizar(indice) {
	let xmlhttp = new XMLHttpRequest();
	
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      	let musica = JSON.parse(this.responseText); 
		
		// escrever o id do artista no input
		document.getElementById("artistaMusica").value = musica[1];
		
		// escrever o id do estilo no input
		document.getElementById("estiloMusica").value = musica[2];
		
		// escrever o id do idioma no input
		document.getElementById("idiomaMusica").value = musica[3];
		
		// escrever o nome da música no input
		document.getElementById("tituloMusica").value = musica[4];
		
		// escrever o nome da letra no input
		document.getElementById("letraMusica").value = musica[5];
		
		// escrever o id da música no input
		document.getElementById("idAtualizar").value = musica[0];
		
		// exibir modalDeletar
		let myModal = new bootstrap.Modal(document.getElementById("modalAtualizar"));
		myModal.show();
      }
    };
    
    xmlhttp.open("GET","musicasPegarMusica.php?q=" + indice, true);
    xmlhttp.send();
}


</script>

</body>
</html>
