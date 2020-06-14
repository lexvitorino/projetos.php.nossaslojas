<?php
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Lojas | TNG</title>
    <link href="<?php echo BASE; ?>/assets/css/tnglojas.css" rel="stylesheet" type="text/css" />  
</head>
<body>
<div id="ddm" class="container">
<div class="row">
    <h2 class="tit-loja">PRESENTE EM TODO TERRIT&#211;RIO NACIONAL</h2>
    <div class="combo-lojas">
        <form method="POST" onSubmit="return false;">
            <span>
            <label>Estado</label>
            <select id="iduf" name="iduf" onchange="getCidades();"></select>
            </span>
            <span>
            <label>Cidade</label>
            <select id="idcidade" name="idcidade" onchange="getLojas();"></select>
            </span>
            <span>
            <label>Tipo de Loja</label>
            <select id="idtipoloja" name="idtipoloja" onchange="getLojas();"></select>
            </span>
            <span id="lb_zona">
            <label>Zona</label>
            <select id="zona" name="zona" onchange="getLojas();">
                <option value="">Selecione</option>
                <option value="ZN">Zona Norte</option>
                <option value="ZS">Zona Sul</option>
                <option value="ZL">Zona Leste</option>
                <option value="ZO">Zona Oeste</option>
                <option value="CE">Centro</option>
            </select>
            </span>
            <hr/>
            <span>
            <label>Busca por CEP</label>
            <input class="input-busca" id="busca" name="busca" onblur="getGeoCodeBusca();">
            <input type="hidden" id="oriLat" data-lat="0">
            <input type="hidden" id="oriLng" data-lng="0">
            <input id="limpar" type="button" value="Limpar Busca">
            </span>
        </form> 
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div id="mapa" style="height: 500px; width: 700px"> </div>
        <span class="text-obs">Utilizamos um sistema no qual as liga&ccedil;&otilde;es s&atilde;o processadas por uma central localizada em S&atilde;o Paulo. Por conta disso, o DDD de parte de nossas lojas em diferentes localidades do pa&iacute;s &eacute; 11.</span>
    </div>
    <div class="col-md-6">
        <div id="lojas">
        </div>
    </div>
</div>
</div>
<!-- Maps API Javascript -->
<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/jquery-3.1.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE_PYJ8vsHlfGRuw4L96D64b1F09gyu2o&amp;sensor=true"></script>
<script type="text/javascript" src="<?php echo BASE; ?>/assets/js/tngax2.js"></script>
<script type="text/javascript">
var url = "<?php echo BASE;?>"
</script>
</body>
</html>