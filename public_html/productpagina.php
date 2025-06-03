<?php
/** Laad de vertaler in en zet 'm klaar. */
require_once 'Lang/translator.php';
$translator = init_translator();

/** Activeer klassen via namespaces.
 * @use: zorgt dat je klassen kunt gebruiken uit andere mappen via namespaces.
 * @CrudModel: klasse voor Create, Read, Update, Delete acties.
 * @DataBase: klasse voor database connecties.
 */
use Models\CrudModel;
use Core\DataBase;

require_once '../project_root/Models/CrudModel.php';
require_once '../project_root/Core/Database.php';

/** Checkt of er een zoekwoord is meegegeven via de URL en dat het niet leeg is.
 * @isset($_GET['zoekwoord'])   Controleert of de parameter 'zoekwoord' bestaat in de URL.
 * @!empty($_GET['zoekwoord'])  Controleert of de parameter niet leeg is (geen "", 0, null, enz.).
 * @searchword: de zoekterm die de gebruiker heeft ingevoerd.
 * @tableName: de naam van de database tabel waar zoekwoorden worden opgeslagen.
*/
if (isset($_GET['zoekwoord']) && !empty($_GET['zoekwoord'])) {
    $searchword = $_GET['zoekwoord'];
    $tableName = "searchlog";

    /** Check of het zoekwoord al in de DB staat.
     * @stmt: SQL query klaarzetten.
     * @row: resultaat van de query, bevat de huidige Count van het zoekwoord.
     */
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT Count FROM $tableName WHERE SearchWord = ?");
    $stmt->execute([$searchword]);
    $row = $stmt->fetch();

    if ($row) {
        /** Zoekwoord bestaat, verhoog Count met 1.*/
        $stmt = $pdo->prepare("UPDATE $tableName SET Count = Count + 1 WHERE SearchWord = ?");
        $stmt->execute([$searchword]);
    } else {
        /** Zoekwoord bestaat niet, voeg toe (Count krijgt automatisch de waarde 1). */
        $stmt = $pdo->prepare("INSERT INTO $tableName (SearchWord, Count) VALUES (?, 1)");
        $stmt->execute([$searchword]);
    }
}

/** Laad de controller en haal de data op */
$data = require_once __DIR__ . '/../project_root/Controllers/product_list_controller.php';

/** Zet de variabelen uit de controller om aar losse variabelen. */
extract($data);

/** Laad de view (HTML weergave). */
require_once __DIR__ . '/views/product_list_view.php';
