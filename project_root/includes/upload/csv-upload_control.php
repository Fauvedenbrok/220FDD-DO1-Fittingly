<?php 
    if (isset($_POST["upload"])) {
    if ($_FILES["csv_file"]["error"] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["csv_file"]["tmp_name"];
        $fileName = $_FILES["csv_file"]["name"];
        
        // Controleer of het een CSV-bestand is
        if (pathinfo($fileName, PATHINFO_EXTENSION) === 'csv') {
            processCSV($fileTmpPath);
        } else {
            echo "Ongeldig bestandstype. Upload een CSV-bestand.";
        }
    } else {
        echo "Fout bij uploaden.";
    }
    }

    function processCSV($filePath) {
        $handle = fopen($filePath, "r");

        if ($handle !== false) {
            try {
                require_once "../dbh.inc.php";
                } catch (PDOException $e) {
                    die("Databaseverbinding mislukt: " . $e->getMessage());
                }
    
            // Verwerk rijen van de CSV
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                // Voorbeeld: Stel dat je kolommen ID, Naam en Leeftijd hebt
                $id = $data[0];
                $name = $data[1];
                $age = $data[2];
    
                // Controleer of het ID bestaat in de database
                $sqlCheck = "SELECT * FROM table_name WHERE id = ?";
                $stmt = $conn->prepare($sqlCheck);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if ($result->num_rows > 0) {
                    // Update bestaande rij
                    $sqlUpdate = "UPDATE table_name SET name = ?, age = ? WHERE id = ?";
                    $updateStmt = $conn->prepare($sqlUpdate);
                    $updateStmt->bind_param("ssi", $name, $age, $id);
                    $updateStmt->execute();
                } else {
                    // Voeg nieuwe rij toe
                    $sqlInsert = "INSERT INTO table_name (id, name, age) VALUES (?, ?, ?)";
                    $insertStmt = $conn->prepare($sqlInsert);
                    $insertStmt->bind_param("iss", $id, $name, $age);
                    $insertStmt->execute();
                }
            }
    
            fclose($handle);
            echo "CSV-verwerking voltooid!";
        } else {
            echo "Kan het CSV-bestand niet openen.";
        }
    }