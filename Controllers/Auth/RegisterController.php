<?php

class RegisterController
{
    protected $secret_key;

    function __construct()
    {
        $this->secret_key = $_ENV['JWT_SECRET_KEY'];
    }

    public function register($connection)
    {
        sessionValidateIn($this->secret_key);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->registerPost($connection);
            return;
        }
        require './Views/Auth/register.view.php';
    }

    private function registerPost($connection)
    {
        $name = trim(mb_strtolower($_POST['name'] ?? ''));
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $email = strtolower($email);
        $password = $_POST['password'] ?? '';

        // Validaciones
        if ($name === '' || $email === '' || $password === '') {
            $error = 'Por favor rellena todos los campos.';
        } elseif (!preg_match('/^[\p{L}\s]{2,50}$/u', $name)) {
            $error = 'El nombre solo debe contener letras y espacios, entre 2 y 50 caracteres.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'El correo electrónico no es válido.';
        } elseif (strlen($email) > 100) {
            $error = 'El correo electrónico es demasiado largo.';
        } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
            $error = 'La contraseña debe tener al menos 8 caracteres, incluyendo letras y números.';
        }

        if (empty($error)) {
            require_once './Models/User/User.php';
            $userModel = new User();
            $user = $userModel->findUserByEmail($connection, $email);
            if ($user) {
                $error = 'El usuario ya existe.';
            }
        }


        if (!empty($error)) {
            require './Views/Auth/register.view.php';
            return;
        }

        $userModel->createUser($connection, $name, $email, $password);

        $success = 'Usuario registrado con éxito, redirigiendo...';
        $name = $email = $password = '';
        require './Views/Auth/register.view.php';
    }
}
