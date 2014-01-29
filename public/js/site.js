/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $("#get").click(function() {
        $.ajax({
            type: "POST",
            url: "/home/getcred",
            dataType: "json",
            cache: false,
            beforeSend: function() {
                console.log("waiting...");

                $("#name").empty();
                $("#role").empty();


            },
            success: function(data) {
                console.log(data);
                $("#name").append(data.username);
                $("#role").append(data.ruolo);

            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");


            },
            complete: function() {


            }
        });
    });
    $("#getprd").click(function() {
        $.ajax({
            type: "POST",
            url: "/home/getprod",
            dataType: "json",
            cache: false,
            beforeSend: function() {
                console.log("waiting...");

                $("#prod").empty();
            },
            success: function(data) {
                console.log(data);
                $("#prod").append("<tr><td> prodotto </td><td >--id--</td><td >costo</td> </tr>");
                $.each(data, function(key, value) {
                    $("#prod").append("<tr>");
                    $.each(value, function(key, value) {
                        //  alert(key + ":" + value)
                        $("#prod").append("<td> " + value + "</td>");
                    });
                    $("#prod").append("</tr>");
                });

            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");
            },
            complete: function() {

            }
        });
    });
    $("#insert").click(function() {

        $.ajax({
            type: "POST",
            url: "/home/setprod",
            cache: false,
            data: {
                prodotto: $("#nome").val(),
                costo: $("#costo").val(),
            },
            beforeSend: function() {
                console.log("waiting...");
                $("#prod").empty();

            },
            success: function() {

            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");


            },
            complete: function() {


                $.ajax({
                    type: "POST",
                    url: "/home/getprod",
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        $("#prod").append("<tr><td> prodotto </td><td >--id--</td><td >costo</td> </tr>");
                        $.each(data, function(key, value) {
                            $("#prod").append("<tr>");
                            $.each(value, function(key, value) {
                                //  alert(key + ":" + value)
                                $("#prod").append("<td> " + value + "</td>");
                            });
                            $("#prod").append("</tr>");
                        });

                    }, error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");
                    }
                });
            }
        });
    });
    $("#search").keyup(function() {
        $.ajax({
            type: "POST",
            url: "/home/search",
            cache: false,
            dataType: "json",
            data: {
                param: $("#search").val(),
            },
            beforeSend: function() {
                console.log("waiting...");
                $("#prod").empty();


            },
            success: function(data) {
                if (data.length > 0) {
                    $("#prod").append("<tr><td> prodotto </td><td >--id--</td><td >costo</td> </tr>");
                    $.each(data, function(key, value) {
                        $("#prod").append("<tr>");
                        $.each(value, function(key, value) {
                            //  alert(key + ":" + value)
                            $("#prod").append("<td> " + value + "</td>");
                        });
                        $("#prod").append("</tr>");
                    });

                }

            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");


            },
            complete: function() {

            }
        });
    });
    $("#del").click(function() {

        $.ajax({
            type: "POST",
            url: "/home/delete",
            cache: false,
            data: {
                id: $("#delete").val(),
            },
            beforeSend: function() {
                console.log("waiting...");
                $("#prod").empty();

            },
            success: function() {

            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");


            },
            complete: function() {


                $.ajax({
                    type: "POST",
                    url: "/home/getprod",
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        $("#prod").append("<tr><td> prodotto </td><td >--id--</td><td >costo</td> </tr>");
                        $.each(data, function(key, value) {
                            $("#prod").append("<tr>");
                            $.each(value, function(key, value) {
                                //  alert(key + ":" + value)
                                $("#prod").append("<td> " + value + "</td>");
                            });
                            $("#prod").append("</tr>");
                        });

                    }, error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");
                    }
                });
            }
        });
    });

});

