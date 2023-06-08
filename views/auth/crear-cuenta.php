<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Por favor llena el siguiente Formulario</p>

<form class="formulario" method="POST" action="/crear-cuenta">

    <div class="campo">
        <label for="nombre">Nombre(s):</label>
        <input type="text" id="nombre" name="nombre" placeholder="Escribe tu(s) nombre(s)">
    </div>
    
    <div class="campo">
        <label for="apellido">Apellido(s):</label>
        <input type="text" id="apellido" name="apellido" placeholder="Escribe tu(s) Apellido(s)">
    </div>

    <div class="campo">
        <label for="telefono">Tefefono:</label>
        <input type="tel" id="telefono" name="telefono" placeholder="222-222-2222">
    </div>

    <div class="campo">
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" placeholder="ejemplo@correo.com">
    </div>

    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="email" placeholder="Contraseña">
    </div>

    <input class="boton" type="submit" value="Crear Cuenta">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvidar">¿Olvidaste tu Contraseña?</a>
</div>