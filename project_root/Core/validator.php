<?php

namespace Core;

/**
 * Class Validator
 *
 * Provides static methods for validating form data, such as checking for empty fields,
 * validating email addresses, and verifying passwords.
 */
class Validator {
    /**
     * Checks if any of the required fields are empty in the provided data array.
     *
     * @param array $data The associative array of form data.
     * @param array $required The list of required field names.
     * @return bool True if any required field is empty, false otherwise.
     */
    public static function isEmpty(array $data, array $required): bool {
        foreach ($required as $field) {
            if (empty($data[$field])) return true;
        }
        return false;
    }

    /**
     * Validates whether the given string is a valid email address.
     *
     * @param string $email The email address to validate.
     * @return bool True if the email is valid, false otherwise.
     */
    public static function isValidEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Checks if the provided password does not match the hashed password.
     *
     * @param string $userPassword The plain text password entered by the user.
     * @param string $hashed_password The hashed password from the database.
     * @return bool True if the password is incorrect, false if it matches.
     */
    public function is_password_wrong(string $userPassword, string $hashed_password) {
    if (!password_verify($userPassword,  $hashed_password)){
        return true;
    } else {
        return false;
    }
}
}
