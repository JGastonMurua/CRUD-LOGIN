<?php include '../includes/header.php'; ?>
<h2>Registro de Usuario</h2>
<form action="../controllers/registerController.php" method="POST">
    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Confirmar Contraseña</label>
        <input type="password" name="confirm_password" class="form-control" required>
    </div>
    <button class="btn btn-success">Registrarse</button>
</form>
<p class="mt-3">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
<?php include '../includes/footer.php'; ?>
