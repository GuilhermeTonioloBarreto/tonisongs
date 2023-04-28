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

  	<h1>Músicas</h1>
  	<h2>Adicionar Música</h2>
  	
  	<form action="musicasAdicionar.php" method="post">
  		<div class="mb-3 mt-3">
    		<label class="form-label">Selecione o artista:</label>
    		
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
  			<?php
				if ($result->num_rows == 0) {
  					?><p>Nenhum artista cadastrado. Por favor, <b>cadastre um artista</b></p><?php ;
				}	    		
    		?>
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
  			<?php
				if ($result->num_rows == 0) {
  					?><p>Nenhum estilo cadastrado. Por favor, <b>cadastre um estilo</b></p><?php ;
				}	    		
    		?>
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
  			<?php
				if ($result->num_rows == 0) {
  					?><p>Nenhum idioma cadastrado. Por favor, <b>cadastre um idioma</b></p><?php ;
				}	    		
    		?>
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
  		
  		<button type="submit" class="btn btn-primary">Adicionar</button>
	</form>
  
  	<br>
</div>

<script>

</script>

</body>
</html>