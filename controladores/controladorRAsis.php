<?php
require '../modelo/modeloRegisAsis.php';

class RegistroController
{
    public function mostrarFormulario()
    {
        // Mostrar mensaje de éxito si existe
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            $mensajeExito = 'Cliente registrado exitosamente';
        }

        // Incluir la vista
                require '../vistas/registroAsis.view.php';
    }

    public function procesarRegistro()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar datos
            $errores = $this->validarDatos($_POST);
            // Inicializar variable para mensajes de error
            $errorGeneral = '';
            if (!empty($errores)) {
                echo "Hay errores en el formulario " . print_r($errores);
                // Mostrar formulario con errores
                require '../vistas/registroAsis.view.php';
                return;
            }

            try {
                $modelo = new UsuarioModel();
                $resultado = $modelo->registrarUsuario($_POST);

                if ($resultado['success']) {
                    // Redirigir para evitar reenvío del formulario
                    header('Location: controladorRAsis.php?action=mostrarFormulario&success=1');
                    exit;
                } else {
                    // Mostrar error específico
                    $errorGeneral = $resultado['message'];
                require '../vistas/registroAsis.view.php';
                }
            } catch (Exception $e) {
                $errorGeneral = "Error en el servidor: " . $e->getMessage();
                require '../vistas/registroAsis.view.php';
            }
        } else {
            // Si no es POST, redirigir al formulario
            header('Location: controladorRAsis.php?action=mostrarFormulario');
            exit;
        }
    }

    private function validarDatos($datos)
    {
        $errores = [];

        // Validar email
        if (empty($datos['email']) || !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'Por favor, ingrese un correo electrónico válido';
        }

        // Validar teléfono
        if (empty($datos['phone']) || !preg_match('/^[0-9]{10}$/', $datos['phone'])) {
            $errores['phone'] = 'El teléfono debe tener exactamente 10 dígitos numéricos';
        }

        // Validar contraseñas
        if (empty($datos['password']) || strlen($datos['password']) < 8) {
            $errores['password'] = 'La contraseña debe tener al menos 8 caracteres';
        } elseif ($datos['password'] !== $datos['confirmPassword']) {
            $errores['confirmPassword'] = 'Las contraseñas no coinciden';
        }

        // Validar nombres
        if (empty($datos['firstName'])) {
            $errores['firstName'] = 'El nombre es requerido';
        }
        if (empty($datos['lastName'])) {
            $errores['lastName'] = 'El apellido paterno es requerido';
        }
        if (empty($datos['motherLastName'])) {
            $errores['motherLastName'] = 'El apellido materno es requerido';
        }

        // Validar género
        if (empty($datos['gender']) || !in_array($datos['gender'], ['male', 'female', 'other'])) {
            $errores['gender'] = 'Seleccione un género válido';
        }

        // Validar fecha de nacimiento
        if (empty($datos['birthdate'])) {
            $errores['birthdate'] = 'La fecha de nacimiento es requerida';
        } else {
            $birthdate = new DateTime($datos['birthdate']);
            $today = new DateTime();
            $age = $today->diff($birthdate)->y;

            if ($age < 18) {
                $errores['birthdate'] = 'El cliente debe ser mayor de 18 años';
            }
        }

        return $errores;
    }
}

// Punto de entrada del controlador
$action = $_GET['action'] ?? 'mostrarFormulario';
$controller = new RegistroController();

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Página no encontrada";
    exit;
}
