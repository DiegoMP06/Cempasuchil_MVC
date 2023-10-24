<?php 
namespace Controller;

use Model\Producto;

class APIProductoController {
    public static function producto() {
        $id = $_GET["id"];
        if(!$id) header("Location: /404");
        $producto = Producto::find($id);
        if(!$producto) header("Location: /404");

        echo json_encode([
            "tipo" => "exito",
            "mensaje" => "Producto Consultado Con Exito",
            "producto" => $producto
        ]);
    }

    public static function actualizar() {
        session_start();
        isAuth();
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            if(!$id) header("Location: /404");
            $producto = Producto::find($id);
            if(!$producto) header("Location: /404");

            $producto->sincronizar($_POST);
            $resultado = $producto->guardar();

            if($resultado) {
                echo json_encode([
                    "tipo" => "exito",
                    "mensaje" => "Se Ha Actualizado Correctamente",
                    "producto" => $producto
                ]);
                return;
            }

            echo json_encode([
                "tipo" => "error",
                "mensaje" => "Ha Ocurrido Un Error"
            ]);
        }
    }

    public static function eliminar() {
        session_start();
        isAuth();
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            if(!$id) header("Location: /404");
            $producto = Producto::find($id);
            if(!$producto) header("Location: /404");

            $resultado = $producto->eliminar();

            if($resultado) {
                $producto->eliminarImagen();
                
                echo json_encode([
                    "tipo" => "exito",
                    "mensaje" => "Se Ha Eliminado Correctamente",
                ]);
                return;
            }

            echo json_encode([
                "tipo" => "error",
                "mensaje" => "Ha Ocurrido Un Error"
            ]);
        }
    }

    public static function disponibles() {
        $disponibles = Producto::belongsTo("disponible", "1");
        echo json_encode($disponibles);
    }
}