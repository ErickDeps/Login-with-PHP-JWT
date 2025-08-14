<?php
class LoginController
{
    protected $secret_key;

    public function __construct()
    {
        $this->secret_key = $_ENV['JWT_SECRET_KEY'];
    }

    function login($connection)
    {
        sessionValidateIn($this->secret_key);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->loginPost($connection);
            return;
        }

        require_once './Views/Auth/login.view.php';
    }

    function loginPost($connection)
    {
        $email    = trim($_POST['email'] ?? '');
        $email    = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email    = mb_strtolower($email);
        $password = $_POST['password'] ?? '';
        $error    = '';

        if (empty($email) || empty($password)) {
            $error = 'Por favor rellena todos los campos.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'El correo electrónico no es válido';
        }

        if (empty($error)) {
            require_once './Models/User/User.php';
            $userModel = new User();
            $user = $userModel->findUserByEmail($connection, $email);

            if ($user && password_verify($password, $user['password'])) {

                $payload = [
                    "user"  => $user['name'],
                    "email" => $user['email'],
                    "rol"   => "admin"
                ];

                // Crear token 
                $jwt = createJWT($payload, $this->secret_key);

                // Guardar en cookie segura
                setcookie("token", $jwt, [
                    'expires'  => time() + 3600,
                    'path'     => '/',
                    'secure'   => false, // Cambiar a true en HTTPS
                    'httponly' => true,
                    'samesite' => 'Strict'
                ]);

                header('Location: ' . URL_BASE . '?controller=dashboard/dashboard&action=home');
                exit;
            } else {
                $error = 'Credenciales incorrectas';
            }
        }

        require_once './Views/Auth/login.view.php';
    }
}
