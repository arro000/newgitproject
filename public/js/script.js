/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {

    $(".numb").click(function() {
        if ($("#result").text() === $("#insert0").text())
            $("#insert0").empty();
        var numb = $(this).val();
        $("#insert0").append(numb);
    });
    $(".cmd").click(function() {

        $("#insert0").empty();
        if ($(this).attr("id") === 'cancAl')
        {
            $("#insert1").empty();
            $("#operando").empty();
        }
    });
    $(".oper").click(function() {
        $("#operando").empty();
        var op = $(this).attr("id");
        $("#operando").append(op);
        if ($("#insert0").text())
        {
            $("#insert1").append($("#insert0").text());
            $("#insert0").empty();
        }
    });


    $("#submit").click(function() {
        var oper = $("#operando").text();
        console.log($("#insert1").text());
        console.log($("#insert0").text());
        $.ajax({
            type: "POST",
            url: "/index/calc",
            cache: false,
            data: {
                param0: $("#insert1").text(),
                param1: $("#insert0").text(),
                oper: oper
            },
            beforeSend: function() {
                console.log("waiting...");
                $("#result").empty();

            },
            success: function(data) {
                console.log(data);
                //$("#nuovafrs").append(data.param0 + " " + data.param1 + " " + data.param2)
                $("#insert0").empty();
                $("#insert1").empty();
                $("#operando").empty();
                $("#result").append(data);
                $("#insert0").append(data);


            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");

            },
            complete: function() {

            }
        });


    });

    $(".aloneOper").click(function() {
        var oper = $(this).attr("id");

        switch (oper) {
            case 'sqrt':
                $.ajax({
                    type: "POST",
                    url: "/index/sqrt",
                    cache: false,
                    data: {
                        param: $("#insert0").text()
                    },
                    beforeSend: function() {
                        console.log("waiting...");
                        $("#result").empty();
                    },
                    success: function(data) {
                        console.log(data);
                        //$("#nuovafrs").append(data.param0 + " " + data.param1 + " " + data.param2)
                        $("#insert0").empty();
                        $("#insert1").empty();
                        $("#operando").empty();
                        $("#result").append(data);
                        $("#insert0").append(data);


                    }, error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");
                    },
                    complete: function() {

                    }
                });
                break;
            case 'inv':
                $.ajax({
                    type: "POST",
                    url: "/index/inv",
                    cache: false,
                    data: {
                        param: $("#insert0").text()
                    },
                    beforeSend: function() {
                        console.log("waiting...");
                    },
                    success: function(data) {
                        console.log(data);
                        $("#insert0").empty();
                        $("#insert1").empty();
                        $("#operando").empty();
                        $("#insert1").append(data);
                    }, error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");

                    },
                    complete: function() {

                    }
                });
                break;

            case 'perc':
                $.ajax({
                    type: "POST",
                    url: "/index/perc",
                    cache: false,
                    data: {
                        param0: $("#insert0").text(),
                        param1: $("#insert1").text(),
                    },
                    beforeSend: function() {
                        console.log("waiting...");
                        $("#insert0").empty();
                    },
                    success: function(data) {
                        console.log(data);
                        $("#insert0").append(data);
                    }, error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");

                    },
                    complete: function() {

                    }
                });
                break;

            case 'reciproc':
                $.ajax({
                    type: "POST",
                    url: "/index/reciproc",
                    cache: false,
                    data: {
                        param: $("#insert0").text()
                    },
                    beforeSend: function() {
                        console.log("waiting...");
                        $("#insert0").empty();
                    },
                    success: function(data) {
                        console.log(data);
                        $("#insert0").append(data);
                    }, error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");

                    },
                    complete: function() {

                    }
                });
                break;
        }

    });



});
