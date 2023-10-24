<?php 
require_once __DIR__ . '/../includes/app.php';

use Controller\APICalaveritaController;
use Controller\APIImagenController;
use Controller\APIProductoController;
use Controller\APISeccionController;
use Controller\CalaveritaController;
use Controller\ImagenController;
use Controller\LoginController;
use Controller\PanelController;
use Controller\ProductoController;
use Controller\SeccionController;
use MVC\Router;

$router = new Router();

// $router->get('/crear', [LoginController::class, 'crear']);
$router->get("/", [LoginController::class,"login"]);
$router->post("/", [LoginController::class,"login"]);

$router->get("/logout", [LoginController::class,"logout"]);

// Panel de Administracion
$router->get("/panel", [PanelController::class, "panel"]);

$router->get("/producto", [ProductoController::class, "producto"]);
$router->get("/productos", [ProductoController::class, "productos"]);
$router->get("/productos/crear", [ProductoController::class, "crear"]);
$router->post("/productos/crear", [ProductoController::class, "crear"]);
$router->get("/productos/actualizar", [ProductoController::class, "actualizar"]);
$router->post("/productos/actualizar", [ProductoController::class, "actualizar"]);

$router->get("/calaverita", [CalaveritaController::class, "calaverita"]);
$router->get("/calaveritas", [CalaveritaController::class, "calaveritas"]);
$router->get("/calaveritas/crear", [CalaveritaController::class, "crear"]);
$router->post("/calaveritas/crear", [CalaveritaController::class, "crear"]);
$router->get("/calaveritas/actualizar", [CalaveritaController::class, "actualizar"]);
$router->post("/calaveritas/actualizar", [CalaveritaController::class, "actualizar"]);

$router->get("/imagen", [ImagenController::class, "imagen"]);
$router->get("/galeria", [ImagenController::class, "imagenes"]);
$router->get("/galeria/crear", [ImagenController::class, "crear"]);
$router->post("/galeria/crear", [ImagenController::class, "crear"]);
$router->get("/galeria/actualizar", [ImagenController::class, "actualizar"]);
$router->post("/galeria/actualizar", [ImagenController::class, "actualizar"]);

$router->get("/seccion", [SeccionController::class, "seccion"]);
$router->get("/nosotros", [SeccionController::class, "nosotros"]);
$router->get("/nosotros/crear", [SeccionController::class, "crear"]);
$router->post("/nosotros/crear", [SeccionController::class, "crear"]);
$router->get("/nosotros/actualizar", [SeccionController::class, "actualizar"]);
$router->post("/nosotros/actualizar", [SeccionController::class, "actualizar"]);

// API Publica
$router->get("/api/producto", [APIProductoController::class, "producto"]);
$router->get("/api/productos/disponibles", [APIProductoController::class, "disponibles"]);

$router->get("/api/calaveritas", [APICalaveritaController::class, "calaveritas"]);
$router->get("/api/calaverita/publica", [APICalaveritaController::class, "publica"]);

$router->get("/api/imagen", [APIImagenController::class, "imagen"]);
$router->get("/api/imagenes/publicas", [APIImagenController::class, "publicas"]);

$router->get("/api/seccion", [APISeccionController::class, "seccion"]);
$router->get("/api/secciones/publicas", [APISeccionController::class, "publicas"]);

// API Privada
$router->post("/api/producto/actualizar", [APIProductoController::class, "actualizar"]);
$router->post("/api/producto/eliminar", [APIProductoController::class, "eliminar"]);

$router->post("/api/calaverita/actualizar", [APICalaveritaController::class, "actualizar"]);
$router->post("/api/calaverita/eliminar", [APICalaveritaController::class, "eliminar"]);

$router->post("/api/imagen/actualizar", [APIImagenController::class, "actualizar"]);
$router->post("/api/imagen/eliminar", [APIImagenController::class, "eliminar"]);

$router->post("/api/seccion/actualizar", [APISeccionController::class, "actualizar"]);
$router->post("/api/seccion/eliminar", [APISeccionController::class, "eliminar"]);

$router->comprobarRutas();