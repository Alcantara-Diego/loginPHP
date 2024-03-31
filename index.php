<?php
include("db.php");

session_start();

if(!isset($_SESSION["erro"])){$_SESSION["erro"]="";}
// senha testandoPHP
//senha pedro123

$sql = "SELECT * FROM usuarios"; 
$resultadoBusca = $conn->query($sql);






if (isset($_POST["email"], $_POST["senha"])) {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $resultado = $stmt->get_result();



    if($resultado->num_rows > 0) {

        $row = $resultado->fetch_assoc();

        if(password_verify($senha, $row["senha"])) {

            $_SESSION["nome"] = $row["nome"];
            $_SESSION["notas"] = $row["notas"];
            $_SESSION["id"] = $row["id"];

            $_SESSION["erro"]="";

            header("location: conectado.php");
            exit();


        }else{$_SESSION["erro"]="email ou senha está incorreto";}
       
    } else{$_SESSION["erro"]="sem resposta do banco de dados";}

    

   
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Login PHP</title>
</head>
<body>
    <div class="loginConteudo">

        <form method="post">
            <h1>Login PHP</h1>
            <p class="descricao">Se conecte para criar uma nota e visualizar notas de outros usuários</p >
            <img src="./assets/loginImagem.svg" alt="">

            <div class="inputDiv">
                <input type="email" name="email" id="email" placeholder="email">
                <input type="password" name="senha" placeholder="senha">
                <input type="submit" value="Login">
                <?php
                echo "<span>" . $_SESSION['erro']. "</span>";
                ?>
                <a href="cadastro.php">Não tem uma conta?Clique aqui</a>
            </div>

        </form>



    

        <!-- <div class="notasContainer">
        
            <?php
                if($resultadoBusca->num_rows > 0) {
                    while($row = $resultadoBusca->fetch_assoc()){
                        echo "
                        <div class='nota'>
                            <div>
                            <h2 class='titulo'>" . 
                            $row["nome"] . "</h2>

                            <p class='recado'>" . 
                            $row["notas"] . "ddds</p>
                            </div>

                            <p class='email'>" . 
                            $row["email"] . "</p>


                        </div>";
                
                    } 
                }
            
            ?>

        
        

            </div> -->
        </div>
    
</body>
</html>