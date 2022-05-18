<?php
include_once (sprintf("%s/logic/ExpiredSessionException.php", $_SERVER["DOCUMENT_ROOT"]));

class Session
{
    protected static $SESSION_AGE = 1800;

    /**
     * @throws ExpiredSessionException
     * @throws Exception
     */
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
        if (empty($_SESSION[$key]) || $_SESSION[$key] == '')
        {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @throws ExpiredSessionException
     * @throws Exception
     */
    public static function read($key)
    {
        if ( !is_string($key) ) {
            throw new Exception('Session key must be string value');
        }
        self::_init();
        if (isset($_SESSION[$key]))
        {
            self::_age();
            return $_SESSION[$key];
        }
        return false;
    }

    /**
     * @throws ExpiredSessionException
     * @throws Exception
     */
    public static function delete($key)
    {
        if ( !is_string($key) )
        {
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

    /**
     * @throws ExpiredSessionException
     */
    private static function _age()
    {
        $last = $_SESSION['LAST_ACTIVE'] ?? false;

        if (false !== $last && (time() - $last > self::$SESSION_AGE))
        {
            self::destroy();
            throw new ExpiredSessionException();
        }
        $_SESSION['LAST_ACTIVE'] = time();
    }

    public static function close(): bool
    {
        if ( '' !== session_id() )
        {
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
        if ( '' !== session_id() )
        {
            $_SESSION = array();
            session_destroy();
        }
    }

    private static function _init(): bool
    {
        if ( '' === session_id() )
        {
            return session_start();
        }
        return session_regenerate_id(true);
    }

}