<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<form class="formulario actualizar" method="POST" enctype="multipart/form-data">
    <div class="campo">
        <label for="descripcion">Descripcion: </label>
        <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $imagen->descripcion ?></textarea>
    </div>
    <?php alertas($alertas, "descripcion") ?>

    <div class="campo">
        <label for="imagen">Imagen: </label>
        
        <div class="imagen">
            <img src="/imagenes/imagenes/mini/<?php echo sanitizar($imagen->imagen) ?>" alt="Imagen de galeria">
        </div>

        <input type="file" name="imagen" id="imagen" accept="image/png, image/jpeg">
    </div>
    <?php alertas($alertas, "imagen") ?>

    <input type="submit" value="Guardar Cambios">
</form>

<?php include_once __DIR__ . "/../templates/footerDashboard.php" ?>