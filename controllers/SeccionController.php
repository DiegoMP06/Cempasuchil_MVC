<?php 
namespace Controller;

use MVC\Router;
use Model\Usuario;
use Model\Nosotros;

class SeccionController {
    public static function nosotros(Router $router) {
        session_start();
        isAuth();

        $nosotros = Nosotros::all();

        $router->render("nosotros/nosotros", [
            "titulo" => "Administrar Secciones Sobre Nosotros",
            "nosotros" => $nosotros
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAuth();

        $alertas = [];
        $seccion = new Nosotros;

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $seccion->sincronizar($_POST);
            $alertas = $seccion->validarCrear();

            if(empty($alertas)) {
                $seccion->setImagen();
                $seccion->usuarioId = $_SESSION["id"];
                $seccion->guardarImagen();
                $resultado = $seccion->guardar();

                if($resultado) {
                    header("Location: /seccion?id=" . $resultado["id"]);
                }
            }
        }

        $alertas = Nosotros::getAlertas();

        $router->render("nosotros/crear", [
            "titulo" => "Crear Seccion Sobre Nosotros",
            "alertas" => $alertas,
            "seccion" => $seccion
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAuth();

        $id = $_GET["id"];
        if(!$id) header("Location: /nosotros");
        $seccion = Nosotros::find($id);
        if(!$seccion) header("Location: /nosotros");

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $seccion->sincronizar($_POST);
            $alertas = $seccion->validarActualizar();

            if(empty($alertas)) {
                $seccion->actualizarImagen();
                $resultado = $seccion->guardar();

                if($resultado) {
                    header("Location: /seccion?id=" . $seccion->id);
                }
            }
        }

        $alertas = Nosotros::getAlertas();

        $router->render("nosotros/actualizar", [
            "titulo" => "Actualizar Seccion Sobre Nosotros",
            "alertas" => $alertas,
            "seccion" => $seccion
        ]);
    }

    public static function seccion(Router $router) {
        session_start();
        isAuth();

        $id = $_GET["id"];
        if(!$id) header("Location: /nosotros");
        $seccion = Nosotros::find($id);
        if(!$seccion) header("Location: /nosotros");
        $usuario = Usuario::find($seccion->usuarioId);

        $router->render("nosotros/seccion", [
            "titulo" => sanitizar($seccion->nombre),
            "seccion" => $seccion,
            "usuario" => $usuario
        ]);
    }
}