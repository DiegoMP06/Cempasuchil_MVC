<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="contenido-seccion">
    <div class="imagen">
        <img src="/imagenes/nosotros/<?php echo $seccion->imagen ?>" alt="Imagen Galeria Numero <?php echo $seccion->id ?>">
    </div>

    <div class="contenido">
        <h3>Contenido: </h3>
        <blockquote><?php echo $seccion->contenido ?></blockquote>
    </div>

    <ul class="caracteristicas-seccion">
        <li>Creado por: <?php echo sanitizar($usuario->nombre) ?></li>
        <li><button class="<?php echo $seccion->publico ? "publico" : "privado" ?>" id="publico-btn"><?php echo $seccion->publico ? "Publicado" : "No Publicado" ?></button></li>
        <li>
            <a class="actualizar" href="/nosotros/actualizar?id=<?php echo $seccion->id ?>">Actualizar</a>
            <button class="eliminar" id="eliminar-btn" type="button">Eliminar</button>
        </li>
    </ul>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php";
$script .= '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/js/nosotros/seccion.js" type="module"></script>
';