<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">

<div class="container-fluid">

<a class="navbar-brand" href="/indicesomos/tablero.php">

Índice Inclusión LGTBI+

</a>

<button
class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarPrincipal">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse" id="navbarPrincipal">

<ul class="navbar-nav me-auto">

    <!-- ADMINISTRACION -->

    <li class="nav-item dropdown">

       <a
        class="nav-link dropdown-toggle"
        href="#"
        data-bs-toggle="dropdown">

        Administración

        </a>

        <ul class="dropdown-menu">

            <li>
                <a
                class="dropdown-item"
                href="/IndiceSOMOS/modulos/usuarios/index.php">

                Usuarios

                </a>
            </li>
			
			<li>
				<a
				class="dropdown-item"
				href="/IndiceSOMOS/modulos/perfil/">

				Mi Perfil

				</a>

				</li>

            <li class="nav-item">

				<a
				class="dropdown-item"
				href="/IndiceSOMOS/modulos/organizaciones/index.php">

					Organizaciones

				</a>

			</li>
			
			<li class="nav-item">

				<a class="dropdown-item"
				href="/IndiceSOMOS/modulos/periodos/">

				Periodos de Encuesta

				</a>

				</li>

        </ul>

    </li>

    <!-- INDICE -->

    <li class="nav-item dropdown">

       <!-- <a
        class="nav-link dropdown-toggle"
        href="#"
        data-bs-toggle="dropdown">

        Índice

        </a>

        <ul class="dropdown-menu">

            <li>
                <a
                class="dropdown-item"
                href="#">

                Dimensiones

                </a>
            </li>

            <li>
                <a
                class="dropdown-item"
                href="#">

                Indicadores

                </a>
            </li>

            <li>
                <a
                class="dropdown-item"
                href="#">

                Ponderaciones

                </a>
            </li>

        </ul>

    </li>

    <!-- ENCUESTAS -->
		
	

    <li class="nav-item dropdown">

    <a
    class="nav-link dropdown-toggle"
    href="#"
    data-bs-toggle="dropdown">

    Encuestas

    </a>

    <ul class="dropdown-menu">
		
		<li class="">

			<a
			class="dropdown-item"
			href="/indicesomos/modulos/consultar_encuestas/index.php">

			Consultar Encuestas

			</a>

		</li>

        <li>
            <a
            class="dropdown-item"
            href="/indicesomos/modulos/encuestas/formulario.php">

            Nueva Encuesta

            </a>
        </li>

     <!--   <li>
            <a
            class="dropdown-item"
            href="/indicesomos/modulos/encuestas/index.php">

            Listado de Encuestas

            </a>
        </li>-->

    </ul>

</li>

    <!-- REPORTES -->

    <li class="nav-item dropdown">

        <!--<a
        class="nav-link dropdown-toggle"
        href="#"
        data-bs-toggle="dropdown">

        Reportes

        </a>

        <ul class="dropdown-menu">

            <li>
                <a
                class="dropdown-item"
                href="#">

                Dashboard

                </a>
            </li>

            <li>
                <a
                class="dropdown-item"
                href="#">

                Resultados

                </a>
            </li>

            <li>
                <a
                class="dropdown-item"
                href="#">

                Exportar Excel

                </a>
            </li>

            <li>
                <a
                class="dropdown-item"
                href="#">

                Exportar CSV

                </a>
            </li>

        </ul>-->

    </li>

</ul>

<span class="navbar-text text-white me-3">

<?= $_SESSION["nombre"]; ?>

</span>

<a
href="/indicesomos/logout.php"
class="btn btn-danger btn-sm">

Cerrar Sesión

</a>

</div>

</div>

</nav>