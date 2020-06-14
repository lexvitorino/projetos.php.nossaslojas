<h1>Cadastro de Loja</h1>

<hr/>

<form method="POST">
	Código:<br/>
	<input type="text" name="codigo" ><br/><br/>

	Tipo de Loja:<br/>
	<select name="idtipoloja">
	    <?php foreach ($tipo as $e): ?>
	        <option value="<?php echo ($e['id']); ?>"><?php echo ($e['nome']); ?></option>
	    <?php endforeach; ?>
	</select><br/><br/>

	Nome:<br/>
	<input type="text" name="nome" ><br/><br/>

	URL Mapa:<br/>
	<input type="text" name="urlmapa" ><br/><br/>

	Telefone:<br/>
	<input type="text" name="telefone" ><br/><br/>

	Horário de Atendimento:<br/>
	<input type="text" name="horarioatendimento" ><br/><br/>

	CEP:<br/>
	<input type="text" name="cep" ><br/><br/>

	Logradouro:<br/>
	<input type="text" name="logradouro" ><br/><br/>

	Número:<br/>
	<input type="text" name="numero" ><br/><br/>

	Complemento:<br/>
	<input type="text" name="complemento" ><br/><br/>

	Bairro:<br/>
	<input type="text" name="bairro" ><br/><br/>

	Estado:<br/>
	<select name="iduf">
	    <?php foreach ($estado as $e): ?>
	        <option value="<?php echo ($e['id']); ?>"><?php echo ($e['sigla']); ?></option>
	    <?php endforeach; ?>
	</select><br/><br/>

	Cidade:<br/>
	<select name="idcidade">
	    <?php foreach ($cidade as $e): ?>
	        <option value="<?php echo ($e['id']); ?>"><?php echo ($e['nome']); ?></option>
	    <?php endforeach; ?>
	</select><br/><br/>

	Zona:<br/>
	<select name="zona">
		<option value="">Selecione</option>
	    <option value="ZN">Zona Norte</option>
	    <option value="ZN">Zona Sul</option>
	    <option value="ZN">Zona Leste</option>
	    <option value="ZN">Zona Oeste</option>
	    <option value="CE">Centro</option>
	</select><br/><br/>

	<input type="submit" value="Salvar">		
</form>