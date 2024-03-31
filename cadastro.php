<?php
include("db.php");
// diego@email.com
// senha testandoPHP


session_start();





if (isset($_POST["nome"], $_POST["email"], $_POST["senha"])) {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senhaCriptografada = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $notas = "vazio";

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, notas) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $nome, $email, $senhaCriptografada, $notas);

    $stmt->execute();
    $stmt->close();
 

    header("Location: index.php");
    exit();   
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">

    <title>Criar usuário</title>
</head>
<body>

    <div class="loginConteudo">
         <form method="post">
        <h1>Criar usuário</h1>

        <p class="descricao">Crie uma conta para fazer sua nota e visualizar notas de outros usuários</p >
        <img src="./assets/svg1.svg" alt="">

        <input type="text" name="nome" placeholder="nome">

        <input type="email" name="email" id="email" placeholder="email">
        <input type="password" name="senha" placeholder="senha">

        <input type="submit" value="criar usuário">
        <a href="index.php">Fazer login</a>

    </form>
    </div>



   

    


    
</body>
</html>