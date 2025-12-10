<h1 class="text-center mb-4">Agregar Nuevo Libro</h1>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    echo "<div class='alert alert-danger w-50 mx-auto'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<form action="index.php?controller=libro&action=create" method="POST" class="container w-50 mx-auto shadow p-4 rounded bg-white">
    
    <div class="mb-3">
        <label for="titulo" class="form-label fw-bold">Título:</label>
        <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Ej. El Principito" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label fw-bold">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" placeholder="Breve reseña del libro"></textarea>
    </div>

    <div class="mb-3">
        <label for="anioPublicacion" class="form-label fw-bold">Año de Publicación:</label>
        <input type="number" id="anioPublicacion" name="anioPublicacion" class="form-control" min="1000" max="<?= date('Y') + 1 ?>" required>
    </div>

    <div class="mb-3">
        <label for="idAutor" class="form-label fw-bold">Autor:</label>
        <select id="idAutor" name="idAutor" class="form-select" required>
            <option value="">Seleccione un Autor</option>
            <?php foreach ($autores as $autor): ?>
                <option value="<?= htmlspecialchars($autor['ID_AUTOR']); ?>">
                    <?= htmlspecialchars($autor['NOMBRE_COMPLETO']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="idGenero" class="form-label fw-bold">Género:</label>
        <select id="idGenero" name="idGenero" class="form-select" required>
            <option value="">Seleccione un Género</option>
            <?php foreach ($generos as $genero): ?>
                <option value="<?= htmlspecialchars($genero['ID_GENERO']); ?>">
                    <?= htmlspecialchars($genero['NOMBRE']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save me-1"></i> Guardar Libro
        </button>
        <a href="index.php?controller=libro&action=index" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
    </div>
</form>