<h1 class="text-center mb-4">Editar Registro de Inventario</h1>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    echo "<div class='alert alert-danger w-50 mx-auto'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<form action="index.php?controller=inventario&action=edit&id=<?= $item['ID_INVENTARIO']; ?>" method="POST" class="container w-50 mx-auto shadow p-4 rounded bg-white">
    
    <div class="mb-3">
        <label for="idLibro" class="form-label fw-bold">Libro:</label>
        
        <select id="idLibro" class="form-select bg-light" disabled>
            <option value="">Seleccione un Libro</option>
            <?php foreach ($libros as $libro): ?>
                <option value="<?= $libro['ID_LIBRO']; ?>" <?= ($libro['ID_LIBRO'] == $item['ID_LIBRO']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($libro['TITULO']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <input type="hidden" name="idLibro" value="<?= $item['ID_LIBRO']; ?>">
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label fw-bold">Total de Stock:</label>
        <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?= $item['CANTIDAD_STOCK']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="notas" class="form-label fw-bold">Notas:</label>
        <textarea id="notas" name="notas" class="form-control" rows="3"><?= htmlspecialchars($item['NOTAS']); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label fw-bold">Fecha de Último Inventario:</label>
        <input type="date" id="fecha" name="fecha" class="form-control" value="<?= $item['FECHA_ULTIMO_INVENTARIO']; ?>" required>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save me-1"></i> Actualizar Stock
        </button>
        <a href="index.php?controller=inventario&action=index" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
    </div>
</form>