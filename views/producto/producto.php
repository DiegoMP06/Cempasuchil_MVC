<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="contenido-producto">
    <div class="imagen">
        <img src="/imagenes/productos/<?php echo sanitizar($producto->imagen) ?>" alt="Imgen del producto <?php echo sanitizar($producto->nombre) ?>">
    </div>

    <ul class="caracteristicas-producto">
        <li>$<?php echo sanitizar($producto->precio) ?></li>
        <li>Creado por: <?php echo sanitizar($usuario->nombre) ?></li>
        <li><button class="<?php echo $producto->disponible ? "disponible" : "no-disponible" ?>" id="diponible-btn"><?php echo $producto->disponible ? "Disponible" : "No Disponible" ?></button></li>
        <li>
            <a class="actualizar" href="/productos/actualizar?id=<?php echo $producto->id ?>">Actualizar</a>
            <button class="eliminar" id="eliminar-btn" type="button">Eliminar</button>
        </li>
    </ul>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php" ;
$script .= '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/js/productos/producto.js" type="module"></script>
';