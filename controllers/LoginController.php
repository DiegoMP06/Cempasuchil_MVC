<?php 
namespace Controller;

use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if(empty($alertas)) {
                $auth = Usuario::where("email", $usuario->email);

                if(!is_null($auth)) {
                    if(password_verify($usuario->password, $auth->password)) {
                        session_start();

                        $_SESSION["login"] = true;
                        $_SESSION["id"] = $auth->id;
                        $_SESSION["nombre"] = $auth->nombre;
                        $_SESSION["email"] = $auth->email;

                        header("Location: /panel");
                    } else {
                        Usuario::setAlerta("password", "Password Incorrecto");
                    }
                } else {
                    Usuario::setAlerta("usuario", "Usuario No Registrado");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/login", [
            "titulo" => "Login",
            "alertas" => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];

        header("Location: /");
    }

    public static function crear() {
        // $auth = [
        //     "nombre" => "Diego",
        //     "email" => "correo@correo.com",
        //     "password" => "password",
        //     "admin" => 0
        // ];

        // $usuario = new Usuario($auth);
        // $usuario->passwordHash();
        // $usuario->guardar();
    }
}