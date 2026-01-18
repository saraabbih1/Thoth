<?php

class Auth
{
    public static function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function checkCsrfToken($token)
    {
        return isset($_SESSION['csrf_token'])
            && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function check()
    {
        return isset($_SESSION['student_id']);
    }

    public static function login($student_id)
    {
        $_SESSION['student_id'] = $student_id;
    }

    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}
