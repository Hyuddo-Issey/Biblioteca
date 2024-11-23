<h1 class="text-center mb-4">Agregar Nuevo Libro</h1>

<form action="index.php?controller=book&action=create" method="POST" class="container">
    <div class="mb-3">
        <label for="title" class="form-label">Título:</label>
        <input type="text" id="title" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción:</label>
        <input type="text" id="description" name="description" class="form-control">
    </div>

    <div class="mb-3">
        <label for="yearPublication" class="form-label">Año de Publicación:</label>
        <input type="number" id="yearPublication" name="yearPublication" class="form-control" min="1000" max="9999" required>
    </div>

    <div class="mb-3">
        <label for="idAuthor" class="form-label">Autor:</label>
        <select id="idAuthor" name="idAuthor" class="form-select" required>
            <option value="">Seleccione un Autor</option>
            <?php foreach ($authors as $author): ?>
                <option value="<?= htmlspecialchars($author['ID_AUTHOR']); ?>">
                    <?= htmlspecialchars($author['FULL_NAME']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="idGenre" class="form-label">Género:</label>
        <select id="idGenre" name="idGenre" class="form-select" required>
            <option value="">Seleccione un Género</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= htmlspecialchars($genre['ID_GENRE']); ?>">
                    <?= htmlspecialchars($genre['NAME']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-success">Guardar Libro</button>
        <a href="index.php?controller=book&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
