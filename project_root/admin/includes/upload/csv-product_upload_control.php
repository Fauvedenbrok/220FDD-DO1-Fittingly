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
                // slaat de eerste regel van de csv over
                // Dit is de header regel, die we niet willen verwerken
                fgetcsv($handle, 1000, ",");

    
            // Verwerk rijen van de CSV hierbij controleert die of er nog een record is in de csv
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
    // pakt regel uit CSV data
    $id = $data[0];
    $name = $data[1];
    $size = $data[2];
    $weight = $data[3];
    $weightUnit = $data[4]; // Matches `WeightUnit`
    $color = $data[5];
    $description = $data[6];
    $image = $data[7]; // Assuming base64 or file path handling
    $category = $data[8];
    $subcategory = $data[9];
    $material = $data[10];
    $brand = $data[11];
    $availability = filter_var($data[12], FILTER_VALIDATE_BOOLEAN); // Ensuring boolean type

    // Check if the ArticleID exists in the database
    $sqlCheck = "SELECT COUNT(*) FROM Articles WHERE ArticleID = :id";
    $stmt = $pdo->prepare($sqlCheck);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        // Update existing row
        $sqlUpdate = "UPDATE Articles SET 
            Name = :name, 
            Size = :size, 
            Weight = :weight, 
            WeightUnit = :weightUnit, 
            Color = :color, 
            Description = :description, 
            Image = :image, 
            Category = :category, 
            SubCategory = :subcategory, 
            Material = :material, 
            Brand = :brand, 
            Availability = :availability  
            WHERE ArticleID = :id";
        
        $updateStmt = $pdo->prepare($sqlUpdate);
        $updateStmt->bindParam(":id", $id, PDO::PARAM_INT);
        $updateStmt->bindParam(":name", $name);
        $updateStmt->bindParam(":size", $size);
        $updateStmt->bindParam(":weight", $weight, PDO::PARAM_STR);
        $updateStmt->bindParam(":weightUnit", $weightUnit);
        $updateStmt->bindParam(":color", $color);
        $updateStmt->bindParam(":description", $description);
        $updateStmt->bindParam(":image", $image, PDO::PARAM_LOB); // Assuming BLOB handling
        $updateStmt->bindParam(":category", $category);
        $updateStmt->bindParam(":subcategory", $subcategory);
        $updateStmt->bindParam(":material", $material);
        $updateStmt->bindParam(":brand", $brand);
        $updateStmt->bindParam(":availability", $availability, PDO::PARAM_BOOL);
        $updateStmt->execute();
    } else {
        // Insert new row
        $sqlInsert = "INSERT INTO Articles (Name, Size, Weight, WeightUnit, 
            Color, Description, Image, Category, SubCategory, 
            Material, Brand, Availability) 
            VALUES (:name, :size, :weight, :weightUnit, :color, 
            :description, :image, :category, :subcategory, :material, 
            :brand, :availability)";
        
        $insertStmt = $pdo->prepare($sqlInsert);
        $insertStmt->bindParam(":name", $name);
        $insertStmt->bindParam(":size", $size);
        $insertStmt->bindParam(":weight", $weight, PDO::PARAM_STR);
        $insertStmt->bindParam(":weightUnit", $weightUnit);
        $insertStmt->bindParam(":color", $color);
        $insertStmt->bindParam(":description", $description);
        $insertStmt->bindParam(":image", $image, PDO::PARAM_LOB); // Assuming BLOB handling
        $insertStmt->bindParam(":category", $category);
        $insertStmt->bindParam(":subcategory", $subcategory);
        $insertStmt->bindParam(":material", $material);
        $insertStmt->bindParam(":brand", $brand);
        $insertStmt->bindParam(":availability", $availability, PDO::PARAM_BOOL);
        $insertStmt->execute();
    }
}

fclose($handle);
echo "CSV processing completed successfully!";
        } else {
            echo "Kan het CSV-bestand niet openen.";
        }
    }