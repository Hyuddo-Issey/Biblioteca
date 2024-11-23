<h2 class="mb-4 text-center">Listado de Autores</h2>

<div class="d-flex justify-content-between mb-4">
    <a href="index.php?controller=author&action=create" class="btn btn-primary">Agregar Autor</a>
</div>

<?php if (!empty($authors)): ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Fallecimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author): ?>
                    <tr>
                        <td><?= htmlspecialchars($author['ID_AUTHOR']); ?></td>
                        <td><?= htmlspecialchars($author['FULL_NAME']); ?></td>
                        <td><?= htmlspecialchars($author['DATE_OF_BIRTH']); ?></td>
                        <td><?= htmlspecialchars($author['DATE_OF_DEATH'] ?? 'N/A'); ?></td>
                        <td>
                            <a href="index.php?controller=author&action=edit&id=<?= htmlspecialchars($author['ID_AUTHOR']); ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="index.php?controller=author&action=delete&id=<?= htmlspecialchars($author['ID_AUTHOR']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este autor?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info" role="alert">
        No hay autores registrados.
    </div>
<?php endif; ?>
