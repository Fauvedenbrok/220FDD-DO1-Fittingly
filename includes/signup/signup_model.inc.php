<?php

declare(strict_types=1); //Hiermee wordt het declaren van datatypes afgedwongen. Wanneer informatie bijvoorbeeld verkeerd wordt ingevoerd aan de gebruikerskant, zal PHP een error geven omdat het een vooraf bepaald datatype verwacht. Als je dit niet vooraf declareerd, kan PHP je datatypes automatisch "corrigeren" waardoor je foutieve data in je database krijgt

function get_email(object $pdo , string $email) {
    $query = "SELECT EmailAddress FROM useraccounts WHERE EmailAddress = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(
    object $pdo, 
    string $first_name, 
    string $last_name, 
    string $phone_nr, 
    string $dob, 
    string $postal_code, 
    string $street_name, 
    string $house_nr, 
    string $city, 
    string $country, 
    string $email, 
    string $user_password) 
    {
        try {
            // Begin a transaction
            $pdo->beginTransaction();

            $useraccountQuery = "INSERT INTO useraccounts (EmailAddress, UserPassword, PhoneNumber) 
                                VALUES (:email, :user_password, :phone_nr);";
            $stmt = $pdo->prepare($useraccountQuery);

            $options = [
                'cost' => 12
            ];
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, $options);

            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":user_password", $hashed_password);
            $stmt->bindParam(":phone_nr", $phone_nr);
            $stmt->execute();

            $addressQuery = "INSERT INTO addresses (PostalCode, HouseNumber, StreetName, City, Country) 
                            VALUES (:postal_code, :house_nr, :street_name, :city, :country);";
            $stmt = $pdo->prepare($addressQuery);

            $stmt->bindParam(":postal_code", $postal_code);
            $stmt->bindParam(":house_nr", $house_nr);
            $stmt->bindParam(":street_name", $street_name);
            $stmt->bindParam(":city", $city);
            $stmt->bindParam(":country", $country);
            $stmt->execute();

            $customerQuery = "INSERT INTO customers (FirstName, LastName, DateOfBirth, PostalCode, HouseNumber) 
                            VALUES (:first_name, :last_name, :dob, :postal_code, :house_nr);";
            $stmt = $pdo->prepare($customerQuery);

            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":last_name", $last_name);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":postal_code", $postal_code);
            $stmt->bindParam(":house_nr", $house_nr);
            $stmt->execute();

            $customerId = $pdo->lastInsertId();

            $updateUserAccountQuery = "UPDATE useraccounts SET CustomerID = :customer_id WHERE EmailAddress = :email;";
            $stmt = $pdo->prepare($updateUserAccountQuery);
            $stmt->bindParam(":customer_id", $customerId);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            // Commit the transaction
            $pdo->commit();
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $pdo->rollBack();
            throw $e;
        }
    }