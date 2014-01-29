<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <style>
            .box1{
                alignment-adjust:  auto;
                width: 30%;
                
            }
        </style>
    </head>
    <body>
        
        <div class="box1">
        <p>inserire prodotto</p>
        <input type="text" id="myText1" name="tuoTesto">
        <p>inserire prezzo</p>
        <input type="text" id="myText2" name="tuoTesto2">
        <p>inserire quantità</p>
        <input type="text" id="myText3" name="tuoTesto3">
        </div>
        <button id="canc">invia
        </button>
        <div id="nuovafrs" class="box1">
        </div>
        <script>
            $("button#canc").click(function() {
                $.ajax({
                    type: "POST",
                    url: "data.php",
                    cache: false,
                    dataType: "json",
                    data: {
                        name: $("#myText1").val(),
                        price: $("#myText2").val(),
                        quant: $("#myText3").val(),
                        
                    },
                    beforeSend: function() {
                        console.log("waiting...");
                        
                    },
                    success: function(data) {
                        console.log(data);
                        //$("#nuovafrs").append(data.param0 + " " + data.param1 + " " + data.param2)
                        $.each(data, function(index, value) {
                            $("#nuovafrs").append(index + ": " + value + "<br/>");
                        });

                    }, error: function(jqXHR, textStatus, errorThrown) {
                        console.log("error");

                    },
                    complete: function() {

                    }
                });
            });
        </script>

    </body>
</html>
