<h2 class="mb-4 text-center">Gestión de Géneros</h2>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    $alertClass = ($msg['type'] == 'error') ? 'alert-danger' : (($msg['type'] == 'success') ? 'alert-success' : 'alert-warning');
    echo "<div class='alert $alertClass'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<div class="mb-4">
    <a href="index.php?controller=genero&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Agregar Género
    </a>
</div>

<?php if (!empty($generos)): ?>
    <div class="table-responsive shadow-sm rounded w-75 mx-auto">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th>Nombre</th>
                    <th class="text-center" style="width: 20%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($generos as $genero): ?>
                    <tr>
                        <td><?= htmlspecialchars($genero['ID_GENERO']); ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($genero['NOMBRE']); ?></td>
                        <td class="text-center">
                            <a href="index.php?controller=genero&action=edit&id=<?= htmlspecialchars($genero['ID_GENERO']); ?>" class="btn btn-warning btn-sm me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="index.php?controller=genero&action=delete&id=<?= htmlspecialchars($genero['ID_GENERO']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este género? No se podrá si tiene libros.');" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info text-center">No hay géneros registrados.</div>
<?php endif; ?>