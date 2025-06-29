<?php

use PHPUnit\Framework\TestCase;
use Core\Validator;


class ValidatorTest extends TestCase
{
    public function testIsEmptyReturnsTrueWhenFieldIsEmpty()
    {
        $data = ['email' => '', 'password' => 'secret'];
        $required = ['email', 'password'];
        $this->assertTrue(Validator::isEmpty($data, $required));
    }

    public function testIsEmptyReturnsFalseWhenAllFieldsAreFilled()
    {
        $data = ['email' => 'user@example.com', 'password' => 'secret'];
        $required = ['email', 'password'];
        $this->assertFalse(Validator::isEmpty($data, $required));
    }

    public function testIsValidEmailReturnsTrueForValidEmail()
    {
        $this->assertTrue(Validator::isValidEmail('test@example.com'));
    }

    public function testIsValidEmailReturnsFalseForInvalidEmail()
    {
        $this->assertFalse(Validator::isValidEmail('invalid-email'));
    }

    public function testIsPasswordWrongReturnsFalseForCorrectPassword()
    {
        $password = 'MyPassword123!';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $validator = new Validator();
        $this->assertFalse($validator->is_password_wrong($password, $hash));
    }

    public function testIsPasswordWrongReturnsTrueForIncorrectPassword()
    {
        $password = 'MyPassword23!';
        $wrongPassword = 'WrongPassword!';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $validator = new Validator();
        $this->assertTrue($validator->is_password_wrong($wrongPassword, $hash));
    }
}

