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
    <link rel="stylesheet" href="./style/conectado.css">
    <title>Usuário conectado</title>
</head>
<body>
    <header>
        <nav>
            <div>
                
                
                <h3>Notas PHP</h3>
            </div>
            
                  <a href="index.php">Sair</a>
        </nav>


        <div class="usuarioInfo">
            <?php
            echo "<h2>Bem-vindo " .$_SESSION["nome"] . "</h2>";
            ?>

            <h3>Você está conectado!</h3>
        </div>

    </header>

    
    <main>
    
        <form method="get" class="notaPrincipal nota">
    
            <?php
                echo "<h4 class='titulo'>" . $_SESSION["nome"] . "</h4>
    
                <textarea class='recado' name='notaSalva' cols='15' rows='4'>" . $_SESSION["notas"] . "</textarea>
                <input type='submit' value='Atualizar recado'>
                ";
            ?>
    
        </form>
    
        <div class="notasContainer">
    
            <div class="notaCriada nota">
                <header>
                    <h4 class='titulo'>Diego Alcantara</h4>
                    <p class='recado'>Estou aprendendo PHP e criei todo um sistema de exibir notinha só pro login que estou aprendendo ter algum propósito...</p>
                </header>
    
                <p class='email'>diego@email.com</p>
            </div>
    
    
        </div>
    </main>
    
</body>
</html>