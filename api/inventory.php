<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../src/config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getInventory();
        break;
    case 'POST':
        createInventory();
        break;
    case 'PUT':
        updateInventory();
        break;
    case 'DELETE':
        deleteInventory();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

function getInventory() {
    global $pdo;

    $category = $_GET['category'] ?? '';
    $status = $_GET['status'] ?? '';
    $search = $_GET['search'] ?? '';

    $sql = "SELECT *, 
            CASE 
                WHEN stock <= min_stock THEN 'habis'
                WHEN stock <= min_stock * 1.5 THEN 'menipis'
                ELSE 'aman'
            END as stock_status
            FROM inventory WHERE 1=1";
    $params = [];

    if ($category) {
        $sql .= " AND category = ?";
        $params[] = $category;
    }

    if ($status) {
        $sql .= " AND (
            CASE 
                WHEN stock <= min_stock THEN 'habis'
                WHEN stock <= min_stock * 1.5 THEN 'menipis'
                ELSE 'aman'
            END = ?
        )";
        $params[] = $status;
    }

    if ($search) {
        $sql .= " AND name LIKE ?";
        $params[] = "%$search%";
    }

    $sql .= " ORDER BY updated_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $inventory = $stmt->fetchAll();

    echo json_encode($inventory);
}

function createInventory() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $sql = "INSERT INTO inventory (name, category, stock, unit, price_per_unit, min_stock) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['category'],
        $data['stock'],
        $data['unit'],
        $data['price_per_unit'],
        $data['min_stock'] ?? 0
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
}

function updateInventory() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $id = $data['id'] ?? $_GET['id'];

    $sql = "UPDATE inventory SET name = ?, category = ?, stock = ?, unit = ?, price_per_unit = ?, min_stock = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['category'],
        $data['stock'],
        $data['unit'],
        $data['price_per_unit'],
        $data['min_stock'] ?? 0,
        $id
    ]);

    echo json_encode(['success' => true]);
}

function deleteInventory() {
    global $pdo;

    $id = $_GET['id'];

    $sql = "DELETE FROM inventory WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
}
?>
