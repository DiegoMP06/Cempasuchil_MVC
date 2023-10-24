<?php
namespace Model;
use Intervention\Image\ImageManagerStatic as Imagen;

class ActiveRecord {
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];
    protected static $alertas = [];
    public $id;
        
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($atributo, $mensaje, $tipo = "error") {
        static::$alertas[$tipo][$atributo] = $mensaje;
    }

    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    public function guardar() {
        if(!is_null($this->id)) {
            return $this->actualizar();
        } else {
            return $this->crear();
        }
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    public static function belongsTo($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE {$columna} = '{$valor}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function SQL($consulta) {
        $query = $consulta;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function crear() {
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('"; 
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);

        return [
           'resultado' => $resultado,
           'id' => self::$db->insert_id
        ];
    }

    public function actualizar() {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public static function consultarSQL($query) {
        $resultado = self::$db->query($query);
        $array = [];

        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        $resultado->free();
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }


    public function atributos() {
        $atributos = [];

        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    public function validarTipoImagen() {
        $tipos = ["image/jpeg", "image/png"];
        $imagen = $_FILES["imagen"];

        if($_FILES["imagen"]["name"] && !in_array($imagen["type"], $tipos)) {
            static::setAlerta("imagen", "Formato Invalido");
        }

        return static::$alertas;
    }

    public function validarImagen() {
        $tipos = ["image/jpeg", "image/png"];
        $imagen = $_FILES["imagen"];

        if(!in_array($imagen["type"], $tipos)) {
            static::setAlerta("imagen", "Formato Invalido");
        }

        if(!$imagen["name"]) {
            static::setAlerta("imagen", "La imagen es Obligatoria");
        }

        return static::$alertas;
    }

    public function setImagen() {
        $this->imagen = md5(uniqid(rand())) . ".png";
    }
    
    public function guardarImagen() {
        $imagenFile = $_FILES["imagen"];

        if(!is_dir(CARPETA_IMAGENES . static::$tabla . "/")) {
            mkdir(CARPETA_IMAGENES . static::$tabla . "/", 0777, true);
        }

        if(!is_dir(CARPETA_IMAGENES . static::$tabla . "/mini/")) {
            mkdir(CARPETA_IMAGENES . static::$tabla . "/mini/", 0777, true);
        }

        $imagen = Imagen::make($imagenFile["tmp_name"])->fit(1000, 1000);
        $imagenMini = Imagen::make($imagenFile["tmp_name"])->fit(400, 400);

        $imagen->save(CARPETA_IMAGENES . static::$tabla . "/" . $this->imagen);
        $imagenMini->save(CARPETA_IMAGENES  . static::$tabla . "/mini/" . $this->imagen);
    }

    public function actualizarImagen() {
        if($_FILES["imagen"]["name"]) {
            $imagenPrevia = $this->imagen;
            $this->setImagen();
            $this->guardarImagen();

            if(file_exists(CARPETA_IMAGENES . static::$tabla . "/" . $imagenPrevia)) {
                unlink(CARPETA_IMAGENES . static::$tabla . "/" . $imagenPrevia);
            }

            if(file_exists(CARPETA_IMAGENES . static::$tabla . "/mini/" . $imagenPrevia)) {
                unlink(CARPETA_IMAGENES . static::$tabla . "/mini/" . $imagenPrevia);
            }
        }
    }

    public function eliminarImagen() {
        if(file_exists(CARPETA_IMAGENES . static::$tabla . "/" . $this->imagen)) {
            unlink(CARPETA_IMAGENES . static::$tabla . "/" . $this->imagen);
        }

        if(file_exists(CARPETA_IMAGENES . static::$tabla . "/mini/" . $this->imagen)) {
            unlink(CARPETA_IMAGENES . static::$tabla . "/mini/" . $this->imagen);
        }
    }
}