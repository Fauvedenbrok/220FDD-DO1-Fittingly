<?php
/** Laadt de vereiste namespaces voor databaseconnectie en artikelrepository.
 * @use Core\Database               Klasse voor PDO databaseconnectie.
 * @use Repositories\ArticlesRepository Repository voor ophalen/filteren van artikelen.
 */
use Core\Database;
use Repositories\ArticlesRepository;

require_once __DIR__ . '/../../public_html/Lang/translator.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';

$translator = init_translator();

/** Setup van databaseconnectie en repository.
 * @db Database object              Eigen instantie van de databaseklasse.
 * @pdo PDO object                  Actieve databaseverbinding via $db->getConnection().
 * @articlesRepo ArticlesRepository object  Repository die artikeldata uit de DB haalt.
 */
$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);

/** Ophalen van zoekfilters uit de URL (GET parameters).
 * @zoekwoord string        Zoekterm ingevoerd door gebruiker (leeg als niet ingevuld).
 * @categorie string        Geselecteerde categorie uit dropdown (leeg als niet geselecteerd).
 * @?? operator             Null coalescing: als $_GET['...'] niet bestaat, geef dan ''.
 */
$zoekwoord = $_GET['zoekwoord'] ?? '';
$categorie = $_GET['categorie'] ?? '';

/** Ophalen van gefilterde artikelen met behulp van de repository.
 * @artikelen array         Resultaat van de zoekopdracht (lijst met artikelobjecten).
 * @findAll(string, string) Methode uit ArticlesRepository die zoekt op zoekwoord en categorie.
 */
$artikelen = $articlesRepo->findAll($zoekwoord, $categorie);

/** Retourneert alle data naar de view in een associatieve array.
 * @ return array
 *     'artikelen' => array met artikelen,
 *     'zoekwoord' => string zoekterm,
 *     'categorie' => string categorie.
 */
return [
    'artikelen' => $artikelen,
    'zoekwoord' => $zoekwoord,
    'categorie' => $categorie,
];
