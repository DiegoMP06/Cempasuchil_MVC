<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<form class="formulario actualizar" method="post" enctype="multipart/form-data">
    <div class="campo">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" value="<?php echo $producto->nombre ?>">
    </div>
    <?php alertas($alertas, "nombre") ?>
    
    <div class="campo">
        <label for="precio">Precio: </label>
        <input type="number" name="precio" id="precio" step=".01" min="0" placeholder="Precio del Producto" value="<?php echo $producto->precio ?>">
    </div>
    <?php alertas($alertas, "precio") ?>
    
    <div class="campo">
        <label for="imagen">Imagen: </label>
    
        <div class="imagen">
            <img src="/imagenes/productos/mini/<?php echo sanitizar($producto->imagen) ?>" alt="Imagen del producto <?php echo $producto->nombre ?>">
        </div>

        <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg">

    </div>
    <?php alertas($alertas, "imagen") ?>

    <input type="submit" value="Guardar Cambios">
</form>


<?php include_once __DIR__ . "/../templates/footerDashboard.php" ?>