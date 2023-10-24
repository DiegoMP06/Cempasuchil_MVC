<?php 
namespace Controller;

use MVC\Router;
use Model\Usuario;
use Model\Producto;

class ProductoController {
    public static function productos(Router $router) {
        session_start();
        isAuth();

        $productos = Producto::all();

        $router->render("producto/productos", [
            "titulo" => "Administrar Productos",
            "productos" => $productos
        ]);
    }

    public static function crear(Router $router) {
        session_start();
        isAuth();

        $producto = new Producto;
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $producto->sincronizar($_POST);
            $alertas = $producto->validarCrear();

            if(empty($alertas)) {
                $producto->setImagen();
                $producto->usuarioId = $_SESSION["id"];
                $producto->guardarImagen();
                $resultado = $producto->guardar();

                if($resultado) {
                    header("Location: /producto?id=" . $resultado["id"]);
                }
            }
        }

        $alertas = Producto::getAlertas();

        $router->render("producto/crear", [
            "titulo" => "Crear Producto",
            "alertas" => $alertas,
            "producto" => $producto
        ]);
    }

    public static function actualizar(Router $router) {
        session_start();
        isAuth();
        $id = $_GET["id"];
        if(!$id) header("Location: /productos");
        $producto = Producto::find($id);
        if(!$producto) header("Location: /productos");

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $producto->sincronizar($_POST);
            $alertas = $producto->validarActualizar();

            if(empty($alertas)) {
                $producto->actualizarImagen();
                $resultado = $producto->guardar();

                if($resultado) {
                    header("Location: /productos?id=" . $producto->id);
                }
            }
        }

        $alertas = Producto::getAlertas();

        $router->render("producto/actualizar", [
            "titulo" => "Actualizar Producto",
            "alertas" => $alertas,
            "producto" => $producto
        ]);
    }

    public static function producto(Router $router) {
        session_start();
        isAuth();
        $id = $_GET["id"];
        if(!$id) header("Location: /productos");
        
        $producto = Producto::find($id);
        if(!$producto) header("Location: /productos");
        $usuario = Usuario::find($producto->usuarioId);

        $router->render("producto/producto", [
            "titulo" => sanitizar($producto->nombre),
            "producto" => $producto,
            "usuario" => $usuario
        ]);
    }
}