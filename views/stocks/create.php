<h1 class="text-center mb-4">Agregar Nuevo Stock</h1>

<form action="index.php?controller=stock&action=create" method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="bookId" class="form-label">Libro:</label>
        <select id="bookId" name="idBook" class="form-select" required>
            <option value="" disabled selected>Seleccione un Libro</option>
            <?php foreach ($books as $book): ?>
                <option value="<?= htmlspecialchars($book['ID_BOOK']); ?>">
                    <?= htmlspecialchars($book['TITLE']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Por favor, seleccione un libro.</div>
    </div>

    <div class="mb-3">
        <label for="totalStock" class="form-label">Stock Total:</label>
        <input type="number" id="totalStock" name="totalStock" class="form-control" min="0" required>
        <div class="invalid-feedback">Por favor, ingrese el stock total.</div>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Notas:</label>
        <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="lastInventoryDate" class="form-label">Fecha del Último Inventario:</label>
        <input type="date" id="lastInventoryDate" name="lastInventoryDate" class="form-control">
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-success">Guardar Stock</button>
        <a href="index.php?controller=stock&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
