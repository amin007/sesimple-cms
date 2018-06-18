<?php

namespace App\Components;

use App\Components\Config;

class UrlHelper
{
    public static function base_url($url = null) {
        $base_url = Config::get('app')['base_url'];
        if ($url) {
            $url = ltrim($url, '/');
        }
        return $base_url . ($url ? "/{$url}" : '');
    }

    public static function redirect301($url, array $flash = []) {

        if ($flash) {
            self::setFlashSession($flash);
        }

        header("Location: {$url}", true, 301);
        exit();
    }

    public static function redirect302($url, array $flash = []) {

        if ($flash) {
            self::setFlashSession($flash);
        }

        header("Location: {$url}", true, 302);
        exit();
    }

    public static function redirect($url, array $flash = []) {

        if ($flash) {
            self::setFlashSession($flash);
        }

        header("Location: {$url}");
        exit();
    }

    public static function response404()
    {
        header('HTTP/1.0 404 Not Found');
        exit();
    }

    public static function setFlashSession(array $flash = [])
    {
        $_SESSION['flash'] = $flash;
        return $_SESSION;
    }

    public static function getFlashSessions()
    {
        if (!empty($_SESSION['flash'])) {
            return $_SESSION['flash'];
        }

        return [];
    }

    public static function getFlashSession($key = null)
    {
        $flash = self::getFlashSessions();
        
        if ($key && !empty($flash[$key])) {
            return $flash[$key];
        }

        return false;
    }

    public static function removeFlashSession()
    {
        if (!empty($_SESSION['flash'])) {
            unset($_SESSION['flash']);
        }
    }
}
