<?php 
namespace Model;

class Nosotros extends ActiveRecord {
    protected static $tabla = "nosotros";
    protected static $columnasDB = [
        "id",
        "nombre",
        "contenido",
        "imagen",
        "publico",
        "usuarioId"
    ];

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->contenido = $args["contenido"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->publico = $args["publico"] ?? 0;
        $this->usuarioId = $args["usuarioId"];
    }

    public function validarCrear() { 
        if(!$this->nombre) {
            self::setAlerta("nombre", "El nombre es Obligatorio");
        }

        if(!$this->contenido) {
            self::setAlerta("contenido", "El contenido es Obligatorio");
        }

        $this->validarImagen();

        return self::$alertas;
    }

    public function validarActualizar() { 
        if(!$this->nombre) {
            self::setAlerta("nombre", "El nombre es Obligatorio");
        }
        
        if(!$this->contenido) {
            self::setAlerta("contenido", "El contenido es Obligatorio");
        }

        $this->validarTipoImagen();

        return self::$alertas;
    }
}