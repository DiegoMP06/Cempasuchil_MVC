<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>


<div class="opciones-panel">
    <a href="/galeria/crear">Agregar Imagen</a>
</div>

<div class="contenedor-galeria">
    <?php foreach($galeria as $imagen): ?>
        <a href="/imagen?id=<?php echo $imagen->id ?>" class="imagen">
            <img src="/imagenes/imagenes/mini/<?php echo $imagen->imagen ?>" alt="imagen Galeria">
            <span><?php echo $imagen->publico ? "Publicado" : "No Publicado" ?></span>
        </a>
    <?php endforeach ?>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php" ?>