$(document).ready(function() {
    $(function() {
        $("#aggiungi").dialog({
            autoOpen: false,
            resizable: true,
            height: 300,
            width: 600,
            show: {
                effect: "explode",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });
        $("#new").click(function() {
            $("#aggiungi").dialog("open");
        });
    });
    $(function() {
        $("#visualizza").dialog({
            autoOpen: false,
            resizable: false,
            show: {
                effect: "explode",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            }
        });

    });

    $(function() {
        $(".selectable").selectable({
            stop: function() {
                var result = $("#select-result").empty();
                var tmp = $(".ui-selected #idfat", this).text();
                $("#carica").click(function()
                {
                    //console.log(tmp);
                    $.ajax({
                        type: "POST",
                        url: "/cart/getprod",
                        dataType: "json",
                        cache: false,
                        data: {
                            idfattura: tmp
                        },
                        beforeSend: function() {
                            console.log("waiting...");
                        },
                        success: function(data) {
                            $("#visualizza").dialog("open");


                        }, error: function(jqXHR, textStatus, errorThrown) {
                            console.log("error");
                        },
                        complete: function() {
                        }
                    });
                });

            }
        });
    });
    $("#save").click(function()
    {

        $.ajax({
            type: "POST",
            url: "/cart/set",
            dataType: "json",
            cache: false,
            data: {
                paramid: $("td#id").text(),
                paramtot: $("#totale").text()

            },
            beforeSend: function() {
                console.log("waiting...");
            },
            success: function(data) {
                $("#aggiungi").dialog("close");
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");
            },
            complete: function() {
            }
        });
    });


    $("#research").keyup(function() {
        $.ajax({
            type: "POST",
            url: "/home/search",
            cache: false,
            dataType: "json",
            data: {
                param: $("#research").val()
            },
            beforeSend: function() {
                console.log("waiting...");

            },
            success: function(data) {
                if (data.length > 0) {
                    console.log();
                    var cont = 0;
                    var avaibleTags = new Array();
                    $.each(data, function(key, value) {
                        avaibleTags[cont] = {
                            value: value.prodotto,
                            label: value.prodotto,
                            prezzo: value.costo,
                            id: value.id,
                            iva: value.iva
                        };
                        cont++;
                    });
                    $("#research").autocomplete({
                        source: avaibleTags,
                        select: function(event, ui) {
                            console.log(event);
                            $("#prod").append("<tr><td>" + ui.item.value + " </td><td id='prezzo'> " +
                                    ui.item.prezzo + " </td><td id='id'> " + ui.item.id + "</td></tr>");

                            var tot = $("#totale").text();
                            var num;
                            if (tot != "") {
                                tot = parseFloat(tot);
                                console.log(tot);
                                num = tot + parseFloat(ui.item.prezzo);
                                $("#totale").empty();
                                $("#totale").append(num);
                            }
                            else
                                $("#totale").append(parseFloat(ui.item.prezzo));
                        }

                    });
                }
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");
            },
            complete: function() {


            }
        });
    });
    $("#refresh").click(function()
    {

        $.ajax({
            type: "POST",
            url: "/cart/get",
            dataType: "json",
            cache: false,
            beforeSend: function() {
                console.log("waiting...");
            },
            success: function(data) {
                $("#content").empty();
                $.each(data, function(key, value) {
                    $("#content").append("<li class='ui-widget-content'>Id fattura:<span id='idfat'> " + value.id + "</span>  Id utente: " + value.id_utente + " Data emissione: " + value.data + " Totale: " + value.totale + "</li>");
                });

            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");
            },
            complete: function() {
            }
        });
    });



});

  