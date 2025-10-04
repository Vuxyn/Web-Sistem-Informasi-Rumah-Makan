<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../src/config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getCustomers();
        break;
    case 'POST':
        createCustomer();
        break;
    case 'PUT':
        updateCustomer();
        break;
    case 'DELETE':
        deleteCustomer();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

function getCustomers() {
    global $pdo;

    $search = $_GET['search'] ?? '';

    $sql = "SELECT u.*, 
            COUNT(o.id) as total_orders,
            COALESCE(SUM(o.total), 0) as total_spent
            FROM users u 
            LEFT JOIN orders o ON u.id = o.customer_id 
            WHERE u.role = 'user'";
    $params = [];

    if ($search) {
        $sql .= " AND (u.name LIKE ? OR u.email LIKE ? OR u.phone LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $sql .= " GROUP BY u.id ORDER BY u.created_at DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $customers = $stmt->fetchAll();

    echo json_encode($customers);
}

function createCustomer() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, 'user')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['email'],
        $hashedPassword,
        $data['phone'] ?? '',
        $data['address'] ?? ''
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
}

function updateCustomer() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $id = $data['id'] ?? $_GET['id'];

    $sql = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ? AND role = 'user'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['name'],
        $data['email'],
        $data['phone'] ?? '',
        $data['address'] ?? '',
        $id
    ]);

    echo json_encode(['success' => true]);
}

function deleteCustomer() {
    global $pdo;

    $id = $_GET['id'];

    // Check if customer has orders
    $sql = "SELECT COUNT(*) as order_count FROM orders WHERE customer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    if ($result['order_count'] > 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Cannot delete customer with existing orders']);
        return;
    }

    $sql = "DELETE FROM users WHERE id = ? AND role = 'user'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
}
?>
