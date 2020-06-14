// window.onload = function() {
//     getEstados();
//     getTipos();
// }

$(document).ready(function () {
    getEstados();
    getTipos();
    LojasPorMapa();

    $("#idcidade").click(function() {
        resetComboPorZona();
    });
});

function resetComboPorUf() {
    $('#idcidade').html("<option value=''>Seleciona</option>");
}

function resetComboPorZona() {
    $('#zona').val("");
}

function getEstados() {
    resetComboPorZona();
    $.ajax({
        url: 'https://lojas.tng.com.br/nossaslojas/ajax/getEstados',
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
            $("#iduf").html(html);
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
    $.ajax({
        url: 'https://lojas.tng.com.br/nossaslojas/ajax/getTipos',
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
            $("#idtipoloja").html(html);
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
    var iiduf = $('#iduf').val();
    $('#map span').removeClass('selected');
    $.ajax({
        url: 'https://lojas.tng.com.br/nossaslojas/ajax/getCidades',
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
            $("#idcidade").html(html);
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
    $.ajax({
        url: 'https://lojas.tng.com.br/nossaslojas/ajax/getCidades',
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
            $("#idcidade").html(html);
            getLojas();
        },
        error: function (error) {
            console.log('Error.: ' + error.message);
        }
    });
}

function getLojas() {
    var iiduf = $('#iduf').val();
    var iidcidade = $('#idcidade').val();
    var iidtipoloja = $('#idtipoloja').val();
    var izona = $('#zona').val();
    var descrtipoloja = '';
    if (iidtipoloja>0) {
        descrtipoloja = document.getElementById("idtipoloja").options[document.getElementById("idtipoloja").selectedIndex].text;
    }
    var html = '';
    $("#lojas").empty();
    $('#lb_zona').css('display','none');
    if (iiduf === 'SP' && iidcidade === '1') {
        $('#lb_zona').css('display','inline-block');
    }
    $.ajax({
        url: 'https://lojas.tng.com.br/nossaslojas/ajax/getLojas',
        type: 'POST',
        dataType: 'json',
        data: {iduf: iiduf, idcidade: iidcidade, idtipoloja: iidtipoloja, zona: izona},
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
            $("#lojas").html(html);
        },
        error: function (error) {
            console.log('Error.: ' + error);
        }
    });
}

function LojasPorMapa() {
    resetComboPorZona();
    $('#map span').click(function(e) {
        e.preventDefault();
        var estados = document.getElementById("iduf");
        for (i = 0; i < estados.length; i = i + 1) {
            iduf = estados.options[i].value;
            if (iduf === this.id.toUpperCase()) {
                estados.options[i].selected=true;
            }
        }
        $('#map span').removeClass('selected');
        $(this).addClass('selected');
        getCidadesPorSigla(this.id);
    });
}

function getLojasPorMapa(siglauf) {
    resetComboPorZona();
    var descrtipoloja = document.getElementById("idtipoloja").options[document.getElementById("idtipoloja").selectedIndex].text;
    var html = '';
    $("#lojas").empty();
    $('#lb_zona').css('display','none');
    if (iiduf === 'SP' && iidcidade === '1') {
        $('#lb_zona').css('display','block');
    }
    $.ajax({
        url: 'https://lojas.tng.com.br/nossaslojas/ajax/getLojas',
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
            $("#lojas").html(html);
        },
        error: function (error) {
            console.log('Error.: ' + error);
        }
    });
}
