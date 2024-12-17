<?php
$pdo = new PDO('mysql:host=localhost;dbname=tp_products', 'root', ''); // Ajuste tes identifiants
$limit = 20; // Nombre de produits par page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$stmt = $pdo->prepare("SELECT * FROM products LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($products);
?>
