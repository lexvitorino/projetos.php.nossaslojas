// window.onload = function() {
//     getEstados();
//     getTipos();
// }

jQuery(document).ready(function () {
    getEstados();
    getTipos();
    LojasPorMapa();

    jQuery("#idcidade").click(function() {
        resetComboPorZona();
    });
});

function resetComboPorUf() {
    jQuery('#idcidade').html("<option value=''>Seleciona</option>");
}

function resetComboPorEstado() {
    jQuery('#iduf').val("");
}

function resetComboPorZona() {
    jQuery('#zona').val("");
}

function resetComboPorCidade() {
    jQuery('#idcidade').val("");
}

function resetComboPorTipo() {
    jQuery('#idtipoloja').val("");
}

function resetBusca() {
	jQuery('#busca').val("");
	jQuery('#oriLat').attr('data-lat', 0);
    jQuery('#oriLng').attr('data-lng', 0);
}

function getEstados() {
    resetComboPorZona();
	resetBusca();
    jQuery.ajax({
        url: url + '/ajax/getEstados',
        type: 'POST',
        dataType: 'json',
        success: function (json) {
            var html = '<option value="">Seleciona</option>';
            if (json.estados && json.estados.length > 0) {
                for (var i in json.estados) {
                    var id = json.estados[i].sigla;
                    var nome = json.estados[i].nome;
                    html += '<option value="' + id + '">' + nome + '</option>';
                }

            }
            jQuery("#iduf").html(html);
            getCidades();
            getLojas();
        },
        error: function (error) {
            console.log('Error.: ' + error);
        }
    });
}

function getTipos() {
    resetComboPorZona();
	resetBusca();
    jQuery.ajax({
        url: url + '/ajax/getTipos',
        type: 'POST',
        dataType: 'json',
        success: function (json) {
            var html = '<option value="">Seleciona</option>';
            if (json.tipos && json.tipos.length > 0) {
                for (var i in json.tipos) {
                    var id = json.tipos[i].id;
                    var nome = json.tipos[i].nome;
                    html += '<option value="' + id + '">' + nome + '</option>';
                }
            }
            jQuery("#idtipoloja").html(html);
            getLojas();
        },
        error: function (error) {
            console.log('Error.: ' + error);
        }
    });
}

function getCidades() {
    resetComboPorZona();
    resetComboPorUf();
	resetBusca();
	resetComboPorTipo();
    var iiduf = jQuery('#iduf').val();
    jQuery('#map span').removeClass('selected');
    jQuery.ajax({
        url: url + '/ajax/getCidades',
        type: 'POST',
        dataType: 'json',
        data: {siglauf: iiduf},
        success: function (json) {
            var html = '<option value="">Seleciona</option>';
            if (json.cidades && json.cidades.length > 0) {
                for (var i in json.cidades) {
                    var id = json.cidades[i].id;
                    var nome = json.cidades[i].nome;
                    html += '<option value="' + id + '">' + nome + '</option>';
                }
            }
            jQuery("#idcidade").html(html);
            getLojas();
        },
        error: function (error) {
            console.log('Error.: ' + error.message);
        }
    });
}

function getCidadesPorSigla(sigla) {
    resetComboPorZona();
    resetComboPorUf();
	resetBusca();
    jQuery.ajax({
        url: url + '/ajax/getCidades',
        type: 'POST',
        dataType: 'json',
        data: {siglauf: sigla},
        success: function (json) {
            var html = '<option value="">Seleciona</option>';
            if (json.cidades && json.cidades.length > 0) {
                for (var i in json.cidades) {
                    var id = json.cidades[i].id;
                    var nome = json.cidades[i].nome;
                    html += '<option value="' + id + '">' + nome + '</option>';
                }
            }
            jQuery("#idcidade").html(html);
            getLojas();
        },
        error: function (error) {
            console.log('Error.: ' + error.message);
        }
    });
}

/* Inicia o carregamento do mapa */

var map;
var markers = [];

function getGeoCodeBusca() {
	jQuery('#oriLat').attr('data-lat', 0);
    jQuery('#oriLng').attr('data-lng', 0);
    
    var sbusca = jQuery('#busca').val();
    if (sbusca != '') {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( {'address': sbusca}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                jQuery('#oriLat').attr('data-lat', results[0].geometry.location.lat());
                jQuery('#oriLng').attr('data-lng', results[0].geometry.location.lng());
                getLojas();
            } 
        });
    } else {
        getLojas();
    }
}

jQuery("#busca").keypress(function(e) {
    if(e.which == 13) {
        resetComboPorUf();
		resetComboPorCidade();
		resetComboPorTipo();
		resetComboPorZona();
		resetComboPorEstado();
		getGeoCodeBusca();
    }
});

jQuery("#limpar").click(function(e) {
    resetComboPorZona();
	resetComboPorUf();
	resetComboPorCidade();
	resetComboPorTipo();
	resetBusca();
	getLojas();
});

function initMap() {
    var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);

    var options = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initMap();

function carregaPontos(lojas, busca) {
    clearMarkers();
    var latlngbounds = new google.maps.LatLngBounds();
    var customLabel = {
        Outlet: {
          label: 'O'
        },
        Comercial: {
          label: 'C'
        },
        Bazar: {
          label: 'B'
        }
    };
    jQuery.each(lojas, function (index, ponto) {
        ponto.endereco = ponto.logradouro + ', ' +
                         ponto.numero + ' - ' +
                         ponto.bairro + ' - ' +
                         ponto.cidade + '/' +
                         ponto.estado;
        var icon = customLabel[ponto.tipoloja] || {};
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(ponto.lat, ponto.lng),
            title: ponto.nome,
            map: map,
            label: icon.label
        });
        var contentString = '<div class="lojas-'+ponto.id+' item-loja">'+
                            '   <span class="tipo-loja tipo'+ponto.tipoloja+'">'+ ponto.tipoloja +'</span>'+
                            '   <span class="filial-nome">'+ ponto.nome +'</span>'+
                            '   <span class="endereco">'+ ponto.endereco +'</span>'+
                            '   <span class="horario">'+ ponto.horarioatendimento +'</span>'+
                            '   <span class="telefone">'+ ponto.telefone +'</span>'+
                            '</div>';
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
        latlngbounds.extend(marker.position);
        markers.push(marker);
    });        
    map.fitBounds(latlngbounds);        
}

function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
}
      
function clearMarkers() {
    setMapOnAll(null);
}

function deleteMarkers() {
    clearMarkers();
    markers = [];
}

function getLojas() {
    var iiduf = jQuery('#iduf').val();
    var iidcidade = jQuery('#idcidade').val();
    var iidtipoloja = jQuery('#idtipoloja').val();
    var izona = jQuery('#zona').val();
    var ilatOri = ''; 
    var ilngOri = '';
    var idistancia = 20;
    var descrtipoloja = '';
    ilatOri = jQuery('#oriLat').attr('data-lat');
    ilngOri = jQuery('#oriLng').attr('data-lng');
    if (iidtipoloja>0) {
        descrtipoloja = document.getElementById("idtipoloja").options[document.getElementById("idtipoloja").selectedIndex].text;
    }
    var html = '';
    jQuery("#lojas").empty();
    deleteMarkers();
    jQuery('#lb_zona').css('display','none');
    if (iiduf === 'SP' && iidcidade === '1') {
        jQuery('#lb_zona').css('display','inline-block');
    }
    jQuery.ajax({
        url: url + '/ajax2/getLojas',
        type: 'POST',
        dataType: 'json',
        data: {iduf: iiduf, idcidade: iidcidade, idtipoloja: iidtipoloja, zona: izona, distancia: idistancia, latOri: ilatOri, lngOri: ilngOri},
        success: function (json) {
            if (json.lojas && json.lojas.length > 0) {
                for (var i in json.lojas) {
                    var id = json.lojas[i].id;
                    var tipoloja = json.lojas[i].tipoloja;
					var nome = json.lojas[i].nome;
					var codigo = json.lojas[i].codigo
					var endereco = json.lojas[i].logradouro + ', ' +
					               json.lojas[i].numero + ' - ' +
								   json.lojas[i].bairro + ' - ' +
								   json.lojas[i].cidade + '/' +
								   json.lojas[i].estado;
                    var mapa = json.lojas[i].urlmapa;
                    var horario = json.lojas[i].horarioatendimento;
                    var telefone = json.lojas[i].telefone;
                    html += '<div class="lojas-'+id+' item-loja">'+
                            '   <span class="tipo-loja tipo'+tipoloja+'">'+ tipoloja +'</span>'+
                            '   <span class="filial-nome">'+ nome +'</span>'+
                            '   <span class="endereco">'+ endereco +'</span>'+
                            '   <a target="_blank" href="'+ mapa +'" class="mapa-loja"> Ver no mapa </a>'+
                            '   <span class="horario">'+ horario +'</span>'+
                            '   <span class="telefone">'+ telefone +'</span>'+
                            '</div>';
                }
                carregaPontos(json.lojas);
            }
            if (html === '') {
                if (iiduf !== '' && iidcidade > 0 && iidtipoloja === '') {
                    html = '<span class="error-loja">Ops! Aqui ainda não temos loja <strong>tng</strong>.<span class="error-loja-b">Selecione outro filtro, por favor.</span></span>';
                } else if ((iiduf !== '' || iidcidade) > 0 && iidtipoloja > 0) {
                    html = '<span class="error-loja">Ops! Aqui ainda não temos loja <strong>tng '+ descrtipoloja +'</strong>.<span class="error-loja-b">Selecione outro filtro, por favor.</span></span>';
                } else {
                    html = '<span class="error-loja">Selecione uma região</span>';
                }
            }
            jQuery("#lojas").html(html);
        },
        error: function (error) {
            console.log('Error.: ' + error);
        }
    });
}

function LojasPorMapa() {
    resetComboPorZona();
    jQuery('#map span').click(function(e) {
        e.preventDefault();
        var estados = document.getElementById("iduf");
        for (i = 0; i < estados.length; i = i + 1) {
            iduf = estados.options[i].value;
            if (iduf === this.id.toUpperCase()) {
                estados.options[i].selected=true;
            }
        }
        jQuery('#map span').removeClass('selected');
        jQuery(this).addClass('selected');
        getCidadesPorSigla(this.id);
    });
}

function getLojasPorMapa(siglauf) {
    resetComboPorZona();
    var descrtipoloja = document.getElementById("idtipoloja").options[document.getElementById("idtipoloja").selectedIndex].text;
    var html = '';
    jQuery("#lojas").empty();
    jQuery('#lb_zona').css('display','none');
    if (iiduf === 'SP' && iidcidade === '1') {
        jQuery('#lb_zona').css('display','block');
    }
    jQuery.ajax({
        url: url + '/ajax/getLojas',
        type: 'POST',
        dataType: 'json',
        data: {iduf: siglauf, idcidade: 0, idtipoloja: 0},
        success: function (json) {
            if (json.lojas && json.lojas.length > 0) {
                for (var i in json.lojas) {
                    var id = json.lojas[i].id;
                    var tipoloja = json.lojas[i].tipoloja;
                    var nome = json.lojas[i].codigo + ' - ' +
                               json.lojas[i].nome;
                    var endereco = json.lojas[i].logradouro + ', ' +
                                   json.lojas[i].numero + ' - ' +
                                   json.lojas[i].bairro + ' - ' +
                                   json.lojas[i].cidade + '/' +
                                   json.lojas[i].estado;
                    var mapa = json.lojas[i].urlmapa;
                    var horario = json.lojas[i].horarioatendimento;
                    var telefone = json.lojas[i].telefone;
                    html += '<div class="lojas-'+id+' item-loja">'+
                            '   <span class="tipo-loja tipo'+tipoloja+'">'+ tipoloja +'</span>'+
                            '   <span class="filial-nome">'+ nome +'</span>'+
                            '   <span class="endereco">'+ endereco +'</span>'+
                            '   <a target="_blank" href="'+ mapa +'" class="mapa-loja"> Ver no mapa </a>'+
                            '   <span class="horario">'+ horario +'</span>'+
                            '   <span class="telefone">'+ telefone +'</span>'+
                            '</div>';
                }
            }
            if (html === '') {
                if (iiduf !== '' && iidcidade > 0 && iidtipoloja === '') {
                    html = '<span class="error-loja">Ops! Aqui ainda não temos loja <strong>tng</strong>.<span class="error-loja-b">Selecione outro filtro, por favor.</span></span>';
                } else if ((iiduf !== '' || iidcidade) > 0 && iidtipoloja > 0) {
                    html = '<span class="error-loja">Ops! Aqui ainda não temos loja <strong>tng '+ descrtipoloja +'</strong>.<span class="error-loja-b">Selecione outro filtro, por favor.</span></span>';
                } else {
                    html = '<span class="error-loja">Selecione uma região</span>';
                }
            }
            jQuery("#lojas").html(html);
        },
        error: function (error) {
            console.log('Error.: ' + error);
        }
    });
}
