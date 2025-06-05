<?php
/** Importeer namespaces voor database en artikelenrepository.YOOOOO
 * @use Core\Database                      Verantwoordelijk voor de PDO-verbinding.
 * @use Repositories\ArticlesRepository    Beheert ophalen van artikeldata uit de database.
 */
use Core\Database;
use Repositories\ArticlesRepository;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';


/** Initialiseer databaseverbinding en repository voor artikeldata.
 * @Database $db                Instantie van de databaseklasse.
 * @PDO $pdo                    De daadwerkelijke databaseverbinding.
 * @ArticlesRepository $articlesRepo  Repository die artikel-methodes bevat.
 */
$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);

/** Haal artikel-ID op uit de URL (GET-parameter).
 * @int $id             Gecast naar integer, fallback = 0 als ID ontbreekt.
 * @$_GET['id']         Parameter uit de URL (?id=123).
 * @?? 0                Null coalescing: geeft 0 als ID ontbreekt.
 */
$id = (int) ($_GET['id'] ?? 0);

<<<<<<< HEAD

=======
/** Als ID niet geldig is (0), geef een lege array terug.
 * @!$id           Controleert of ID 0 of ongeldig is.
 * @ return array  Lege array als failsafe voor de view.
 */
>>>>>>> 29cf47f163f21e045e841c24b7b7c19362db2aa9
if (!$id) {
    return []; 
}

/** Haal artikel op via ID met behulp van de repository.
 * @object|false $artikel   Het opgehaalde artikelobject of false als niet gevonden.
 * @findById(int $id)       Methode die een specifiek artikel ophaalt.
 */
$artikel = $articlesRepo->findById($id);

/** Als het artikel niet bestaat, return lege array (errorhandling).
 * @!$artikel    Controle op fout of leeg resultaat.
 * @ return array Leeg als artikel niet gevonden is.
 */
if (!$artikel) {
    return []; 
}

/** Genereert CSS-classnaam gebaseerd op de categorie van het artikel.
 * @getArticleCategory()            Methode op artikelobject.
 * @str_replace(' ', '-', ...)      Vervangt spaties met koppeltekens.
 * @strtolower(...)                 Maakt de string lowercase voor CSS-doeleinden.
 * @$categorieClass                 CSS-ready string zoals 'mannen-accessoires'.
 */
$categorieClass = strtolower(str_replace(' ', '-', $artikel->getArticleCategory()));

/** Retourneert artikeldata en bijbehorende CSS-class naar de view.
 * @ return array
 *     'artikel' => artikelobject,
 *     'categorieClass' => string (bv. "vrouwenkleding")
 */
return [
    'artikel' => $artikel,
    'categorieClass' => $categorieClass
];
