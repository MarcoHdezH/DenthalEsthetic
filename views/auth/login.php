<h1 class="nombre-pagina">¡Bienvenid@!</h1>
<p class="descripcion-pagina">Agenda tu experiencia en pocos minutos</p>

<?php include_once __DIR__ . '/../templates/alertas.php' ?>

<form class="formulario" method="POST" action="/">
    
    <div class="campo">
        <label for="email">Correo:</label>
        <input type="email" id="email" placeholder="ejemplo@correo.com" name="email">
    </div>

    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" placeholder="Contraseña" name="password">
    </div>

    <input type="submit" class="boton" value="iniciar Sesión">
</form>

<div class="acciones login">
    <a href="/crear-cuenta">¿Aún no tienes una Cuenta? ¡Unete hoy mismo!</a>
    <a href="/olvidar">¿Olvidaste tu Contraseña?</a>
</div>