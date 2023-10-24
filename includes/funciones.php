<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function isAuth() {
    if(!$_SESSION["login"]) {
        header("Location: /");
    }
}

function sanitizar($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function alertas($alertas, $atributo, $tipo = "error") {
    if(isset($alertas[$tipo][$atributo])) {
        echo "<p class='alerta {$tipo}'>{$alertas[$tipo][$atributo]}</p>";
    }
}