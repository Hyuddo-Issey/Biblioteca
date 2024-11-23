<h1 class="mb-4 text-center">Crear Nuevo Género</h1>

<form action="index.php?action=create&controller=genre" method="POST" class="w-50 mx-auto">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre del Género:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?action=index&controller=genre" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
