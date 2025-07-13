<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f7f7f7; }
        .login-box {
            max-width: 400px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3 class="text-center mb-4">Iniciar Sesión</h3>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php
                switch ($_GET['error']) {
                    case 'email':
                        echo '❌ El correo no está registrado.';
                        break;
                    case 'clave':
                        echo '❌ Contraseña incorrecta.';
                        break;
                    case 'campos':
                        echo '❌ Completá todos los campos.';
                        break;
                    case 'confirmacion':
                        echo '⚠️ Tenés que confirmar tu cuenta antes de iniciar sesión.';
                        break;
                    default:
                        echo '❌ Error al iniciar sesión.';
                }
            ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="../controllers/loginController.php">
        <div class="mb-3">
            <label>Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control" 
                required 
                value="<?= htmlspecialchars($_GET['oldemail'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </div>
        <div class="text-center mt-3">
            <a href="register.php" class="text-decoration-none">¿No tenés cuenta? Crear usuario</a>
        </div>
    </form>
</div>

</body>
</html>