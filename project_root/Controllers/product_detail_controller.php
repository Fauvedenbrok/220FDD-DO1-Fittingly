<?php
/**
 * Importeer namespaces voor database en artikelenrepository.
 * 
 * @use Core\Database                      Zorgt voor de verbinding met de database.
 * @use Repositories\ArticlesRepository    Beheert ophalen van artikeldata uit de database.
 */
use Core\Database;
use Repositories\ArticlesRepository;


require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';



/**
 * Start de databaseverbinding en zet de artikeldata-repository klaar.
 * 
 * @ $db new Database           Maakt een nieuw database-object aan
 * @ $pdo = $db                 De daadwerkelijke databaseverbinding.
 * @$articlesRepo = new ArticlesRepository  Geeft de databaseverbinding door aan de artikelen-beheertool
 */
$db = new Database();
$pdo = $db->getConnection();
$articlesRepo = new ArticlesRepository($pdo);



/** 
 * Haal artikel-ID op uit de URL (GET-parameter).
 * 
 * @$id = (int)         Zet ID om naar een geheel getal (integer).
 * @$_GET['id']         Haalt 'id' op uit de URL (?id=123).
 * @?? 0                Controleert of 'id' bestaat, anders wordt 0 gebruikt.
 */
$id = (int) ($_GET['id'] ?? 0);

/** Als ID niet geldig is (0), geef een lege array terug.
 * @!$id           Controleert of ID 0 of ongeldig is.
 * @ return array  Geeft een lege lijst als er geen geldig ID is.
 */
if (!$id) {
    return []; 
}



/** Zoek het artikel in de database via het ID. */
$artikel = $articlesRepo->findById($id);



/** 
 * Als het artikel niet bestaat, return lege array (errorhandling).
 * 
 * @!$artikel    Controle op fout of leeg resultaat.
 * @ return array Leeg als artikel niet gevonden is.
 */
if (!$artikel) {
    return []; 
}



/** 
 * Maak een CSS-classnaam op basis van de artikelcategorie.
 * 
 * @getArticleCategory()            Haalt de categorie van het artikel op.
 * @str_replace(' ', '-', ...)      Vervangt spaties met koppeltekens.
 * @strtolower(...)                 Zet alles om naar kleine letters voor CSS.
 * @$categorieClass                 CSS-ready string zoals 'mannen-accessoires'.
 */
$categorieClass = strtolower(str_replace(' ', '-', $artikel->getArticleCategory()));



/** 
 * Geeft het artikel en de bijbehorende CSS-class terug aan de view pagina.
 * 
 * @ return array een lijst met:
 *     'artikel' => Het artikelobject met gegevens.
 *     'categorieClass' => De CSS-classnaam als tekst (bijv. "vrouwenkleding".
 */
return [
    'artikel' => $artikel,
    'categorieClass' => $categorieClass
];
