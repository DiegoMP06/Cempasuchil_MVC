<?php 
namespace Controller;

use Model\Nosotros;

class APISeccionController {
    public static function seccion() {
        $id = $_GET["id"];
        if(!$id) header("Location: /404");
        $seccion = Nosotros::find($id);
        if(!$seccion) header("Location: /404");

        echo json_encode([
            "tipo" => "exito",
            "mensaje" => "Seccion Consultada Correctamente",
            "seccion" => $seccion
        ]);
    }

    public static function actualizar() {
        session_start();
        isAuth();
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            if(!$id) header("Location: /404");
            $seccion = Nosotros::find($id);
            if(!$seccion) header("Location: /404");

            $seccion->sincronizar($_POST);
            $resultado = $seccion->guardar();

            if($resultado) {
                echo json_encode([
                    "tipo" => "exito",
                    "mensaje" => "Se Ha Actualizado Correctamente",
                    "seccion" => $seccion
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
            $seccion = Nosotros::find($id);
            if(!$seccion) header("Location: /404");

            $resultado = $seccion->eliminar();

            if($resultado) {
                $seccion->eliminarImagen();
                
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
        $publicas = Nosotros::belongsTo("publico", "1");
        echo json_encode($publicas);
    }
}