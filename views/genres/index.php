<h2 class="mb-4 text-center">Listado de Géneros</h2>

<div class="mb-4 text-end">
    <a href="index.php?controller=genre&action=create" class="btn btn-primary">Agregar Género</a>
</div>

<?php if (!empty($genres)): ?>
    <table class="table table-striped table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nombre del Género</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($genres as $genre): ?>
                <tr>
                    <td><?= htmlspecialchars($genre['ID_GENRE']); ?></td>
                    <td><?= htmlspecialchars($genre['NAME']); ?></td>
                    <td>
                        <a href="index.php?controller=genre&action=edit&id=<?= htmlspecialchars($genre['ID_GENRE']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?controller=genre&action=delete&id=<?= htmlspecialchars($genre['ID_GENRE']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este género?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-center">No hay géneros registrados.</p>
<?php endif; ?>
