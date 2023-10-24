<?php 
namespace Controller;

use Model\Imagen;

class APIImagenController {
    public static function imagen() {
        $id = $_GET["id"];
        if(!$id) header("Location: /404");
        $imagen = Imagen::find($id);
        if(!$imagen) header("Location: /404");

        echo json_encode([
            "tipo" => "exito",
            "mensaje" => "Imagen Consultada Correctamente",
            "imagen" => $imagen
        ]);
    }

    public static function actualizar() {
        session_start();
        isAuth();
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            if(!$id) header("Location: /404");
            $imagen = Imagen::find($id);
            if(!$imagen) header("Location: /404");

            $imagen->sincronizar($_POST);
            $resultado = $imagen->guardar();

            if($resultado) {
                echo json_encode([
                    "tipo" => "exito",
                    "mensaje" => "Se Ha Actualizado Correctamente",
                    "imagen" => $imagen
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
            $imagen = Imagen::find($id);
            if(!$imagen) header("Location: /404");

            $resultado = $imagen->eliminar();

            if($resultado) {
                $imagen->eliminarImagen();
                
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

    public static function publicas() {
        $publicas = Imagen::belongsTo("publico", "1");
        echo json_encode($publicas);
    }
}