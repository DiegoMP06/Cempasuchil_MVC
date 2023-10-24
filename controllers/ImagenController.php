<?php 
namespace Controller;

use MVC\Router;
use Model\Imagen;
use Model\Usuario;

class ImagenController {
    public static function imagenes(Router $router) {
        session_start();
        isAuth();

        $galeria = Imagen::all();

        $router->render("imagen/imagenes", [
            "titulo" => "Administrar Galeria",
            "galeria" => $galeria
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAuth();
        $alertas = [];
        $imagen = new Imagen;

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $imagen->sincronizar($_POST);
            $alertas = $imagen->validarCrear();

            if(empty($alertas)) {
                $imagen->setImagen();
                $imagen->usuarioId = $_SESSION["id"];
                $imagen->guardarImagen();
                $resultado = $imagen->guardar();

                if($resultado) {
                    header("Location: /imagen?id=" . $resultado["id"]);
                }
            }
        }

        $alertas = Imagen::getAlertas();

        $router->render("imagen/crear", [
            "titulo" => "Crear Imagen",
            "alertas" => $alertas,
            "imagen" => $imagen
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAuth();

        $id = $_GET["id"];
        if(!$id) header("Location: /galeria");
        $imagen = Imagen::find($id);
        if(!$imagen) header("Location: /galeria");
        
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $imagen->sincronizar($_POST);
            $alertas = $imagen->validarActualizar();

            if(empty($alertas)) {
                $imagen->actualizarImagen();
                $resultado = $imagen->guardar();

                if($resultado) {
                    header("Location: /imagen?id=" . $imagen->id);
                }
            }
        }

        $alertas = Imagen::getAlertas();

        $router->render("imagen/actualizar", [
            "titulo" => "Actualizar Imagen",
            "alertas" => $alertas,
            "imagen" => $imagen
        ]);
    }

    public static function imagen(Router $router) {
        session_start();
        isAuth();
        $id = $_GET["id"];
        if(!$id) header("Location: /galeria");
        $imagen = Imagen::find($id);
        if(!$imagen) header("Location: /galeria");
        $usuario = Usuario::find($imagen->usuarioId);

        $router->render("imagen/imagen", [
            "titulo" => "Imagen de Galeria",
            "imagen" => $imagen,
            "usuario" => $usuario
        ]);
    }
}