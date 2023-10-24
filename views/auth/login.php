<div class="contenedor-sm login">
    <h1 class="titulo">Rancho Meneses</h1>
    <p class="descripcion-pagina">Iniciar Sesion</p>

    <form action="/" method="post" class="formulario">
        <div class="campo">
            <label for="email">Email: </label>
            <input type="email" name="email" id="email" placeholder="Tu Email">
        </div>
        <?php alertas($alertas, "email") ?>
        
        <div class="campo">
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="Tu Password">
        </div>
        <?php alertas($alertas, "password") ?>
        
        <input type="submit" value="Iniciar Sesion">
        <?php alertas($alertas, "usuario") ?>
    </form>
</div>