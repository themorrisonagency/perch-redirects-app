<?php
if (!defined('PERCH_DB_PREFIX')) {
    exit;
};

$sql =
"CREATE TABLE IF NOT EXISTS `__PREFIX__redirects` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `sort_order` INT(11) unsigned NOT NULL DEFAULT 0,
    `title` VARCHAR(255) NOT NULL DEFAULT '',
    `status` VARCHAR(255) NOT NULL DEFAULT 'enabled',
    `start_date` DATETIME DEFAULT NULL,
    `end_date` DATETIME DEFAULT NULL,
    `pattern` TEXT DEFAULT NULL,
    `url` TEXT DEFAULT NULL,
    `code` TEXT DEFAULT NULL,
    `dynamic_fields` TEXT DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";

$sql = str_replace('__PREFIX__', PERCH_DB_PREFIX, $sql);

$statements = explode(';', $sql);
foreach ($statements as $statement) {
    $statement = trim($statement);
    if ($statement != '') {
        $this->db->execute($statement);
    }
}

$sql = 'SHOW TABLES LIKE "'.$this->table.'"';
$result = $this->db->get_value($sql);

return $result;
