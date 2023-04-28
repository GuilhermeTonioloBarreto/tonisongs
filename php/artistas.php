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

  	<h1>Artistas</h1>
  	<h2>Cadastrar artista</h2>
  	
  	<form action="artistasAdicionar.php" method="post">
  		<div class="mb-3 mt-3">
    		<label class="form-label">Digite o nome do artista:</label>
    		<input type="text" class="form-control" id="nomeArtista" 
    			placeholder="Nome do artista" name="nomeArtista" required>
  		</div>
  		<button type="submit" class="btn btn-primary">Adicionar</button>
	</form>
	
	<hr>
	
	<h2>Artistas cadastrados</h2>
	
	<!-- conexão banco de dados -->
  	<?php require 'database.php' ?>
  
  	<!-- pegar lista de artistas -->
  	<?php
  	$sql = "select artistas.indice, artistas.artista from artistas";
  	
	$result = $conn->query($sql);
	$conn->close();
	?>

	<!-- exibir lista de artistas -->
    <?php
		if ($result->num_rows > 0) {
			?>
			<table class="table table-hover">
    		
    		<thead>
      			<tr>
        		<th>Artistas</th>
        		<th></th>
      			</tr>
    		</thead>
    		
			<tbody>
			<?php
  			// output data of each row
  			while($row = $result->fetch_assoc()) {	
    			?>
    			<tr>
    				<td class="align-middle">
						<?php echo $row["artista"]?>    				
    				</td>
    				<td class="align-middle">
    					<div class="dropdown text-end">
    						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="dropdown">&#9998;</button>
							<ul class="dropdown-menu">
    							<li class="dropdown-item" 
    								onclick="atualizar('<?php echo $row["indice"]?>', '<?php echo $row["artista"]?>')"
    								>Atualizar
    							</li>
    							<li class="dropdown-item"
							    	onclick="deletar('<?php echo $row["indice"]?>', '<?php echo $row["artista"]?>')"						
    								>Deletar
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
		?><p>Nenhum artista cadastrado</p><?php
		}
  	?>
  	
  	<!-- modal para deletar artista -->
	<div class="modal fade" id="modalDeletar" data-bs-backdrop='static'>
		<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">

 	    		<!-- Modal Header -->
      			<div class="modal-header">
        			<h4 class="modal-title">Deletar artista</h4>
        			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      			</div>

      			<!-- Modal body -->
      			<div class="modal-body" id="modalBodyDeletar"></div>

      			<!-- Modal footer -->
      			<div class="modal-footer">
      				<form action="artistasDeletar.php" method="post">
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

				<form id="formAtualizar" action="artistasAtualizar.php" method="post">
 	    			<!-- Modal Header -->
      				<div class="modal-header">
        				<h4 class="modal-title">Atualizar artista</h4>
        				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      				</div>

      				<!-- Modal body -->
      				<div class="modal-body">
      					<label class="form-label">Atualize o nome do artista:</label>
      					<input type="text" class="form-control" id="artistaAtualizar" name="artistaAtualizar" required />
      					<input type="hidden" id="idAtualizar" name="idAtualizar" />
      				</div>

      				<!-- Modal footer -->
      				<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
						<button type="submit" class="btn btn-success" data-bs-dismiss="modal">Sim</button>    				
      				</div>
				</form>
				
    		</div>
  		</div>
	</div>


<script>
// função usada para exibir o modal de deletar e setar os values do forms
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
function atualizar(indice, artista) {
	// escrever o nome do artista no input
	document.getElementById("artistaAtualizar").value = artista;
	
	// escrever valor do input do formulário
	document.getElementById("idAtualizar").value = indice;
		
	// exibir modalDeletar
	let myModal = new bootstrap.Modal(document.getElementById("modalAtualizar"));
	myModal.show();
}


</script>

</body>
</html>