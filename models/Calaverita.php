<?php 
namespace Model;

class Calaverita extends ActiveRecord {
    protected static $tabla = "calaveritas";
    protected static $columnasDB = [
        "id",
        "nombre",
        "calaverita",
        "autor",
        "creado",
        "publico",
        "usuarioId"
    ];

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->calaverita = $args["calaverita"] ?? "";
        $this->autor = $args["autor"] ?? "";
        $this->creado = $args["creado"] ?? date("Y-m-d");
        $this->publico = $args["publico"] ?? 0;
        $this->usuarioId = $args["usuarioId"] ?? "";
    }

    public function validar() {
        if(!$this->nombre) {
            self::setAlerta("nombre", "El Nombre es Obligatorio");
        }

        if(!$this->calaverita) {
            self::setAlerta("calaverita", "La calaverita es Obligatoria");
        }

        if(!$this->autor) {
            self::setAlerta("autor", "El Autor es Obligatorio");
        }

        return self::$alertas;
    }
}