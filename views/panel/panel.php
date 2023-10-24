<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="opciones-panel">
    <a href="<?php echo $_ENV["APP_URL_FRONT"] ?>" target="_blank">Ir a La Pagina Principal</a>

    <a href="/productos">Administrar Productos</a>
    <a href="/calaveritas">Administrar Calaveritas</a>
    <a href="/galeria">Administrar Galeria</a>
    <a href="/nosotros">Sobre Nosotros</a>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php" ?>