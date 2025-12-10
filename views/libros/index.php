<h2 class="mb-4 text-center">Gestión de Libros</h2>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    $alertClass = ($msg['type'] == 'error') ? 'alert-danger' : (($msg['type'] == 'success') ? 'alert-success' : 'alert-warning');
    echo "<div class='alert $alertClass'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<div class="mb-4">
    <a href="index.php?controller=libro&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Agregar Libro
    </a>
</div>

<?php if (!empty($libros)): ?>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Año</th>
                    <th>Autor</th>
                    <th>Género</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $libro): ?>
                    <tr>
                        <td><?= htmlspecialchars($libro['ID_LIBRO']); ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($libro['TITULO']); ?></td>
                        
                        <td>
                            <?= htmlspecialchars(substr($libro['DESCRIPCION'] ?? '', 0, 50)) . (strlen($libro['DESCRIPCION'] ?? '') > 50 ? '...' : ''); ?>
                        </td>
                        
                        <td><?= htmlspecialchars($libro['ANIO_PUBLICACION']); ?></td>
                        
                        <td>
                            <span class="badge bg-light text-dark border">
                                <?= htmlspecialchars($libro['NOMBRE_AUTOR'] ?? 'Sin Autor'); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info bg-opacity-10 text-dark border-info border">
                                <?= htmlspecialchars($libro['NOMBRE_GENERO'] ?? 'Sin Género'); ?>
                            </span>
                        </td>
                        
                        <td class="text-center" style="min-width: 120px;">
                            <a href="index.php?controller=libro&action=edit&id=<?= htmlspecialchars($libro['ID_LIBRO']); ?>" class="btn btn-warning btn-sm me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="index.php?controller=libro&action=delete&id=<?= htmlspecialchars($libro['ID_LIBRO']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar el libro: <?= htmlspecialchars($libro['TITULO']); ?>?');" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info d-flex align-items-center" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i>
        <div>No hay libros registrados en el sistema.</div>
    </div>
<?php endif; ?>