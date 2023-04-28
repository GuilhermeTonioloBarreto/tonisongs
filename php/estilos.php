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

  	<h1>Estilos</h1>
  	<h2>Cadastrar estilos</h2>
  	
  	<form action="estilosAdicionar.php" method="post">
  		<div class="mb-3 mt-3">
    		<label class="form-label">Digite o estilo musical:</label>
    		<input type="text" class="form-control" id="nomeEstilo" 
    			placeholder="Nome do estilo" name="nomeEstilo" required>
  		</div>
  		<button type="submit" class="btn btn-primary">Adicionar</button>
	</form>
	
	<hr>
	
	<h2>Estilos cadastrados</h2>
	
	<!-- conexão banco de dados -->
  	<?php require 'database.php' ?>
  
  	<!-- pegar lista de artistas -->
  	<?php
  	$sql = "select estilos.indice, estilos.estilo from estilos";
  	
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
        		<th>Estilos</th>
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
    					<?php echo $row["estilo"]?>
    				</td>
    				<td class="align-middle">
    					<div class="dropdown text-end">
    						<button type="button" class="btn btn-primary btn-sm dropdown" data-bs-toggle="dropdown">&#9998;</button>
    						<ul class="dropdown-menu">
    							<li class="dropdown-item" 
    								onclick="atualizar('<?php echo $row["indice"]?>', '<?php echo $row["estilo"]?>')"
    								>Atualizar
    							</li>
    						
    							<li class="dropdown-item"
							    	onclick="deletar('<?php echo $row["indice"]?>', '<?php echo $row["estilo"]?>')"						
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
        			<h4 class="modal-title">Deletar estilo</h4>
        			<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      			</div>

      			<!-- Modal body -->
      			<div class="modal-body" id="modalBodyDeletar"></div>

      			<!-- Modal footer -->
      			<div class="modal-footer">
      				<form action="estilosDeletar.php" method="post">
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

				<form id="formAtualizar" action="estilosAtualizar.php" method="post">
 	    			<!-- Modal Header -->
      				<div class="modal-header">
        				<h4 class="modal-title">Atualizar estilo</h4>
        				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      				</div>

      				<!-- Modal body -->
      				<div class="modal-body">
      					<label class="form-label">Atualize o nome do estilo:</label>
      					<input type="text" class="form-control" id="estiloAtualizar" name="estiloAtualizar" required />
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
</div>

<script>
// função usada para exibir o modal de deletar e setar os values do forms
function deletar(indice, estilo) {
	// escrever mensagem do corpo do modalDeletar
	let bodyMessage = "Tem certeza de que deseja deletar este estilo: " + "<br>" + estilo;
	document.getElementById("modalBodyDeletar").innerHTML = bodyMessage;
	
	// escrever valor do input do formulário
	document.getElementById("idDeletar").value = indice;
		
	// exibir modalDeletar
	let myModal = new bootstrap.Modal(document.getElementById("modalDeletar"));
	myModal.show();
}

// funcao usada para exibir o modal de atualizar e setar o indice e o estilo
function atualizar(indice, estilo) {
	// escrever o nome do artista no input
	document.getElementById("estiloAtualizar").value = estilo;
	
	// escrever valor do input do formulário
	document.getElementById("idAtualizar").value = indice;
		
	// exibir modalDeletar
	let myModal = new bootstrap.Modal(document.getElementById("modalAtualizar"));
	myModal.show();
}

</script>

</body>
</html>