<?php
class DashboardController
{
    protected $secret_key;

    public function __construct()
    {
        $this->secret_key = $_ENV['JWT_SECRET_KEY'];
    }

    function home($connection)
    {
        $data = sessionValidateOut($this->secret_key);

        $user_name  = ucfirst($data->user);
        $user_email = $data->email;
        $user_rol   = $data->rol;

        require_once './views/Dashboard/home.view.php';
    }

    function logout()
    {
        setcookie("token", "", [
            'expires'  => time() - 3600,
            'path'     => '/',
            'secure'   => false, // true en HTTPS
            'httponly' => true,
            'samesite' => 'Strict'
        ]);

        header('Location: ' . URL_BASE . '?controller=auth/login&action=login');
        exit;
    }
}
