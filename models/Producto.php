<?php 
namespace Model;

class Producto extends ActiveRecord {
    protected static $tabla = "productos";
    protected static $columnasDB = [
        "id",
        "nombre",
        "precio",
        "disponible",
        "imagen",
        "usuarioId"
    ];

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre =  $args["nombre"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->disponible = $args["disponible"] ?? 0;
        $this->imagen = $args["imagen"] ?? "";
        $this->usuarioId = $args["usuarioId"] ?? "";
    }

    public function validarCrear() {
        if(!$this->nombre) {
            self::setAlerta("nombre", "El Nombre es Obligatorio");
        }

        if($this->precio < 0) {
            self::setAlerta("precio", "Precio Invalido");
        }

        if(!$this->precio && $this->precio !== "0") {
            self::setAlerta("precio", "El Precio es Obligatorio");
        }

        $this->validarImagen();
        
        return self::$alertas;
    }

    public function validarActualizar() {
        if(!$this->nombre) {
            self::setAlerta("nombre", "El Nombre es Obligatorio");
        }

        if($this->precio < 0) {
            self::setAlerta("precio", "Precio Invalido");
        }

        if(!$this->precio && $this->precio !== "0") {
            self::setAlerta("precio", "El Precio es Obligatorio");
        }

        $this->validarTipoImagen();
        
        return self::$alertas;
    }
}