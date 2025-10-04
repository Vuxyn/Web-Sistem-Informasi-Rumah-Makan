<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../src/config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getPromos();
        break;
    case 'POST':
        createPromo();
        break;
    case 'PUT':
        updatePromo();
        break;
    case 'DELETE':
        deletePromo();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

function getPromos() {
    global $pdo;

    $status = $_GET['status'] ?? '';
    $search = $_GET['search'] ?? '';

    $sql = "SELECT * FROM promos WHERE 1=1";
    $params = [];

    if ($status) {
        $sql .= " AND status = ?";
        $params[] = $status;
    }

    if ($search) {
        $sql .= " AND (name LIKE ? OR code LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $sql .= " ORDER BY created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $promos = $stmt->fetchAll();

    echo json_encode($promos);
}

function createPromo() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $sql = "INSERT INTO promos (name, code, type, value, start_date, end_date, limit_usage, min_purchase, description, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['code'],
        $data['type'],
        $data['value'],
        $data['start_date'],
        $data['end_date'],
        $data['limit_usage'] ?? null,
        $data['min_purchase'] ?? null,
        $data['description'] ?? '',
        $data['status'] ?? 'active'
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
}

function updatePromo() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $id = $data['id'] ?? $_GET['id'];

    $sql = "UPDATE promos SET name = ?, code = ?, type = ?, value = ?, start_date = ?, end_date = ?, limit_usage = ?, min_purchase = ?, description = ?, status = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['code'],
        $data['type'],
        $data['value'],
        $data['start_date'],
        $data['end_date'],
        $data['limit_usage'] ?? null,
        $data['min_purchase'] ?? null,
        $data['description'] ?? '',
        $data['status'] ?? 'active',
        $id
    ]);

    echo json_encode(['success' => true]);
}

function deletePromo() {
    global $pdo;

    $id = $_GET['id'];

    $sql = "DELETE FROM promos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
}
?>
