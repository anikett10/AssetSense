<?php
exec("python open_report.py", $output, $return);
if ($return != 0) {
    http_response_code(500);
    echo json_encode(['error' => 'Error opening Report file.']);
} else {
    echo json_encode(['message' => 'Report file opened successfully.']);
}
?>