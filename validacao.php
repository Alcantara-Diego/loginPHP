<?php


function validarSenhas($valor1,$valor2) {

    if (strlen($valor1) < 8){
        return array(false, "A senha deve conter pelo menos 8 dígitos");

    }else if(!preg_match("/[0-9]/",$valor1)){
        return array(false,"A senha deve conter pelo menos um número");

    }else if(!preg_match("/[a-z]/",$valor1)){
        return array(false,"A senha deve conter pelo menos uma letra");
        
    }else if ($valor1 !== $valor2) {
        return array(false, "Ambas as senhas digitadas devem ser idênticas");

    } else{
        return array(true,"passou");
    }
};