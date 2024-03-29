<?php
session_start();

    // echo $_SESSION["nome"]

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário conectado</title>
</head>
<body>
    <?php
        echo "<h1>BEM-VINDO " .$_SESSION["nome"] . "</h1>";
    ?>
  <h3>Você está conectado!</h3>
    <a href="index.php">Sair</a>
    
</body>
</html>