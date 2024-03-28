<?php 
	include('TemplateLeitor.php');
?>
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
			if(isset($_POST['acao'])){
				$nomeArquivo = $_POST['nome_arquivo'];
				$nomePagina = $_POST['nome_pagina'];
				$conteudoPagina = '';
				foreach ($_POST as $key => $value) {
					if($key != 'acao' && $key != 'nome_arquivo' && $key != 'nome_pagina'){
						$conteudoPagina.=$value;
						$conteudoPagina.="--|--";
					}
				}
				echo $conteudoPagina;
			}
		?>
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
				
				$getContents = file_get_contents('templates/'.$nomeArquivo);
				$fields = TemplateLeitor::pegaCampos($getContents, '\{\{!(.*?)\}\}');
				
				
		?>

		<h2>Editando a página: <?php echo $nomePagina; ?> | Arquivo base: <?php echo $nomeArquivo; ?></h2>
		
		<form method="post">
			<?php 
				for ($i = 0; $i < count($fields['chave']); $i++){
					echo $fields['chave'][$i].'<input type="text" name="'.$fields['campo'][$i].'" />';
				}
			?>
			<input type="hidden" name="nome_pagina" value="<?php echo $nomePagina; ?>">
			<input type="hidden" name="nome_arquivo" value="<?php echo $nomeArquivo; ?>">
			<button type="submit" name="acao">Salvar</button>	
		</form>

		<?php 
			}
		?>
	</div><!--center-->
</div><!--main-->
</body>
</html>