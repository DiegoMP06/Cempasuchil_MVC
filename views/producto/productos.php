<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="opciones-panel">
    <a href="/productos/crear">Agregar Producto</a>
</div>

<div class="contenedor-productos">
    <?php foreach($productos as $producto): ?>
        <a class="producto" href="/producto?id=<?php echo sanitizar($producto->id) ?>">
            <img width="100" height="100" src="/imagenes/productos/mini/<?php echo sanitizar($producto->imagen) ?>" alt="imagen Producto <?php echo sanitizar($producto->nombre) ?>">
            <span class="nombre"><?php echo sanitizar($producto->nombre) ?></span>
            <span class="precio">$ <?php echo sanitizar($producto->precio) ?></span>
        </a>
    <?php endforeach ?>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php"; ?>