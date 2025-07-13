<div class="row g-3">
    <div class="col-md-6">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?= $estudiante['nombre'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
        <label>Apellido</label>
        <input type="text" name="apellido" class="form-control" value="<?= $estudiante['apellido'] ?? '' ?>" required>
    </div>
    <div class="col-md-4">
        <label>Edad</label>
        <input type="number" name="edad" class="form-control" value="<?= $estudiante['edad'] ?? '' ?>" required>
    </div>
    <div class="col-md-4">
        <label>Curso</label>
        <input type="text" name="curso" class="form-control" value="<?= $estudiante['curso'] ?? '' ?>" required>
    </div>
    <div class="col-md-4">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= $estudiante['email'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="<?= $estudiante['telefono'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
        <label>Dirección</label>
        <input type="text" name="direccion" class="form-control" value="<?= $estudiante['direccion'] ?? '' ?>" required>
    </div>
    <div class="col-md-12">
    <label>Imagen</label>
    <input type="file" name="imagen" class="form-control mb-2">

    <?php if (!empty($estudiante['imagen']) && file_exists("../uploads/{$estudiante['imagen']}")): ?>
        <img src="../uploads/<?= $estudiante['imagen'] ?>" width="80" height="80" class="rounded border" style="object-fit: cover;">
    <?php else: ?>
        <div class="d-inline-block bg-light text-muted text-center border rounded" style="width: 80px; height: 80px; line-height: 80px; font-size: 13px;">
            Sin foto
        </div>
    <?php endif; ?>
</div>

</div>