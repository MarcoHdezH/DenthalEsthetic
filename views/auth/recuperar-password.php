<h1 class="nombre-pagina">Restablecer Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña a continuacion:</p>

<?php include_once __DIR__ . '/../templates/alertas.php'?>

<?php if($error) return null; ?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Nueva Contraseña">
    </div>
    <input type="submit" value="Guardar Contraseña" class="boton">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una Cuenta? ¡Unete hoy mismo!</a>
</div>