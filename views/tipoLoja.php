<h1>Cadastro de Tipo de Lojas</h1>

<hr/>

<a href="<?php echo BASE; ?>tipoLoja/adicionar">Adicionar Tipo de Loja</a><br/><br/>

<table border="0" width="100%">
	<tr>
		<th style="text-align: left">ID</th>
		<th style="text-align: left">Nome</th>
		<th style="text-align: left">Ações</th>
	</tr>
	<?php foreach($tipoLojas as $p): ?>
	<tr>
		<td><?php echo $p['id']; ?></td>
		<td><?php echo $p['nome']; ?></td>
		<td>
			<a href="<?php echo BASE; ?>tipoLoja/editar/<?php echo $p['id']; ?>">Editar</a>
			<a href="<?php echo BASE; ?>tipoLoja/excluir/<?php echo $p['id']; ?>">Excluir</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>