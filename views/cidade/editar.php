<h1>Editar Página</h1>

<hr/>

<form method="POST">
	Estado:<br/>
	<select name="iduf">
	    <?php foreach ($estado as $e): ?>
	        <option <?php echo $e['id']==$cidade['iduf']?'selected':''; ?> value="<?php echo ($e['id']); ?>"><?php echo ($e['sigla']); ?></option>
	    <?php endforeach; ?>
	</select><br/><br/>

	Nome:<br/>
	<input type="text" name="nome" value="<?php echo $cidade['nome'] ?>"><br/><br/>

	<input type="submit" value="Salvar">		
</form>