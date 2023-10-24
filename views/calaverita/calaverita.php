<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="contenido-calaverita">
    <textarea class="calaverita" disabled><?php echo sanitizar($calaverita->calaverita) ?></textarea>

    <ul class="caracteristicas-calaverita">
        <li>Autor: <?php echo sanitizar($calaverita->autor) ?></li>
        <li>Agregado por: <?php echo sanitizar($usuario->nombre) ?></li>
        <li><?php echo $calaverita->publico ? "Publicado" : "No Publicado" ?></li>
        <li>
            <a class="actualizar" href="/calaveritas/actualizar?id=<?php echo $calaverita->id ?>">Actualizar</a>
            <button class="eliminar" id="eliminar-btn" type="button">Eliminar</button>
        </li>
    </ul>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php";
$script .= '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/js/calaveritas/calaverita.js" type="module"></script>
';