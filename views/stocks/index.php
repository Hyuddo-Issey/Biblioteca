<h2 class="text-center mb-4">Listado de Stock</h2>

<!-- Botón para agregar un nuevo registro de stock -->
<div class="action-bar mb-3">
    <a href="index.php?controller=stock&action=create" class="btn btn-primary">Agregar Stock</a>
</div>

<!-- Tabla de Stock -->
<?php if (!empty($stock)): ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Libro</th>
                <th>Stock Total</th>
                <th>Notas</th>
                <th>Fecha Último Inventario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stock as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['ID_STOCK']); ?></td>
                    <td><?= htmlspecialchars($item['BOOK_TITLE']); ?></td>
                    <td><?= htmlspecialchars($item['TOTAL_STOCK']); ?></td>
                    <td><?= htmlspecialchars($item['NOTES'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($item['LAST_INVENTORY_DATE'] ?? 'N/A'); ?></td>
                    <td>
                        <a href="index.php?controller=stock&action=edit&id=<?= htmlspecialchars($item['ID_STOCK']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?controller=stock&action=delete&id=<?= htmlspecialchars($item['ID_STOCK']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro de stock?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-center">No hay registros de stock disponibles.</p>
<?php endif; ?>
