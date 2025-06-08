<?php

namespace Core;

class Validator {
    public static function isEmpty(array $data, array $required): bool {
        foreach ($required as $field) {
            if (empty($data[$field])) return true;
        }
        return false;
    }

    public static function isValidEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function is_password_wrong(string $userPassword, string $hashed_password) {
    if (!password_verify($userPassword,  $hashed_password)){
        return true;
    } else {
        return false;
    }
}
}
