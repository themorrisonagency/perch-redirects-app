<?php

class MorrisonRedirects extends PerchAPI_Factory
{
    protected $table     = 'redirects';
    protected $pk        = 'id';
    protected $singular_classname = 'MorrisonRedirect';

    public $dynamic_fields_column = 'dynamic_fields';

    protected $default_sort_column = 'sort_order';

    public $static_fields   = array(
        'id',
        'sort_order',
        'title',
        'status',
        'start_date',
        'end_date',
        'pattern',
        'url',
        'code',
    );

    public function active()
    {
        $now = date('Y-m-d h:i:s');
        $sql = "SELECT * FROM {$this->table} WHERE (
            status = 'enabled'
            OR (
                status = 'scheduled' AND
                start_date < NOW() AND
                end_date > NOW()
            )
        ) ";
        $sql .= "ORDER BY {$this->default_sort_column} DESC";
        $rows   = $this->db->get_rows($sql);
        return $this->return_instances($rows);
    }
}
