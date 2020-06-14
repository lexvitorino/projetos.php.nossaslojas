<?php
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Lojas | TNG</title>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE; ?>assets/js/tngax.js"></script>
    <link href="<?php echo BASE; ?>assets/css/tnglojas.css" rel="stylesheet" type="text/css" />  
</head>
<body>
<div class="container">
<div class="row">
    <h2 class="tit-loja">PRESENTE EM TODO TERRIT&#211;RIO NACIONAL</h2>
    <div class="combo-lojas">
        <form method="POST">
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
        </form> 
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <ul id="map">
            <li id="crs" estado="rs" ><span id="rs" title="RS"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="RS" /></span></li>
            <li id="csc" estado="sc" ><span id="sc" title="SC"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="SC" /></span></li>
            <li id="cpr" estado="pr" ><span id="pr" title="PR"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="PR" /></span></li>
            <li id="csp" estado="sp" ><span id="sp" title="SP"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="SP" /></span></li>
            <li id="cms" estado="ms" ><span id="ms" title="MS"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="MS" /></span></li>
            <li id="crj" estado="rj" ><span id="rj" title="RJ"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="RJ" /></span></li>
            <li id="ces" estado="es" ><span id="es" title="ES"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="ES" /></span></li>
            <li id="cmg" estado="mg" ><span id="mg" title="MG"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="MG" /></span></li>
            <li id="cgo" estado="go" ><span id="go" title="GO"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="GO" /></span></li>
            <li id="cdf" estado="df" ><span id="df" title="DF"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="DF" /></span></li>
            <li id="cba" estado="ba" ><span id="ba" title="BA"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="BA" /></span></li>
            <li id="cmt" estado="mt" ><span id="mt" title="MT"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="MT" /></span></li>
            <li id="cro" estado="ro" ><span id="ro" title="RO"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="RO" /></span></li>
            <li id="cac" estado="ac" ><span id="ac" title="AC"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="AC" /></span></li>
            <li id="cam" estado="am" ><span id="am" title="AM"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="AM" /></span></li>
            <li id="crr" estado="rr" ><span id="rr" title="RR"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="RR" /></span></li>
            <li id="cpa" estado="pa" ><span id="pa" title="PA"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="PA" /></span></li>
            <li id="cap" estado="ap" ><span id="ap" title="AP"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="AP" /></span></li>
            <li id="cma" estado="ma" ><span id="ma" title="MA"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="MA" /></span></li>
            <li id="cto" estado="to" ><span id="to" title="TO"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="TO" /></span></li>
            <li id="cse" estado="se" ><span id="se" title="SE"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="SE" /></span></li>
            <li id="cal" estado="al" ><span id="al" title="AL"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="AL" /></span></li>
            <li id="cpe" estado="pe" ><span id="pe" title="PE"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="PE" /></span></li>
            <li id="cpb" estado="pb" ><span id="pb" title="PB"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="PB" /></span></li>
            <li id="crn" estado="rn" ><span id="rn" title="RN"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="RN" /></span></li>
            <li id="cce" estado="ce" ><span id="ce" title="CE"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="CE" /></span></li>
            <li id="cpi" estado="pi" ><span id="pi" title="PI"><img src="<?php echo BASE; ?>assets/images/img-mapa/null.gif" alt="PI" /></span></li>
        </ul>
        <span class="text-obs">Utilizamos um sistema no qual as liga&ccedil;&otilde;es s&atilde;o processadas por uma central localizada em S&atilde;o Paulo. Por conta disso, o DDD de parte de nossas lojas em diferentes localidades do pa&iacute;s &eacute; 11.</span>
    </div>
    <div class="col-md-6">
        <div id="lojas">
        </div>
    </div>
</div>
</div>
</body>
</html>