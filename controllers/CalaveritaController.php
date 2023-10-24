<?php 
namespace Controller;

use MVC\Router;
use Model\Usuario;
use Model\Calaverita;

class CalaveritaController {
    public static function calaveritas(Router $router) {
        session_start();
        isAuth();
        
        $calaveritas = Calaverita::all();

        $router->render("calaverita/calaveritas", [
            "titulo" => "Administrar Calaveritas",
            "calaveritas" => $calaveritas
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAuth();

        $alertas = [];
        $calaverita = new Calaverita;

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $calaverita->sincronizar($_POST);
            $alertas = $calaverita->validar();

            if(empty($alertas)) {
                $calaverita->usuarioId = $_SESSION["id"];
                $resultado = $calaverita->guardar();

                if($resultado) {
                    header("Location: /calaverita?id=" . $resultado["id"]);
                }
            }
        }

        $router->render("calaverita/crear", [
            "titulo" => "Crear Calaverita",
            "alertas" => $alertas,
            "calaverita" => $calaverita
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAuth();
        $id = $_GET["id"];
        if(!$id) header("Location: /calaveritas");
        $calaverita = Calaverita::find($id);
        if(!$calaverita) header("Location: /calaveritas");

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $calaverita->sincronizar($_POST);
            $alertas = $calaverita->validar();

            if(empty($alertas)) {
                $resultado = $calaverita->guardar();

                if($resultado) {
                    header("Location: /calaverita?id=" . $calaverita->id);
                }
            }
        }

        $router->render("calaverita/actualizar", [
            "titulo" => "Actualizar Calaverita",
            "calaverita" => $calaverita,
            "alertas" => $alertas
        ]);
    }

    public static function calaverita(Router $router) {
        session_start();
        isAuth();
        $id = $_GET["id"];
        if(!$id) header("Location: /calaveritas");
        $calaverita = Calaverita::find($id);
        if(!$calaverita) header("Location: /calaveritas");
        $usuario = Usuario::find($calaverita->usuarioId);

        $router->render("calaverita/calaverita", [
            "titulo" => sanitizar($calaverita->nombre),
            "calaverita" => $calaverita,
            "usuario" => $usuario
        ]);
    }
}
