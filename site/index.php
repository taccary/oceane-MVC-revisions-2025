<?php
/**
 * Page d'accueil du site LAMP
 * 
 * Cette page sert d'exemple pour tester la génération de documentation
 * avec phpDocumentor.
 * 
 * @author Votre équipe de développement
 * @version 1.0
 * @since 2025-07-08
 */

require_once 'classes/Calculator.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site LAMP - Exemple de documentation</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .demo-section { background: #f5f5f5; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>🎯 Site LAMP - Exemple d'utilisation</h1>
    
    <div class="demo-section">
        <h2>📊 Utilisation de la classe Calculator</h2>
        <?php
        $calc = new Calculator();
        $result = $calc->add(5, 3);
        echo "<p class='success'>5 + 3 = " . $result . "</p>";
        
        $result2 = $calc->multiply(4, 7);
        echo "<p class='success'>4 × 7 = " . $result2 . "</p>";
        ?>
    </div>
    
    <div class="demo-section">
        <h2>📚 Génération de la documentation</h2>
        <p>Pour générer localement la documentation des classes de ce code, depuis la racine du projet utilisez la commande suivante :</p>
        <pre><code>php documentation/tools/phpDocumentor.phar run -c documentation/tools/phpdoc.xml</code></pre>
        <p>Cette commande analysera les commentaires PHPDoc et générera la documentation dans le dossier <code>documentation/generated</code>.</p>
        <p>Après la génération, démarrez un serveur php sur le port 8001 et mappez-le avec le dossier <code>documentation/generated</code> :</p>
        <pre><code>php -S localhost:8001 -t documentation/generated/</code></pre>
        <p>Ouvrez dans le navigateur le site executé sur le port 8001 du conteneur pour consulter la documentation générée.</p>
    </div>

    <div class="demo-section">
        <h2>🧪 Tests de la classe Calculator</h2>
        <p>Les tests unitaires sont exécutés pour valider le bon fonctionnement de la classe Calculator. Pour tester :</p>
        <pre><code>composer install<br>vendor/bin/phpunit --testdox tests/CalculatorTest.php</code></pre>
        <p>Résultats des tests :</p>
        <pre><code>
            Calculator
            ✘ Addition
            │
            │ Failed asserting that -3.0 matches expected 3.
            │
            │ /workspaces/LAMP-start/tests/CalculatorTest.php:43
            │
            ✔ Addition with decimals
            ✔ Addition with negative numbers
            ✔ Subtraction
            ✔ Multiplication
            ✔ Multiplication by zero
            ✔ Division
            ✔ Division with decimal result
            ✔ Division by zero throws exception
            ✔ History
            ✔ Clear history
            ✔ History contains timestamp
            ✔ Multiple additions
            ✔ Performance

            FAILURES!
            Tests: 14, Assertions: 24, Failures: 1.
        </code></pre>
    </div>

</body>
</html>
