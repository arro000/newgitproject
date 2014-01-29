/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $("#login").click(function() {

        $.ajax({
            type: "POST",
            url: "/auth/login",
            dataType: "json",
            cache: false,
            data: {
                username: $("#username").val(),
                password: $("#password").val()
            },
            beforeSend: function() {
                console.log("waiting...");
                $("#response").empty();


            },
            success: function(data) {
                console.log(data);

                if (data.access === "grant")
                    window.location.href = data.path;
                else
                    $("#response").append("ACCESSO NON AUTORIZZATO");
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");

            },
            complete: function() {

            }

        });
    });
    $("#logout").click(function() {

        $.ajax({
            type: "POST",
            url: "/auth/logout",
            cache: false,
            beforeSend: function() {
                console.log("waiting...");

            },
            success: function(data) {
                console.log(data);
                window.location.href = "/index";
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log("error");
            },
            complete: function() {
            }
        });
    });

});