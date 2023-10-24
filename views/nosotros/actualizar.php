<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<form class="formulario actualizar" method="POST" enctype="multipart/form-data">
    <div class="campo">
        <label for="nombre">Nombre Seccion: </label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $seccion->nombre ?>">
    </div>
    <?php alertas($alertas, "nombre") ?>

    <div class="campo">
        <label for="contenido">Contenido Seccion: </label>
        <textarea name="contenido" id="contenido" cols="30" rows="10"><?php echo $seccion->contenido ?></textarea>
    </div>
    <?php alertas($alertas, "contenido") ?>

    <div class="campo">
        <label for="imagen">Imagen: </label>

        <div class="imagen">
            <img src="/imagenes/nosotros/mini/<?php echo sanitizar($seccion->imagen) ?>" alt="Imagen de seccion">
        </div>

        <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg">
    </div>
    <?php alertas($alertas, "imagen") ?>

    <input type="submit" value="Guardar Cambios">
</form>

<?php include_once __DIR__ . "/../templates/footerDashboard.php" ?>