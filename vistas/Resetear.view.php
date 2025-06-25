<?php
$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #13cdbd, #5a18ff);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        color: #343a40;
        line-height: 1.6;
    }

    .container {
        background-color: white;
        border-radius: 12px;
        width: 100%;
        max-width: 500px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #00A99D, #5a18ff);
    }

    .modify-title {
        text-align: center;
        font-size: 2.2rem;
        font-weight: 700;
        color: #00A99D;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .modify-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #00A99D, #5a18ff);
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 1.8rem;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 0.8rem;
        font-weight: 500;
        color: #343a40;
        font-size: 1.1rem;
    }

    .input-group-custom {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        color: #00A99D;
        font-size: 1.2rem;
        z-index: 2;
    }

    .form-control-custom {
        width: 100%;
        padding: 15px 20px 15px 55px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        font-family: 'Poppins', sans-serif;
        background-color: rgba(245, 245, 245, 0.5);
    }

    .form-control-custom:focus {
        border-color: #00A99D;
        box-shadow: 0 0 0 3px rgba(0, 169, 157, 0.2);
        outline: none;
        background-color: white;
    }

    .password-toggle {
        position: absolute;
        right: 18px;
        cursor: pointer;
        color: #6c757d;
        z-index: 3;
        font-size: 1.2rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .password-toggle:hover {
        color: #00A99D;
    }

    .password-checklist {
        background-color: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        margin: 25px 0;
        border: 1px solid #e9ecef;
    }

    .password-checklist p {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 15px;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .password-checklist p i {
        margin-right: 10px;
        color: #00A99D;
    }

    .password-checklist ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .password-checklist li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        color: #6c757d;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .password-checklist li i {
        margin-right: 10px;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .password-checklist li.valid {
        color: #2a9d8f;
    }

    .password-checklist li.valid i {
        color: #2a9d8f;
    }

    .btn-primary-custom {
        background: linear-gradient(to right, #00A99D, #5a18ff);
        border: none;
        border-radius: 12px;
        padding: 15px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        font-size: 1.1rem;
        color: white;
        width: 100%;
        margin-top: 15px;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 169, 157, 0.3);
    }

    .btn-primary-custom:active {
        transform: translateY(-1px);
    }

    .btn-primary-custom::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, #008f8f, #4a00e0);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        z-index: 1;
    }

    .btn-primary-custom:hover::after {
        opacity: 1;
    }

    .btn-primary-custom span {
        position: relative;
        z-index: 2;
    }

    .invalid-feedback {
        color: #008f8f;
        font-size: 0.9rem;
        margin-top: 8px;
        display: block;
        font-weight: 500;
    }

    .is-invalid {
        border-color: #2a9d8f !important;
    }

    .is-valid {
        border-color: #2a9d8f !important;
    }

    @media (max-width: 576px) {
        .container {
            padding: 30px 20px;
        }

        .modify-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
        }

        .form-control-custom {
            padding: 12px 15px 12px 45px;
        }

        .input-icon {
            left: 15px;
            font-size: 1rem;
        }
    }
</style>

<body>
    <div class="container">
        <header>
            <h1 class="modify-title">Recuperar Contraseña</h1>
        </header>
        <form action="../controladores/RecuperarHandler.php" method="POST">

            <input type="hidden" name="token" value="<?= $token ?>">
            <div class="form-group">

                <label for="password" class="form-label">Nueva Contraseña</label>
                <div class="input-group-custom">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control-custom" id="password" name="nuevaPass"
                        placeholder="Crea una contraseña segura" required>

                </div>

                <div class="form-group">
                    <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                    <div class="input-group-custom">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control-custom" id="confirmPassword"
                            name="confirmPassword" placeholder="Repite tu contraseña" required>
                    </div>
                    <div id="passwordError" class="invalid-feedback"></div>
                </div>

                <!-- Checklist de contraseña -->
                <div class="password-checklist">
                    <p><i class="fas fa-shield-alt"></i> Requisitos de la contraseña</p>
                    <ul>
                        <li id="check-length"><i class="far fa-circle"></i> Mínimo 8 caracteres</li>
                        <li id="check-uppercase"><i class="far fa-circle"></i> Al menos una mayúscula</li>
                        <li id="check-number"><i class="far fa-circle"></i> Al menos un número</li>
                        <li id="check-symbol"><i class="far fa-circle"></i> Al menos un símbolo especial</li>
                    </ul>
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn-primary-custom" name="cambiar">
                    <span>Actualizar Contraseña</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        // Validar criterios de la contraseña
        const passwordInput = document.getElementById('password');
        const criteria = {
            length: document.getElementById('check-length'),
            uppercase: document.getElementById('check-uppercase'),
            number: document.getElementById('check-number'),
            symbol: document.getElementById('check-symbol')
        };

        passwordInput.addEventListener('input', function() {
            const value = passwordInput.value;

            // Validar longitud
            if (value.length >= 8) {
                criteria.length.querySelector('i').className = 'fas fa-check-circle';
                criteria.length.classList.add('valid');
            } else {
                criteria.length.querySelector('i').className = 'far fa-circle';
                criteria.length.classList.remove('valid');
            }

            // Validar mayúscula
            if (/[A-Z]/.test(value)) {
                criteria.uppercase.querySelector('i').className = 'fas fa-check-circle';
                criteria.uppercase.classList.add('valid');
            } else {
                criteria.uppercase.querySelector('i').className = 'far fa-circle';
                criteria.uppercase.classList.remove('valid');
            }

            // Validar número
            if (/\d/.test(value)) {
                criteria.number.querySelector('i').className = 'fas fa-check-circle';
                criteria.number.classList.add('valid');
            } else {
                criteria.number.querySelector('i').className = 'far fa-circle';
                criteria.number.classList.remove('valid');
            }

            // Validar símbolo
            if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
                criteria.symbol.querySelector('i').className = 'fas fa-check-circle';
                criteria.symbol.classList.add('valid');
            } else {
                criteria.symbol.querySelector('i').className = 'far fa-circle';
                criteria.symbol.classList.remove('valid');
            }
        });

        // Validar que las contraseñas coincidan
        confirmPassword.addEventListener('input', function() {
            if (password.value !== confirmPassword.value) {
                document.getElementById('passwordError').textContent = 'Las contraseñas no coinciden';
                confirmPassword.classList.add('is-invalid');
            } else {
                document.getElementById('passwordError').textContent = '';
                confirmPassword.classList.remove('is-invalid');
            }
        });
    </script>
</body>

</html>