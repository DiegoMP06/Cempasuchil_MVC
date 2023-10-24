<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<form class="formulario actualizar" method="post">
    <div class="campo">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre de la Calaverita" value="<?php echo $calaverita->nombre ?>">
    </div>
    <?php alertas($alertas, "nombre") ?>

    <div class="campo">
        <label for="calaverita">Calaverita: </label>
        <textarea name="calaverita" id="calaverita" cols="30" rows="10" placeholder="Tu Calaverita"><?php echo $calaverita->calaverita ?></textarea>
    </div>
    <?php alertas($alertas, "calaverita") ?>

    <div class="campo">
        <label for="autor">Autor: </label>
        <input type="text" name="autor" id="autor" placeholder="Autor de la Calaverita" value="<?php echo $calaverita->autor ?>">
    </div>
    <?php alertas($alertas, "autor") ?>

    <input type="submit" value="Guardar Cambios">
</form>

<?php include_once __DIR__ . "/../templates/footerDashboard.php" ?>