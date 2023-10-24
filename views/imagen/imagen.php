<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="contenido-imagen">
    <div class="imagen">
        <img src="/imagenes/imagenes/<?php echo $imagen->imagen ?>" alt="Imagen Galeria Numero <?php echo $imagen->id ?>">
    </div>

    <div class="descripcion">
        <h3>Descripcion: </h3>
        <blockquote><?php echo $imagen->descripcion ?></blockquote>
    </div>

    <ul class="caracteristicas-imagen">
        <li>Creado por: <?php echo sanitizar($usuario->nombre) ?></li>
        <li><button class="<?php echo $imagen->publico ? "publico" : "privado" ?>" id="publico-btn"><?php echo $imagen->publico ? "Publicado" : "No Publicado" ?></button></li>
        <li>
            <a class="actualizar" href="/galeria/actualizar?id=<?php echo $imagen->id ?>">Actualizar</a>
            <button class="eliminar" id="eliminar-btn" type="button">Eliminar</button>
        </li>
    </ul>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php";
$script .= '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/js/galeria/imagen.js" type="module"></script>
';