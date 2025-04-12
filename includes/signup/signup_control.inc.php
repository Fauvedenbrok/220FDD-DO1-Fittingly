<?php

declare(strict_types=1);

function is_input_empty(string $first_name, string $last_name, string $postal_code, string $street_name, string $house_nr, string $city, string $country, string $email, string $user_password) {
    	if (empty($first_name) || empty($last_name) || empty($postal_code) || empty($street_name) || empty($house_nr) || empty($city) || empty($country) || empty($email) || empty($user_password)) {
            return true;
        } else {
            return false;
        }
}

function is_email_invalid(string $email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}


function is_email_registered(object $pdo, string $email) {
    if(get_email($pdo , $email)){
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $first_name, string $last_name, string $phone_nr, string $dob, string $postal_code, string $street_name, string $house_nr, string $city, string $country, string $email, string $user_password) {
    set_user($pdo, $first_name, $last_name, $phone_nr, $dob, $postal_code, $street_name, $house_nr, $city, $country, $email, $user_password);
}