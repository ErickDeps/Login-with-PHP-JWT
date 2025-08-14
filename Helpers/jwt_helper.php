<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

function createJWT(array $payload, string $secret_key, int $ttl = 3600): String
{
    $payload['exp'] = time() + $ttl;
    return JWT::encode($payload, $secret_key, 'HS256');
}

function verifyJWT(string $token, string $secret_key): mixed
{
    try {
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
        return $decoded;
    } catch (ExpiredException $e) {
        // Token expirado
        return false;
    } catch (SignatureInvalidException $e) {
        // Firma inválida (token manipulado)
        return false;
    } catch (Exception $e) {
        return false;
    }
}
