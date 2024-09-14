<!DOCTYPE html>
<html>
  	<head>
    	<title>Cifra de Vigenère</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  	</head>
  	<body>
		<h1 align="center">Cifra de Vigenère</h1>
		<div class="row">
			<div class="col"></div>
			<div class="col-10">
				<form method="post">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="mensagem">Mensagem:</label>
								<input type="text" class="form-control" name="mensagem" id="mensagem" placeholder="Digite uma mensagem">
								<small class="form-text text-muted">A mensagem pode conter apenas letra, números e espaços</small>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="chave">Chave textual:</label>
								<input type="text" class="form-control" name="chave" id="chave" placeholder="Digite uma chave textual">
								<small class="form-text text-muted">A chave textual deve ter o mesmo tamanho da mensagem</small>
							</div>
						</div>
					</div>
					<div class="row" align="center">
						<div class="col">
							<button type="submit" class="btn btn-primary" name="opcao" value="criptografar">Criptografar</button>
							<button type="submit" class="btn btn-primary" name="opcao" value="decriptografar">Descriptografar</button>
						</div>
					</div><br>
				</form>
			</div>
			<div class="col"></div>
		</div>

		<?php
			if(isset($_POST['opcao'])) {
				$mensagem = $_POST['mensagem'];
				$chave = $_POST['chave'];
				$opcao = $_POST['opcao'];

				// Verifica se a mensagem contém apenas letras, números e espaços
				if(!preg_match('/^[A-Z0-9 ]*$/', $mensagem)) {
					echo "<p align='center' class='alert alert-danger'>A mensagem deve conter apenas letras maiúsculas, números ou espaços.</p>";
					exit;
				}
		  
				// Verifica se a chave contém apenas letras e tem o mesmo tamanho da mensagem
				if(!preg_match('/^[A-Z0-9 ]*$/', $chave) || strlen($chave) != strlen($mensagem)) {
					echo "<p align='center' class='alert alert-danger'>A chave deve conter apenas letras maiúsculas e ter o mesmo tamanho da mensagem.</p>";
					exit;
				  }

				if($opcao == "criptografar") {
					$criptografada = criptografar($mensagem, $chave);
					echo "<p align='center' class='alert alert-primary'>Mensagem criptografada: $criptografada</p>";
				} else {
					$decriptografada = decriptografar($mensagem, $chave);
					echo "<p align='center' class='alert alert-primary'>Mensagem decriptografada: $decriptografada</p>";
				}
			}

			function buscaIndice($letra) {
				$alfabeto = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				return strpos($alfabeto, $letra);
			}

			function buscaLetra($indice) {
				$alfabeto = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				return substr($alfabeto, $indice, 1);
			}

			function criptografar($mensagem, $chave) {
				$criptografada = "";

				for($i = 0; $i < strlen($mensagem); $i++) {
					if(ctype_alpha($mensagem[$i])) {
						$letraMensagem = strtolower($mensagem[$i]);
						$letraChave = strtolower($chave[$i]);
						$indice = (buscaIndice($letraMensagem) + buscaIndice($letraChave)) % 26;
						$criptografada .= buscaLetra($indice);
					} else {
						$criptografada .= $mensagem[$i];
					}
				}
				return strtoupper($criptografada);
			}

			function decriptografar($mensagem, $chave) {
				$decriptografada = "";

				for($i = 0; $i < strlen($mensagem); $i++) {
					if(ctype_alpha($mensagem[$i])) {
						$letraMensagem = strtolower($mensagem[$i]);
						$letraChave = strtolower($chave[$i]);
						$indice = (buscaIndice($letraMensagem) - buscaIndice($letraChave) + 26) % 26;
						$decriptografada .= buscaLetra($indice);
					} else {
						$decriptografada .= $mensagem[$i];
					}
				}
				return strtoupper($decriptografada);
			}
		?>
	</body>
</html>