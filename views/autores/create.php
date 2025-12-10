<h1 class="mb-4 text-center">Agregar Nuevo Autor</h1>

<form action="index.php?controller=autor&action=create" method="POST" class="w-50 mx-auto">
    
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre Completo:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
    </div>
    
    <div class="mb-3">
        <label for="fechaFallecimiento" class="form-label">Fecha de Muerte:</label>
        <input type="date" id="fechaFallecimiento" name="fechaFallecimiento" class="form-control">
    </div>
    
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?controller=autor&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>