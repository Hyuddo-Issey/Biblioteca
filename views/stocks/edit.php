<h1 class="text-center mb-4">Editar Stock del Libro</h1>

<form action="index.php?controller=stock&action=edit&id=<?= $stock['ID_STOCK']; ?>" method="POST" class="container">
    <div class="mb-3">
        <label for="idBook" class="form-label">Libro:</label>
        <select id="idBook" name="idBook" class="form-select" disabled>
            <option value="">Seleccione un Libro</option>
            <?php foreach ($books as $book): ?>
                <option value="<?= $book['ID_BOOK']; ?>" <?= ((int)$book['ID_BOOK'] === (int)$stock['ID_BOOK']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($book['TITLE']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="idBook" value="<?= $stock['ID_BOOK']; ?>">  <!-- Campo oculto para enviar el id del libro -->
    </div>

    <div class="mb-3">
        <label for="totalStock" class="form-label">Total de Stock:</label>
        <input type="number" id="totalStock" name="totalStock" class="form-control" value="<?= $stock['TOTAL_STOCK']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Notas:</label>
        <textarea id="notes" name="notes" class="form-control"><?= htmlspecialchars($stock['NOTES']); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="lastInventoryDate" class="form-label">Fecha de Último Inventario:</label>
        <input type="date" id="lastInventoryDate" name="lastInventoryDate" class="form-control" value="<?= $stock['LAST_INVENTORY_DATE']; ?>" required>
    </div>

    <div class="mb-3 text-center">
        <button type="submit" class="btn btn-success">Actualizar Stock</button>
        <a href="index.php?controller=stock&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
