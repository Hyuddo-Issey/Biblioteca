<h2 class="mb-4 text-center">Listado de Autores</h2>

<?php
if (isset($_SESSION['flash_message'])) {
    $msg = $_SESSION['flash_message'];
    $alertClass = ($msg['type'] == 'error') ? 'alert-danger' : (($msg['type'] == 'success') ? 'alert-success' : 'alert-warning');
    echo "<div class='alert $alertClass'>" . htmlspecialchars($msg['text']) . "</div>";
    unset($_SESSION['flash_message']);
}
?>

<div class="d-flex justify-content-between mb-4">
    <a href="index.php?controller=autor&action=create" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Agregar Autor
    </a>
</div>

<?php if (!empty($autores)): ?>
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Fallecimiento</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autores as $autor): ?>
                    <tr>
                        <td><?= htmlspecialchars($autor['ID_AUTOR']); ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($autor['NOMBRE_COMPLETO']); ?></td>
                        
                        <td><?= date('d/m/Y', strtotime($autor['FECHA_NACIMIENTO'])); ?></td>
                        
                        <td>
                            <?php 
                            if (!empty($autor['FECHA_FALLECIMIENTO'])) {
                                echo date('d/m/Y', strtotime($autor['FECHA_FALLECIMIENTO']));
                            } else {
                                echo '<span class="badge bg-success">---</span>';
                            }
                            ?>
                        </td>
                        
                        <td class="text-center">
                            <a href="index.php?controller=autor&action=edit&id=<?= htmlspecialchars($autor['ID_AUTOR']); ?>" class="btn btn-warning btn-sm me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="index.php?controller=autor&action=delete&id=<?= htmlspecialchars($autor['ID_AUTOR']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este autor? Si tiene libros asociados no se podrá borrar.');" title="Eliminar">
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
        <div>No hay autores registrados en el sistema.</div>
    </div>
<?php endif; ?>