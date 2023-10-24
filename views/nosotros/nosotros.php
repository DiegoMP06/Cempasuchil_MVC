<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="opciones-panel">
    <a href="/nosotros/crear">Agregar Seccion</a>
</div>

<div class="contenedor-nosotros">
    <?php foreach($nosotros as $seccion): ?>
        <a href="/seccion?id=<?php echo $seccion->id ?>" class="seccion">
            <img src="/imagenes/nosotros/mini/<?php echo $seccion->imagen ?>" alt="Imagen Seccion Sobre Nosotros">
            <span><?php echo $seccion->nombre ?></span>
        </a>
    <?php endforeach ?>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php" ?>