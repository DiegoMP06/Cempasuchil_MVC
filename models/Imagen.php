<?php 
namespace Model;

class Imagen extends ActiveRecord {
    protected static $tabla = "imagenes";
    protected static $columnasDB = [
        "id",
        "imagen",
        "descripcion",
        "publico",
        "usuarioId"
    ];

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->publico = $args["publico"] ?? 0;
        $this->usuarioId = $args["usuarioId"] ?? "";
    }

    public function validarCrear() { 
        if(!$this->descripcion) {
            self::setAlerta("descripcion", "La Descripcion es Obligatoria");
        }

        $this->validarImagen();

        return self::$alertas;
    }

    public function validarActualizar() { 
        if(!$this->descripcion) {
            self::setAlerta("descripcion", "La Descripcion es Obligatoria");
        }

        $this->validarTipoImagen();

        return self::$alertas;
    }
}