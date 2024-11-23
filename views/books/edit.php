<h1 class="text-center mb-4">Editar Libro</h1>

<form action="index.php?controller=book&action=edit&id=<?= $book['ID_BOOK']; ?>" method="POST" class="container">
    <div class="mb-3">
        <label for="title" class="form-label">Título:</label>
        <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($book['TITLE']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción:</label>
        <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($book['DESCRIPTION']); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="yearPublication" class="form-label">Año de Publicación:</label>
        <input type="number" id="yearPublication" name="yearPublication" class="form-control" value="<?= $book['YEAR_PUBLICATION']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="idAuthor" class="form-label">Autor:</label>
        <select id="idAuthor" name="idAuthor" class="form-select" required>
            <option value="">Seleccione un Autor</option>
            <?php foreach ($authors as $author): ?>
                <option value="<?= $author['ID_AUTHOR']; ?>" <?= ($author['ID_AUTHOR'] == $book['ID_AUTHOR']) ? 'selected' : ''; ?>>
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
                <option value="<?= $genre['ID_GENRE']; ?>" <?= ($genre['ID_GENRE'] == $book['ID_GENRE']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($genre['NAME']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-success">Actualizar Libro</button>
        <a href="index.php?controller=book&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
