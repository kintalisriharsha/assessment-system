<?php
header('Content-Type: application/json');
require_once 'config.php';

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['language']) || !isset($input['code'])) {
        throw new Exception('Missing required parameters');
    }

    $result = executeCode(
        $input['language'],
        $input['code'],
        $input['stdin'] ?? ''
    );

    echo json_encode($result);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>