<?php
require '../includes/auth.php';
require '../includes/header.php';
require '../includes/db.php';
require '../models/Estudiante.php';

$estudianteModel = new Estudiante($conn);

// Para DataTables, obtenemos todos los estudiantes (la búsqueda la manejará DataTables)
$estudiantes = $estudianteModel->obtenerTodos();
?>

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

<link href="../assets/css/estudiantes.css" rel="stylesheet">

<!-- SweetAlert2 para alertas mejoradas -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<h2>🎓 Lista de Estudiantes</h2>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crearModal">
    ➕ Agregar Estudiante
</button>

<?php if (isset($_GET['mensaje'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let mensaje = '<?php echo $_GET['mensaje']; ?>';
            let titulo = '';
            let texto = '';
            let icono = 'success';
            
            switch(mensaje) {
                case 'creado':
                    titulo = '¡Éxito!';
                    texto = 'Estudiante creado correctamente';
                    break;
                case 'editado':
                    titulo = '¡Actualizado!';
                    texto = 'Estudiante editado correctamente';
                    break;
                case 'eliminado':
                    titulo = '¡Eliminado!';
                    texto = 'Estudiante eliminado correctamente';
                    break;
            }
            
            Swal.fire({
                title: titulo,
                text: texto,
                icon: icono,
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        });
    </script>
<?php elseif (isset($_GET['error'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al procesar la solicitud',
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        });
    </script>
<?php endif; ?>

<!-- 📋 TABLA CON DATATABLES Y PAGINACIÓN -->
<div class="table-responsive">
    <table id="tablaEstudiantes" class="table table-bordered table-hover" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>📷 Foto</th>
                <th>👤 Nombre</th>
                <th>🎂 Edad</th>
                <th>📚 Curso</th>
                <th>📧 Email</th>
                <th>📞 Teléfono</th>
                <th>⚙️ Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($e = $estudiantes->fetch_assoc()): ?>
            <tr>
                <td class="text-center">
                    <?php if (!empty($e['imagen']) && file_exists("../uploads/{$e['imagen']}")): ?>
                        <img 
                            src="../uploads/<?= $e['imagen'] ?>" 
                            width="50" height="50" 
                            class="rounded" 
                            style="object-fit: cover;">
                    <?php else: ?>
                        <span class="d-inline-block bg-light text-muted text-center border rounded" style="width: 50px; height: 50px; line-height: 50px; font-size: 16px;">
                            👤
                        </span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($e['nombre'] . ' ' . $e['apellido']) ?></td>
                <td><?= htmlspecialchars($e['edad']) ?></td>
                <td><?= htmlspecialchars($e['curso']) ?></td>
                <td><?= htmlspecialchars($e['email']) ?></td>
                <td><?= htmlspecialchars($e['telefono']) ?></td>
                <td>
                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarModal<?= $e['id'] ?>" title="Editar">
                            ✏️ Editar
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="eliminarEstudiante(<?= $e['id'] ?>)" title="Eliminar">
                            🗑️ Eliminar
                        </button>
                    </div>
                </td>
            </tr>

            <!-- 🧾 MODAL EDITAR -->
            <div class="modal fade" id="editarModal<?= $e['id'] ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <form method="POST" action="../controllers/estudianteController.php?action=editar" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            ✏️ Editar Estudiante
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $e['id'] ?>">
                        <input type="hidden" name="imagen_actual" value="<?= $e['imagen'] ?>">
                        <?php $estudiante = $e; include 'partials/form_estudiante.php'; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            💾 Actualizar
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            ❌ Cancelar
                        </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- ➕ MODAL CREAR -->
<div class="modal fade" id="crearModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="../controllers/estudianteController.php?action=crear" enctype="multipart/form-data">
        <div class="modal-header">
          <h5>
              👨‍🎓 Agregar Estudiante
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <?php $estudiante = []; include 'partials/form_estudiante.php'; ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                💾 Guardar
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                ❌ Cancelar
            </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script src="../assets/js/estudiantes.js"></script>

<?php include '../includes/footer.php'; ?>