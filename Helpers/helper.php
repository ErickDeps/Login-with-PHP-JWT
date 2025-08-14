<?php


function sessionValidateIn(string $secret_key)
{
    if (!empty($_COOKIE['token']) && verifyJWT($_COOKIE['token'], $secret_key)) {
        header('Location:' . URL_BASE . '?controller=dashboard/dashboard&action=home');
        exit;
    }
}

function sessionValidateOut(string $secret_key)
{
    if (empty($_COOKIE['token']) || !($data = verifyJWT($_COOKIE['token'], $secret_key))) {
        header('Location: ' . URL_BASE . '?controller=auth/login&action=login');
        exit;
    }

    return $data;
}
