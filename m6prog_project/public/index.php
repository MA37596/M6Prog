<?php

require_once '../source/config.php';
require_once SOURCE_ROOT . 'database.php';

$sql = 'SELECT * FROM Plaatsen WHERE Stad = ? ORDER BY Datum';

$stmt = $connection->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $connection->error);
}

$plaats = 'amsterdam';
$stmt->bind_param('s', $plaats);

if (!$stmt->execute()) {
    die("Execution failed: " . $stmt->error);
}

$result = $stmt->get_result();
$weerdatabase = $result->fetch_assoc();
var_dump($weerdatabase);

$stmt->close();
$connection->close();
