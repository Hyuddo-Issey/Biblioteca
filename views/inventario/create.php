<h1 class="text-center mb-4">Agregar Nuevo Stock</h1>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    echo "<div class='alert alert-danger w-50 mx-auto'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<form action="index.php?controller=inventario&action=create" method="POST" class="container w-50 mx-auto shadow p-4 rounded bg-white needs-validation" novalidate>
    
    <div class="mb-3">
        <label for="idLibro" class="form-label fw-bold">Libro:</label>
        
        <select id="idLibro" name="idLibro" class="form-select" required>
            <option value="" disabled selected>Seleccione un Libro</option>
            <?php foreach ($libros as $libro): ?>
                <option value="<?= htmlspecialchars($libro['ID_LIBRO']); ?>">
                    <?= htmlspecialchars($libro['TITULO']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Por favor, seleccione un libro.</div>
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label fw-bold">Stock Total:</label>
        <input type="number" id="cantidad" name="cantidad" class="form-control" min="0" required>
        <div class="invalid-feedback">Por favor, ingrese la cantidad.</div>
    </div>

    <div class="mb-3">
        <label for="notas" class="form-label fw-bold">Notas:</label>
        <textarea id="notas" name="notas" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label fw-bold">Fecha del Último Inventario:</label>
        <input type="date" id="fecha" name="fecha" class="form-control">
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-success">
            <i class="bi bi-save me-1"></i> Guardar Stock
        </button>
        <a href="index.php?controller=inventario&action=index" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
    </div>
</form>