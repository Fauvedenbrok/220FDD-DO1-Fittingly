<?php

declare(strict_types=1); //Hiermee wordt het declaren van datatypes afgedwongen. Wanneer informatie bijvoorbeeld verkeerd wordt ingevoerd aan de gebruikerskant, zal PHP een error geven omdat het een vooraf bepaald datatype verwacht. Als je dit niet vooraf declareerd, kan PHP je datatypes automatisch "corrigeren" waardoor je foutieve data in je database krijgt
function get_user(object $pdo , string $email) {
    $query = "SELECT * FROM useraccounts WHERE EmailAddress = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
