<h1>Editar Usuário</h1>

<hr/>

<form method="POST">
	Login:<br/>
	<input type="text" name="login" value="<?php echo $usuario['login']; ?>"><br/><br/>

	Senha:<br/>
	<input type="password" name="senha1" ><br/><br/>

	Repetir a senha:<br/>
	<input type="password" name="senha2" ><br/><br/>

	<input type="submit" value="Salvar">		
</form>