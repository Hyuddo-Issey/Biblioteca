<h2 class="text-center mb-4">Gestión de Inventario</h2>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    $alertClass = ($msg['type'] == 'error') ? 'alert-danger' : (($msg['type'] == 'success') ? 'alert-success' : 'alert-warning');
    echo "<div class='alert $alertClass'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<div class="mb-4">
    <a href="index.php?controller=inventario&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Agregar Stock
    </a>
</div>

<?php if (!empty($inventario)): ?>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Libro</th>
                    <th>Stock Total</th>
                    <th>Notas</th>
                    <th>Última Actualización</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventario as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['ID_INVENTARIO']); ?></td>
                        
                        <td class="fw-bold">
                            <i class="bi bi-book me-1 text-muted"></i>
                            <?= htmlspecialchars($item['TITULO_LIBRO'] ?? 'Libro Eliminado'); ?>
                        </td>
                        
                        <td>
                            <span class="badge bg-success rounded-pill fs-6">
                                <?= htmlspecialchars($item['CANTIDAD_STOCK']); ?>
                            </span>
                        </td>
                        
                        <td class="text-muted small">
                            <?= htmlspecialchars($item['NOTAS'] ?? '---'); ?>
                        </td>
                        
                        <td>
                            <?= date('d/m/Y', strtotime($item['FECHA_ULTIMO_INVENTARIO'])); ?>
                        </td>
                        
                        <td class="text-center">
                            <a href="index.php?controller=inventario&action=edit&id=<?= htmlspecialchars($item['ID_INVENTARIO']); ?>" class="btn btn-warning btn-sm me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="index.php?controller=inventario&action=delete&id=<?= htmlspecialchars($item['ID_INVENTARIO']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este registro de inventario?');" title="Eliminar">
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
        <i class="bi bi-box-seam me-2"></i>
        <div>No hay registros de inventario disponibles.</div>
    </div>
<?php endif; ?>