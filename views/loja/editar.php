<h1>Editar de Tipo de Loja</h1>

<hr/>

<form method="POST">
	Código:<br/>
	<input type="text" name="codigo" value="<?php echo $loja['codigo']; ?>"><br/><br/>

	Nome:<br/>
	<input type="text" name="nome" value="<?php echo $loja['nome']; ?>"><br/><br/>

	Tipo de Loja:<br/>
	<select name="idtipoloja">
	    <?php foreach ($tipo as $e): ?>
	        <option <?php echo $e['id']==$loja['idtipoloja']?'selected':''; ?> value="<?php echo ($e['id']); ?>"><?php echo ($e['nome']); ?></option>
	    <?php endforeach; ?>
	</select><br/><br/>

	URL Mapa:<br/>
	<input type="text" name="urlmapa" value="<?php echo $loja['urlmapa']; ?>"><br/><br/>

	Latidude:<br/>
	<input type="number" name="lat" value="<?php echo $loja['lat']; ?>"><br/><br/>

	Longitude:<br/>
	<input type="number" name="lng" value="<?php echo $loja['lng']; ?>"><br/><br/>

	Telefone:<br/>
	<input type="text" name="telefone" value="<?php echo $loja['telefone']; ?>"><br/><br/>

	Horário de Atendimento:<br/>
	<input type="text" name="horarioatendimento" value="<?php echo $loja['horarioatendimento']; ?>"><br/><br/>

	CEP:<br/>
	<input type="text" name="cep" value="<?php echo $loja['cep']; ?>"><br/><br/>

	Logradouro:<br/>
	<input type="text" name="logradouro" value="<?php echo $loja['logradouro']; ?>"><br/><br/>

	Número:<br/>
	<input type="text" name="numero" value="<?php echo $loja['numero']; ?>"><br/><br/>

	Complemento:<br/>
	<input type="text" name="complemento" value="<?php echo $loja['complemento']; ?>"><br/><br/>

	Bairro:<br/>
	<input type="text" name="bairro" value="<?php echo $loja['bairro']; ?>"><br/><br/>

	Estado:<br/>
	<select name="iduf">
	    <?php foreach ($estado as $e): ?>
	        <option <?php echo $e['id']==$loja['iduf']?'selected':''; ?> value="<?php echo ($e['id']); ?>"><?php echo ($e['sigla']); ?></option>
	    <?php endforeach; ?>
	</select><br/><br/>

	Cidade:<br/>
	<select name="idcidade">
	    <?php foreach ($cidade as $e): ?>
	        <option <?php echo $e['id']==$loja['idcidade']?'selected':''; ?> value="<?php echo ($e['id']); ?>"><?php echo ($e['nome']); ?></option>
	    <?php endforeach; ?>
	</select><br/><br/>

	Zona:<br/>
	<select name="zona">
	    <option value="" <?php echo ''==$loja['zona']?'selected':''; ?>>Selecione</option>
	    <option value="ZN" <?php echo 'ZN'==$loja['zona']?'selected':''; ?>>Zona Norte</option>
	    <option value="ZS" <?php echo 'ZS'==$loja['zona']?'selected':''; ?>>Zona Sul</option>
	    <option value="ZL" <?php echo 'ZL'==$loja['zona']?'selected':''; ?>>Zona Leste</option>
	    <option value="ZO" <?php echo 'ZO'==$loja['zona']?'selected':''; ?>>Zona Oeste</option>
	    <option value="CE" <?php echo 'CE'==$loja['zona']?'selected':''; ?>>Centro</option>
	</select><br/><br/>

	<input type="submit" value="Salvar">		
</form>