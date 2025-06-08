<?php
/**
 * Importeer namespaces voor database en artikelenrepository.
 * 
 * @use Core\Database                      Zorgt voor de verbinding met de database.
 * @use Repositories\ArticlesRepository    Beheert ophalen van artikeldata uit de database.
 */
use Core\Database;
use Repositories\ArticlesRepository;



require_once __DIR__ . '/../../public_html/Lang/translator.php';
require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../repositories/ArticlesRepository.php';

$translator = init_translator();



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
 * Ophalen van zoekfilters uit de URL (GET parameters).
 * 
 * @zoekwoord string        Zoekterm ingevoerd door gebruiker (leeg als niet ingevuld).
 * @categorie string        Geselecteerde categorie uit dropdown (leeg als niet geselecteerd).
 * @?? operator             Controleert of een waarde bestaat. Zo niet, dan wordt een standaard ingevuld (zoals 0 of '').

 */
$zoekwoord = $_GET['zoekwoord'] ?? '';
$categorie = $_GET['categorie'] ?? '';



/** 
 * Ophalen van gefilterde artikelen die passen bij het zoekwoord en categorie met behulp van de repository.
 * 
 * @artikelen array         Resultaat van de zoekopdracht (lijst met artikelobjecten).
 * @findAll(string, string) Methode van ArticlesRepository die zoekt op zoekwoord en categorie in de database.
 */
$artikelen = $articlesRepo->findAll($zoekwoord, $categorie);



/** 
 * Stuurt de verzamelde gegevens terug naar de pagina die ze toont (de view).
 * 
 * @ return array
 *     'artikelen' => array/lijst met gevonden artikelen,
 *     'zoekwoord' => string ingevulde zoekterm,
 *     'categorie' => string gekozen categorie.
 */
return [
    'artikelen' => $artikelen,
    'zoekwoord' => $zoekwoord,
    'categorie' => $categorie,
];
