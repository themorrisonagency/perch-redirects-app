<?php
$sql = "ALTER TABLE perch3_redirects ALTER sort_order SET DEFAULT 0;";

$statements = explode(';', $sql);

foreach ($statements as $statement) {
    $statement = trim($statement);
    if ($statement != '') {
        $this->db->execute($statement);
    }
};
