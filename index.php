<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Painel</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="data:,">
</head>
<body>
<header>
	<div class="logo"><a href="">DSM</a></div><!--logo-->
	<div class="menu">
		<a href="">Cadastrar pagina</a>
		<a href="">Listar pagina</a>
	</div><!--menu-->
	<div class="clear"></div><!--clear-->
</header>
<div class="main">
	<div class="center">
		<?php 
			if(!isset($_POST['etapa_2'])){
		?>
		<form method="post">
			<select name="arquivo">
				<?php 
					$files = glob('templates/*.html');
					foreach ($files as $key => $value) {
						$nomeFile = explode('/', $value);
						$arquivo = $nomeFile[count($nomeFile)-1];
						echo '<option value="'.$arquivo.'">'.$arquivo.'</option>';
					}
				?>
			</select>
			<input type="text" name="nome_pagina" placeholder="Nome da sua página" />
			<button type="submit" name="etapa_2">Proxima etapa</button>		
		</form>
		<?php 
			}else{
				$nomeArquivo = $_POST['arquivo'];
				$nomePagina = $_POST['nome_pagina'];
				//Pegamos os dados
		?>
		
		<?php 
			}
		?>
	</div><!--center-->
</div><!--main-->
</body>
</html>