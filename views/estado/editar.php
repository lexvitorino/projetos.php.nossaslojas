<h1>Editar Estado</h1>

<hr/>

<form method="POST">
	Sigla:<br/>
	<input type="text" name="sigla" value="<?php echo $estado['sigla'] ?>"><br/><br/>

	Nome:<br/>
	<input type="text" name="nome" value="<?php echo $estado['nome'] ?>"><br/><br/>

	Informa zona:<br/>
	<input type="radio" name="flagzona" value="S" <?php echo ($estado['flagzona'] == "S") ? "checked" : null; ?>>Sim<br>
    <input type="radio" name="flagzona" value="N" <?php echo ($estado['flagzona'] == "N") ? "checked" : null; ?>> Não<br>

	<input type="submit" value="Salvar">		
</form>