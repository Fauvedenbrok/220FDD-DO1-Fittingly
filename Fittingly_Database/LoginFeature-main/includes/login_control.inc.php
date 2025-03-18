<?php

declare(strict_types=1);

function is_input_empty(string $email, string $user_password) {
    if (empty($email) || empty($user_password)) {
        return true;
    } else {
        return false;
    }
}

function is_useremail_wrong(bool|array $result) {
    if (!$result){
        return true;
    } else {
        return false;
    }
}

function is_password_wrong(string $user_password, string $hashed_password) {
    if (!password_verify($user_password,  $hashed_password)){
        return true;
    } else {
        return false;
    }
}