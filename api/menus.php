<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../src/config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getMenus();
        break;
    case 'POST':
        createMenu();
        break;
    case 'PUT':
        updateMenu();
        break;
    case 'DELETE':
        deleteMenu();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

function getMenus() {
    global $pdo;

    $category = $_GET['category'] ?? '';
    $status = $_GET['status'] ?? '';
    $search = $_GET['search'] ?? '';

    $sql = "SELECT * FROM menus WHERE 1=1";
    $params = [];

    if ($category) {
        $sql .= " AND category = ?";
        $params[] = $category;
    }

    if ($status) {
        $sql .= " AND status = ?";
        $params[] = $status;
    }

    if ($search) {
        $sql .= " AND name LIKE ?";
        $params[] = "%$search%";
    }

    $sql .= " ORDER BY created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $menus = $stmt->fetchAll();

    echo json_encode($menus);
}

function createMenu() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $sql = "INSERT INTO menus (name, category, price, description, stock, status, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['category'],
        $data['price'],
        $data['description'] ?? '',
        $data['stock'] ?? 0,
        $data['status'] ?? 'tersedia',
        $data['image'] ?? ''
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
}

function updateMenu() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $id = $data['id'] ?? $_GET['id'];

    $sql = "UPDATE menus SET name = ?, category = ?, price = ?, description = ?, stock = ?, status = ?, image = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['category'],
        $data['price'],
        $data['description'] ?? '',
        $data['stock'] ?? 0,
        $data['status'] ?? 'tersedia',
        $data['image'] ?? '',
        $id
    ]);

    echo json_encode(['success' => true]);
}

function deleteMenu() {
    global $pdo;

    $id = $_GET['id'];

    $sql = "DELETE FROM menus WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
}
?>
