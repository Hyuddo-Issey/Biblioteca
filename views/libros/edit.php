<h1 class="text-center mb-4">Editar Libro</h1>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    echo "<div class='alert alert-danger w-50 mx-auto'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<form action="index.php?controller=libro&action=edit&id=<?= $libro['ID_LIBRO']; ?>" method="POST" class="container w-50 mx-auto shadow p-4 rounded bg-white">
    
    <div class="mb-3">
        <label for="titulo" class="form-label fw-bold">Título:</label>
        <input type="text" id="titulo" name="titulo" class="form-control" value="<?= htmlspecialchars($libro['TITULO']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label fw-bold">Descripción:</label>
        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($libro['DESCRIPCION']); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="anioPublicacion" class="form-label fw-bold">Año de Publicación:</label>
        <input type="number" id="anioPublicacion" name="anioPublicacion" class="form-control" value="<?= $libro['ANIO_PUBLICACION']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="idAutor" class="form-label fw-bold">Autor:</label>
        <select id="idAutor" name="idAutor" class="form-select" required>
            <option value="">Seleccione un Autor</option>
            <?php foreach ($autores as $autor): ?>
                <option value="<?= $autor['ID_AUTOR']; ?>" <?= ($autor['ID_AUTOR'] == $libro['ID_AUTOR']) ? 'selected' : ''; ?>>
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
                <option value="<?= $genero['ID_GENERO']; ?>" <?= ($genero['ID_GENERO'] == $libro['ID_GENERO']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($genero['NOMBRE']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Actualizar Libro
        </button>
        <a href="index.php?controller=libro&action=index" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
    </div>
</form>