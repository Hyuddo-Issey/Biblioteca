<h2 class="text-center mb-4">Listado de Libros</h2>

<!-- Botón para agregar un nuevo libro -->
<div class="mb-3 text-end">
    <a href="index.php?controller=book&action=create" class="btn btn-primary">Agregar Libro</a>
</div>

<!-- Tabla de Libros -->
<?php if (!empty($books)): ?>
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Año de Publicación</th>
                <th>Autor</th>
                <th>Género</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['ID_BOOK']); ?></td>
                    <td><?= htmlspecialchars($book['TITLE']); ?></td>
                    <td><?= htmlspecialchars($book['DESCRIPTION']); ?></td>
                    <td><?= htmlspecialchars($book['YEAR_PUBLICATION']); ?></td>
                    <td><?= htmlspecialchars($book['AUTHOR_NAME'] ?? 'Desconocido'); ?></td> <!-- El nombre del autor ya está en el resultado -->
                    <td><?= htmlspecialchars($book['GENRE_NAME'] ?? 'Desconocido'); ?></td> <!-- El nombre del género ya está en el resultado -->
                    <td>
                        <a href="index.php?controller=book&action=edit&id=<?= htmlspecialchars($book['ID_BOOK']); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?controller=book&action=delete&id=<?= htmlspecialchars($book['ID_BOOK']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este libro?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-center">No hay libros registrados.</p>
<?php endif; ?>

<?php if (isset($status) && isset($message)): ?>
    <?php include '../views/modals/modalMessage.php'; ?>
    <script src="../../public/js/modalHandler.js"></script>
<?php endif; ?>


