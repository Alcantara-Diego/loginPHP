<?php
include("db.php");
session_start();

    if(isset($_GET["notaSalva"])){

        $notaSalva = $_GET["notaSalva"];
        $usuarioId = $_SESSION["id"];


        $sql = "UPDATE usuarios SET notas = ? WHERE id=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $notaSalva, $usuarioId);
        $stmt->execute();
        $_SESSION["notas"] = $notaSalva;

        header("location: conectado.php");
        exit();



    }



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
        echo "<h1>Bem-vindo " .$_SESSION["nome"] . "</h1>";
    ?>
  <h3>Você está conectado!</h3>

  <?php
    echo "<form method='get'> 
    <textarea name='notaSalva' cols='30' rows='4'>" . $_SESSION["notas"] . "</textarea>
    <br>
    <input type='submit' value='Atualizar recado'>
    <br>
    ";
  ?>
  
    <a href="index.php">Sair</a>
    
</body>
</html>