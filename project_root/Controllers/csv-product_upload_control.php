<?php 
use Core\Database;
use Models\Articles;
use Models\CrudModel;

    require_once '../Core/Database.php';
    require_once '../Models/CrudModel.php';
    require_once '../Models/Articles.php';

    /**
     * Handles the CSV upload and processing if the form is submitted.
     */
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

    /**
     * Detects the delimiter used in a CSV file by checking the first line.
     *
     * @param string $filePath The path to the CSV file.
     * @return string The detected delimiter (default is comma).
     */
    function detectCsvDelimiter($filePath) {
        $delimiters = [",", ";", "\t", "|"];
        $handle = fopen($filePath, "r");
        $firstLine = fgets($handle);
        fclose($handle);

        $maxCount = 0;
        $delimiter = ",";
        foreach ($delimiters as $d) {
            $count = substr_count($firstLine, $d);
            if ($count > $maxCount) {
                $maxCount = $count;
                $delimiter = $d;
            }
        }
        return $delimiter;
    }

    /**
     * Processes a CSV file: checks if each record exists in the database and updates or inserts accordingly.
     *
     * @param string $filePath The path to the uploaded CSV file.
     * @return void
     */
    // functie verwerkt de csv, controleert of de gegevens al bestaan in de database en voegt ze toe of update ze.
    // Deze functie ga ik dus nog opsplitsen in losse functies en OOP maken. -Bart
    function processCSV($filePath) {
        try {
            // Detecteer de delimiter van de CSV
            $delimiter = detectCsvDelimiter($filePath);
        } catch (Exception $e) {
            header("Location: ../../public_html/admin/products.php?lang=nl&upload=error");
            exit;
        }


        $handle = fopen($filePath, "r");
        if ($handle !== false) {
                // slaat de eerste regel van de csv over
                // Dit is de header regel, die we niet willen verwerken
                fgetcsv($handle, 0, $delimiter);
            // Verwerk rijen van de CSV hierbij controleert die of er nog een record is in de csv
            while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
                
                $tableName = "Articles";

                 // the ... is the splat operator. - The ... operator (argument unpacking) automatically passes each array element as a separate argument
                $articles = new Articles(...array_values($data));
                $articles = $articles->createAssociativeArray();
                // maak hier een functie van in Model Articles!!!
                // Check if the ArticleID exists in the database
                $exists = CrudModel::checkRecordExists($tableName, $articles);
                
                if ($exists > 0) {
                    // Update existing row
                    CrudModel::updateData($tableName, $articles);
                } else {
                    // Insert new row
                    CrudModel::createData($tableName, $articles);
            }}

            fclose($handle);

            header("Location: ../../public_html/admin/products.php?lang=nl&upload=success");
         } 
        else {   
            header("Location: ../../public_html/admin/products.php?lang=nl&upload=error");
        }
    }
