<h1 class="nombre-pagina">Bienvenid@ <?php echo $_SESSION['nombre'] ?></h1>
<p class="descripcion-pagina">Crea una Nueva Cita e Ingresa tus datos a Continuacion</p>

<div id="app">
    
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información de Cita</button>
        <button type="button" data-paso="3">Resumen</button>
        <button type="button"><a href="/logout">Cerrar Sesión</a></button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elije tus Servicios a Continuación</p>
        <div class="listado-servicios" id="servicios">

        </div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus datos de Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de Cita</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Nombre" value="<?php echo $_SESSION['nombre'] ?>" disabled>
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input id="fecha" type="date" min="<?php echo date('Y-m-d') ?>">
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input id="hora" type="time">
            </div>

            <input type="hidden" id="id" value="<?php echo $id ?>">
        </form>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea Correcta</p>
    </div>

    <div class="paginacion">
        <button class="boton" id="anterior"> &laquo; Anterior</button>
        <button class="boton" id="siguiente">Siguiente &raquo;</button>
    </div>
</div>

<?php $script=" <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script> 
                <script src='build/js/app.js'></script>"; 
?>