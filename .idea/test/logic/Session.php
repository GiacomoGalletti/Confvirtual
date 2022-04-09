<?php

class Session
{
    protected static $SESSION_AGE = 1800;

    public static function write($key, $value)
    {
        if ( !is_string($key) ) {
            throw new InvalidArgumentTypeException('Session key must be string value');
        }
        self::_init();
        $_SESSION[$key] = $value;
        self::_age();
        return $value;
    }

    public static function isSet($key){
        if (empty($_SESSION[$key]) || $_SESSION[$key] == '' || !isset($_SESSION[$key]))
        {
            return false;
        } else {
            return true;
        }
    }

    public static function read($key)
    {
        if ( !is_string($key) ) {
            throw new InvalidArgumentTypeException('Session key must be string value');
        }
        self::_init();
        if (isset($_SESSION[$key]))
        {
            self::_age();
            return $_SESSION[$key];
        }
        return false;
    }

    public static function delete($key)
    {
        if ( !is_string($key) )
        {
            throw new InvalidArgumentTypeException('Session key must be string value');
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

    public static function start()
    {
        return self::_init();
    }

    private static function _age()
    {
        $last = isset($_SESSION['LAST_ACTIVE']) ? $_SESSION['LAST_ACTIVE'] : false ;

        if (false !== $last && (time() - $last > self::$SESSION_AGE))
        {
            self::destroy();
            throw new ExpiredSessionException();
        }
        $_SESSION['LAST_ACTIVE'] = time();
    }

    public static function close()
    {
        if ( '' !== session_id() )
        {
            return session_write_close();
        }
        return true;
    }

    public static function commit()
    {
        return self::close();
    }

    public static function destroy()
    {
        if ( '' !== session_id() )
        {
            $_SESSION = array();
            session_destroy();
        }
    }

    private static function _init()
    {
        if (function_exists('session_status'))
        {
            if (session_status() == PHP_SESSION_DISABLED)
                throw new SessionDisabledException();
        }
        if ( '' === session_id() )
        {
            $secure = true;
            $httponly = true;
            return session_start();
        }
        return session_regenerate_id(true);
    }

}