<?php

namespace Core;

/**
 * Class Session
 *
 * Provides static methods for managing PHP session data.
 * Includes methods to start a session, set/get/remove session variables, check existence, and destroy the session.
 */
class Session {
    /**
     * Starts the session if it is not already started.
     *
     * @return void
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Sets a session variable.
     *
     * @param string $key The session variable name.
     * @param mixed $value The value to store.
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Retrieves a session variable by key.
     *
     * @param string $key The session variable name.
     * @return mixed The value of the session variable, or null if not set.
     */
    public static function get(string $key): mixed
    {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    /**
     * Checks if a session variable exists.
     *
     * @param string $key The session variable name.
     * @return bool True if the session variable exists, false otherwise.
     */
    public static function exists(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    /**
     * Removes a session variable.
     *
     * @param string $key The session variable name.
     * @return void
     */
    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Destroys the current session.
     *
     * @return void
     */
    public static function destroy(): void
    {
        self::start();
        session_destroy();
    }
}