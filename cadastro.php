<?php
include("db.php");
require("validacao.php");
// diego@email.com
// senha testandoPHP


session_start();





if (isset($_POST["nome"], $_POST["email"], $_POST["senha"], $_POST["senha2x"])) {
    $permitirCriacao = true;

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    // $senhaCriptografada = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $notas = "vazio";

    if(strlen($nome) < 5) {
        $permitirCriacao=false;
        $_SESSION["erro"]="O nome deve conter pelo menos 5 letras";
    } else{

        $senhaValidada = validarSenhas($_POST["senha"], $_POST["senha2x"]);

        if (!$senhaValidada[0]) {
            $permitirCriacao = false;
            $_SESSION["erro"]= $senhaValidada[1];
        }
    }

    


   


    if($permitirCriacao){
        $_SESSION["erro"]="";

        
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, notas) VALUES (?, ?, ?, ?)");

        $stmt->bind_param("ssss", $nome, $email, $senhaCriptografada, $notas);

        $stmt->execute();
        $stmt->close();
    

        header("Location: index.php");
        exit();   
    }

} else {
    $_SESSION["erro"]="É necessário preencher todos os campos";
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
        <img src="./assets/cadastroImagem.svg" alt="">

        <input type="text" name="nome" placeholder="nome">

        <input type="email" name="email" id="email" placeholder="email">

        <input type="password" name="senha" placeholder="senha">
        <input type="password" name="senha2x" placeholder="confirme a senha">
        

        <input type="submit" value="criar usuário">
        <?php
            echo "<span>" . $_SESSION['erro']. "</span>";
        ?>
        <a href="index.php">Fazer login</a>

    </form>
    </div>



   

    


    
</body>
</html>