<?php 
use Core\Database;
use Models\Articles;
use Models\CrudModel;

    require_once '../../../Core/Database.php';
    require_once '../../../Models/CrudModel.php';
    require_once '../../../Models/Articles.php';

    // Hier zou ook een aparte functie van gemaakt kunnen worden. Als je bijvoorbeeld ook een andere file upload wilt maken.
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
    // functie verwerkt de csv, controleert of de gegevens al bestaan in de database en voegt ze toe of update ze.
    // Deze functie ga ik dus nog opsplitsen in losse functies en OOP maken. -Bart
    function processCSV($filePath) {
        $handle = fopen($filePath, "r");

        if ($handle !== false) {
                // slaat de eerste regel van de csv over
                // Dit is de header regel, die we niet willen verwerken
                fgetcsv($handle, 0, ",");
            // Verwerk rijen van de CSV hierbij controleert die of er nog een record is in de csv
            while (($data = fgetcsv($handle, 0, ",")) !== false) {
                
                $tableName = "Articles";

                 // the ... is the splat operator. - The ... operator (argument unpacking) automatically passes each array element as a separate argument
                $articles = new Articles(...array_values($data));
                $articles = $articles->createAssociativeArray();
                // maak hier een functie van in Model Articles!!!
                // Check if the ArticleID exists in the database
                $exists = CrudModel::countRecords($tableName, $articles);
                
                if ($exists > 0) {
                    // Update existing row
                    CrudModel::updateData($tableName, $articles);
                } else {
                    CrudModel::createData($tableName, $articles);
            }}

            fclose($handle);

            header("Location: ../../products.php?lang=nl&upload=success");
         } 
        else {   
            header("Location: ../../products.php?lang=nl&upload=error");
        }
    }
