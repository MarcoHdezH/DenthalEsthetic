<h1 class="nombre-pagina">Olvide mi Contraseña</h1>

<p class="descripcion-pagina">Escribe el correo electronico asociado a tu cuenta</p>

<form class="formulario" method="POST" action="/olvidar">
    <div class="campo">
        <label for="email">Correo: </label>
        <input type="email" id="email" name="email" placeholder="ejmplo@correo.com">
    </div>

    <input type="submit" class="boton" value="Reestablecer Contraseña">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una Cuenta? ¡Unete hoy mismo!</a>
</div>