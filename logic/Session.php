<?php
include_once (sprintf("%s/logic/ExpiredSessionException.php", $_SERVER["DOCUMENT_ROOT"]));

class Session
{
    protected static $SESSION_AGE = 1000;

    public static function write($key, $value)
    {
        if ( !is_string($key) ) {
            throw new Exception('Session key must be string value');
        }
        self::_init();
        $_SESSION[$key] = $value;
        self::_age();
        return $value;
    }

    public static function isSet($key): bool
    {
        if (empty($_SESSION[$key]) || $_SESSION[$key] == '') {
            return false;
        } else {
            return true;
        }
    }

    public static function read($key)
    {
        if ( !is_string($key) ) {
            throw new Exception('Session key must be string value');
        }
        self::_init();
        if (isset($_SESSION[$key])) {
            self::_age();
            return $_SESSION[$key];
        }
        return false;
    }

    public static function delete($key)
    {
        if ( !is_string($key) ) {
            throw new Exception('Session key must be string value');
        }
        self::_init();
        unset($_SESSION[$key]);
        self::_age();
    }

    public static function dump()
    {
        self::_init();
        echo nl2br(print_r($_SESSION));
    }

    public static function start(): bool
    {
        return self::_init();
    }

    private static function _age()
    {
        $last = $_SESSION['LAST_ACTIVE'] ?? false;

        if (false !== $last && (time() - $last > self::$SESSION_AGE)) {
            self::destroy();
            throw new ExpiredSessionException();
        }
        $_SESSION['LAST_ACTIVE'] = time();
    }

    public static function close(): bool
    {
        if ( '' !== session_id() ) {
            return session_write_close();
        }
        return true;
    }

    public static function commit(): bool
    {
        return self::close();
    }

    public static function destroy()
    {
        if (session_id() !== '') {
            $_SESSION = array();
            session_destroy();
        }
    }

    public static function status_dump(){
        if(session_status() == 0) {
            print '<br> STATUS DISABLED <br>';
        }

        if(session_status() == 1) {
            print '<br> STATUS NAN <br>';
        }

        if(session_status() == 2) {
            print '<br> STATUS ACTIVE <br>';
        }
    }

    private static function _init(): bool
    {
        if (session_id() === '') {
            return session_start();
        }

        if(session_status() !== 2) {
            session_start();
        }

        return session_regenerate_id(true);
    }

}