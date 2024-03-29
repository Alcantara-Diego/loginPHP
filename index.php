<?php
include("db.php");

session_start();

if(!isset($_SESSION["erro"])){$_SESSION["erro"]="";}
// diego@email.com
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
    <form method="post">
            <h1>Login PHP</h1>


        <input type="email" name="email" id="email" placeholder="email">
        <input type="password" name="senha" placeholder="senha">

        <input type="submit" value="Login"> 
        <?php
        echo "<span>" . $_SESSION['erro']. "</span>";
        ?>   
        <a href="cadastro.php">Criar conta</a>

    </form>

  

    <div>
        <h2>Usuários cadastrados:</h2>

        <?php
            if($resultadoBusca->num_rows > 0) {
                while($row = $resultadoBusca->fetch_assoc()){
                    echo "<p>" . $row["id"] . " - " . $row["nome"] . " - " . $row["email"] . "</p>";
            
                } 
            }
        
        ?>

    
       

        </div>
    
</body>
</html>