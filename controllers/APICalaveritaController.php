<?php 
namespace Controller;

use Model\Calaverita;

class APICalaveritaController {
    public static function calaveritas() {
        $calaveritas = Calaverita::all();

        if($calaveritas) {
            echo json_encode([
                "tipo" => "exito",
                "mensaje" => "Se Consultaron Las Calaveritas",
                "calaveritas" => $calaveritas
            ]);
            return;
        }

        echo json_encode([
            "tipo" => "error",
            "mensaje" => "Hubo un Error al Consultar las Calaveritas",
        ]);
    }

    public static function actualizar() {
        session_start();
        isAuth();
        
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            if(!$id) header("Location: /404");
            $calaverita = Calaverita::find($id);
            if(!$calaverita) header("Location: /404");

            $calaverita->sincronizar($_POST);
            $resultado = $calaverita->guardar();

            if($resultado) {
                echo json_encode([
                    "tipo" => "exito",
                    "mensaje" => "Se Ha Actualizado Correctamente",
                    "calaverita" => $calaverita
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
            $calaverita = Calaverita::find($id);
            if(!$calaverita) header("Location: /404");

            $resultado = $calaverita->eliminar();

            if($resultado) {
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

    public static function publica() {
        $publica = Calaverita::where("publico", "1");
        echo json_encode($publica);
    }
}