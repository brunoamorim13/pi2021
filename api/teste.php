<!DOCTYPE html>
<?php
    $var = "Ola meu nome eh";
    $var2 = explode(" ", $var);

?>
<head>
        <title>Por favor funcione</title>
</head>

<body>

    <h1> I am a <span class = "type"></span>


    <script src = "typed.js"></script>

    <script>
        var typed = new Typed('.type', {
            strings: $var2,
            typeSpeed: 60,
            backSpeed: 60,
            loop: TRUE // Default value
        });
    </script>
</body>