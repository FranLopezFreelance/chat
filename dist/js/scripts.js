$(document).ready(function(){
        var heightWin = $(window).height();
        var heightNav = $('#nav').height();
        var heightTitulo = 130;
        var heightCaja = $('#cajaMensaje').height();
        var suma = heightWin - heightNav - heightTitulo - heightCaja;
        $('#chat').height(suma);
});

function enviaMensaje(men, id1, id2){
        var parametros = {
                "mensaje" : men,
                "id_de" : id1,
                "id_para" : id2
        };
        $.ajax({
                data:  parametros,
                url:   'enviaMensaje.php',
                type:  'post',
                beforeSend: function () {
                        $("#mensaje").val("");
                        $("#chat").animate({ scrollTop: $('#chat')[0].scrollHeight}, 1000);
                        $('#chat').animate({ scrollTop: $(window)[0].scrollHeight}, 1000);
                }
        });
}