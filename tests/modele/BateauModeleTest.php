<?php
use PHPUnit\Framework\TestCase;

// Inclusion des fichiers nécessaires
require_once __DIR__ ."/../../site/configBdd.php";
require_once __DIR__ ."/../../site/modele/bateau_modele.php";


class BateauModeleTest extends TestCase {

    public function testGetNiveauxAccessibilite() {
        $result = getNiveauxAccessibilite(); // Appel direct sans passer la connexion
        $this->assertIsArray($result, "La fonction doit retourner un tableau.");
        $this->assertNotEmpty($result, "Le tableau ne doit pas être vide.");
    }

    public function testGetBateauxParNiveau() {
        $niveauPMR = 1; // Exemple de niveau
        $result = getBateauxParNiveau($niveauPMR); // Appel direct sans passer la connexion
        $this->assertIsArray($result, "La fonction doit retourner un tableau.");
    }

    public function testGetBateauxParNiveauEmpty() {
        $niveauPMR = 999; // Niveau qui n'existe pas
        $result = getBateauxParNiveau($niveauPMR); // Appel direct sans passer la connexion
        $this->assertIsArray($result, "La fonction doit retourner un tableau.");
        $this->assertEmpty($result, "Le tableau doit être vide.");
    }

    public function testGetTousLesBateaux() {
        $result = getTousLesBateaux(); // Appel direct sans passer la connexion
        $this->assertIsArray($result, "La fonction doit retourner un tableau.");
        $this->assertNotEmpty($result, "Le tableau ne doit pas être vide.");
    }

    public function testGetBateauById() {
        $idBateau = 6; // Exemple d'ID de bateau
        $result = getBateauById($idBateau); // Appel direct sans passer la connexion
        $this->assertIsArray($result, "La fonction doit retourner un tableau.");
        $this->assertArrayHasKey('id', $result, "Le tableau doit contenir la clé 'idBateau'.");
        $this->assertArrayHasKey('nom', $result, "Le tableau doit contenir la clé 'nom'.");
        $this->assertArrayHasKey('niveauPMR', $result, "Le tableau doit contenir la clé 'niveauPMR'.");
        $this->assertArrayHasKey('libelle', $result, "Le tableau doit contenir la clé 'libelle'.");
        $this->assertEquals($idBateau, $result['id'], "L'ID du bateau doit correspondre à celui demandé.");
    }

}