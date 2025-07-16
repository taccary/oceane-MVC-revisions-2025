<?php
use PHPUnit\Framework\TestCase;

// Inclusion des fichiers nécessaires
require_once __DIR__ . "/../../site/configBdd.php";
require_once __DIR__ . "/../../site/modele/bateau_modele.php";
require_once __DIR__ . "/../../site/controleur/bateau_controleur.php";

class BateauControleurTest extends TestCase {

    public function testAfficherBateaux() {
        // Simuler une requête POST avec un niveau PMR
        $_POST['niveauPMR'] = 1; // Exemple de niveau

        // Appeler la fonction du contrôleur
        $response = afficherBateaux();

        // Vérifier que la vue est retournée
        $this->assertArrayHasKey('view', $response, "La clé 'view' doit être présente dans la réponse.");
        $this->assertStringContainsString('bateau_vue.php', $response['view'], "La vue retournée doit être 'bateau_vue.php'.");

        // Vérifier que les données sont retournées
        $this->assertArrayHasKey('data', $response, "La clé 'data' doit être présente dans la réponse.");
        $this->assertIsArray($response['data'], "Les données doivent être un tableau.");
        $this->assertArrayHasKey('lesNiveauxPMR', $response['data'], "Les données doivent contenir 'lesNiveauxPMR'.");
        $this->assertArrayHasKey('lesBateaux', $response['data'], "Les données doivent contenir 'lesBateaux'.");

        // Vérifier que les données contiennent des éléments
        $this->assertNotEmpty($response['data']['lesNiveauxPMR'], "Les niveaux PMR ne doivent pas être vides.");
        $this->assertNotEmpty($response['data']['lesBateaux'], "Les bateaux ne doivent pas être vides.");
    }

    public function testAfficherTousLesBateaux() {
        // Simuler une requête POST sans niveau PMR
        unset($_POST['niveauPMR']);

        // Appeler la fonction du contrôleur
        $response = afficherBateaux();

        // Vérifier que la vue est retournée
        $this->assertArrayHasKey('view', $response, "La clé 'view' doit être présente dans la réponse.");
        $this->assertStringContainsString('bateau_vue.php', $response['view'], "La vue retournée doit être 'bateau_vue.php'.");

        // Vérifier que les données sont retournées
        $this->assertArrayHasKey('data', $response, "La clé 'data' doit être présente dans la réponse.");
        $this->assertIsArray($response['data'], "Les données doivent être un tableau.");
        $this->assertArrayHasKey('lesNiveauxPMR', $response['data'], "Les données doivent contenir 'lesNiveauxPMR'.");
        $this->assertArrayHasKey('lesBateaux', $response['data'], "Les données doivent contenir 'lesBateaux'.");

        // Vérifier que les données contiennent des éléments
        $this->assertNotEmpty($response['data']['lesNiveauxPMR'], "Les niveaux PMR ne doivent pas être vides.");
        $this->assertNotEmpty($response['data']['lesBateaux'], "Les bateaux ne doivent pas être vides.");
    }
}