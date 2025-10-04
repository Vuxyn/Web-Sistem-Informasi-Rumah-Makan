<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../src/config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getOrders();
        break;
    case 'POST':
        createOrder();
        break;
    case 'PUT':
        updateOrder();
        break;
    case 'DELETE':
        deleteOrder();
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

function getOrders() {
    global $pdo;

    $status = $_GET['status'] ?? '';
    $date = $_GET['date'] ?? '';
    $search = $_GET['search'] ?? '';

    $sql = "SELECT o.*, u.name as customer_name, 
            GROUP_CONCAT(CONCAT(m.name, ' (', oi.quantity, ')') SEPARATOR ', ') as menu_items
            FROM orders o 
            LEFT JOIN users u ON o.customer_id = u.id 
            LEFT JOIN order_items oi ON o.id = oi.order_id 
            LEFT JOIN menus m ON oi.menu_id = m.id 
            WHERE 1=1";
    $params = [];

    if ($status) {
        $sql .= " AND o.status = ?";
        $params[] = $status;
    }

    if ($date) {
        $sql .= " AND DATE(o.order_date) = ?";
        $params[] = $date;
    }

    if ($search) {
        $sql .= " AND (u.name LIKE ? OR o.id LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $sql .= " GROUP BY o.id ORDER BY o.order_date DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll();

    echo json_encode($orders);
}

function createOrder() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $pdo->beginTransaction();

    try {
        // Insert order
        $sql = "INSERT INTO orders (customer_id, total, status) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['customer_id'],
            $data['total'],
            $data['status'] ?? 'pending'
        ]);
        $orderId = $pdo->lastInsertId();

        // Insert order items
        if (isset($data['items']) && is_array($data['items'])) {
            $sql = "INSERT INTO order_items (order_id, menu_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            foreach ($data['items'] as $item) {
                $stmt->execute([
                    $orderId,
                    $item['menu_id'],
                    $item['quantity'],
                    $item['price']
                ]);
            }
        }

        $pdo->commit();
        echo json_encode(['success' => true, 'id' => $orderId]);
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function updateOrder() {
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        $data = $_POST;
    }

    $id = $data['id'] ?? $_GET['id'];

    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $data['status'],
        $id
    ]);

    echo json_encode(['success' => true]);
}

function deleteOrder() {
    global $pdo;

    $id = $_GET['id'];

    $pdo->beginTransaction();

    try {
        // Delete order items first
        $sql = "DELETE FROM order_items WHERE order_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        // Delete order
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $pdo->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $pdo->rollBack();
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
