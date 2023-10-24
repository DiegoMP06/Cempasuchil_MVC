<?php 
namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = [
        "id",
        "nombre",
        "email",
        "password",
        "admin"
    ];

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->admin = $args["admin"] ?? 0;
    }

    public function passwordHash() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function validarLogin() {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::setAlerta("email", "El Formato no valido");
        }

        if(!$this->email) {
            self::setAlerta("email", "El email es Obligatorio");
        }

        if(!$this->password) {
            self::setAlerta("password", "El Password es Obligatorio");
        }

        return self::$alertas;
    }
}