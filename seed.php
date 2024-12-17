<?php
require 'vendor/autoload.php'; // Assure-toi que Faker est installé via Composer

error_reporting(E_ALL);
ini_set('display_errors', 1);

$faker = Faker\Factory::create();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=tp_products', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    for ($i = 0; $i < 1000; $i++) {
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $faker->words(3, true),              // Nom du produit
            $faker->sentence(10),                // Description
            $faker->randomFloat(2, 5, 500),      // Prix entre 5 et 500
            $faker->imageUrl(200, 200, 'product') // URL image fictive
        ]);
    }

    echo "Données insérées avec succès.";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
