<?php include_once __DIR__ . "/../templates/headerDashboard.php" ?>

<div class="opciones-panel">
    <a href="/calaveritas/crear">Agregar Calaverita</a>
    <button id="predeterminada-btn">Predeterminada</button>
</div>

<div class="contenedor-calaveritas">
    <?php foreach($calaveritas as $calaverita): ?>
        <a class="calaverita" href="/calaverita?id=<?php echo $calaverita->id ?>">
            <span class="nombre"><?php echo sanitizar($calaverita->nombre) ?></span>
            <span class="autor">Autor: <?php echo sanitizar($calaverita->autor) ?></span>
        </a>
    <?php endforeach; ?>
</div>

<?php include_once __DIR__ . "/../templates/footerDashboard.php";
$script .= '
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/js/calaveritas/calaveritas.js" type="module"></script>
';