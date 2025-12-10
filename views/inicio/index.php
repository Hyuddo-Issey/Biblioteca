<div class="container text-center">
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm mt-5">
        
        <h1 class="display-4 fw-bold text-primary">Bienvenido</h1>
        <p class="lead">Gestiona libros, autores y géneros favoritos de manera fácil y rápida.</p>
        <hr class="my-4">
        
        <p class="fs-5">
            Descubre más de <strong><?= $cantidadLibros ?></strong> libros, 
            explora <strong><?= $cantidadGeneros ?></strong> géneros y 
            más de <strong><?= $cantidadAutores ?></strong> autores registrados.
        </p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-4">
            <a class="btn btn-primary btn-lg px-4 gap-3" href="index.php?controller=libro&action=index" role="button">
                <i class="bi bi-journal-bookmark me-2"></i>Explorar Libros
            </a>
            <a class="btn btn-outline-secondary btn-lg px-4" href="index.php?controller=autor&action=index" role="button">
                <i class="bi bi-people me-2"></i>Ver Autores
            </a>
        </div>
        
        <?php if(isset($totalInventario)): ?>
            <p class="mt-3 text-muted small">
                <i class="bi bi-box-seam"></i> Total de ejemplares físicos: <?= $totalInventario ?>
            </p>
        <?php endif; ?>
    </div>
</div>