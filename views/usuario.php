<h1>Cadastro de Usuários</h1>

<hr/>

<a href="<?php echo BASE; ?>usuario/adicionar">Adicionar Usuário</a><br/><br/>

<table border="0" width="100%">
	<tr>
		<th style="text-align: left">ID</th>
		<th style="text-align: left">Login</th>
		<th style="text-align: left">Ações</th>
	</tr>
	<?php foreach($usuarios as $p): ?>
	<tr>
		<td><?php echo $p['id']; ?></td>
		<td><?php echo $p['login']; ?></td>
		<td>
			<a href="<?php echo BASE; ?>usuario/editar/<?php echo $p['id']; ?>">Editar</a>
			<a href="<?php echo BASE; ?>usuario/excluir/<?php echo $p['id']; ?>">Excluir</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>