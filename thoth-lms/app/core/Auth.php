<?php

class Auth
{
    public static function check()
    {
        session_start();
        return isset($_SESSION['student_id']);
    }

    public static function login($student_id)
    {
        session_start();
        $_SESSION['student_id'] = $student_id;
    }

    public static function logout()
    {
        session_start();
        session_destroy();
    }
}
