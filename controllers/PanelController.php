<?php 
namespace Controller;

use MVC\Router;

class PanelController {
    public static function panel(Router $router) { 
        session_start();
        isAuth();

        $router->render("panel/panel", [
            "titulo" => "Panel de Administracion",
        ]);
    }
}