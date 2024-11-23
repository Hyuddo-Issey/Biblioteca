<div class="container text-center">
    <div class="jumbotron mt-5">
        <h1 class="display-4">Bienvenido</h1>
        <p class="lead">Gestiona libros, autores y géneros favoritos de manera fácil y rápida.</p>
        <hr class="my-4">
        <p>Descubre más de <?= $numBooks ?> libros, explora <?= $numGenres ?> géneros y más de <?= $numAuthors ?> autores registrados.</p>
        <a class="btn btn-primary btn-lg" href="index.php?controller=book&action=index" role="button">Explorar Libros</a>
        <a class="btn btn-secondary btn-lg" href="index.php?controller=author&action=index" role="button">Ver Autores</a>
    </div>
</div>
