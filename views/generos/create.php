<h1 class="mb-4 text-center">Crear Nuevo Género</h1>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    echo "<div class='alert alert-danger w-50 mx-auto'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<form action="index.php?controller=genero&action=create" method="POST" class="w-50 mx-auto shadow p-4 rounded bg-white">
    
    <div class="mb-3">
        <label for="nombre" class="form-label fw-bold">Nombre del Género:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Ciencia Ficción" required>
    </div>
    
    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Guardar
        </button>
        
        <a href="index.php?controller=genero&action=index" class="btn btn-secondary">
            <i class="bi bi-x-circle me-1"></i> Cancelar
        </a>
    </div>
</form>