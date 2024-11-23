<h1 class="mb-4 text-center">Editar Autor</h1>

<form action="index.php?action=edit&id=<?= htmlspecialchars($author['ID_AUTHOR']); ?>" method="POST" class="w-50 mx-auto">
    <div class="mb-3">
        <label for="fullName" class="form-label">Nombre Completo:</label>
        <input type="text" id="fullName" name="fullName" value="<?= htmlspecialchars($author['FULL_NAME']); ?>" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="birthDate" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" id="birthDate" name="birthDate" value="<?= htmlspecialchars($author['DATE_OF_BIRTH']); ?>" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="deathDate" class="form-label">Fecha de Muerte:</label>
        <input type="date" id="deathDate" name="deathDate" value="<?= htmlspecialchars($author['DATE_OF_DEATH'] ?? ''); ?>" class="form-control">
    </div>
    
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="index.php?action=index&controller=author" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
