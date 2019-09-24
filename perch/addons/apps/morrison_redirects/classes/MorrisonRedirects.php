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
        )";
        $sql .= "ORDER BY {$this->default_sort_column} DESC";
        $rows   = $this->db->get_rows($sql);
        return $this->return_instances($rows);
    }

    public function update_app_version()
    {
        $Settings = $this->api->get('Settings');

        $installed_version = $Settings->get('morrison_redirects_version')->val() ?: '0.1.0';

        PerchUtil::debug('Currently Running Redirects App Version: '.$installed_version);

        if (version_compare($installed_version, MORRISON_REDIRECTS_VERSION, '<')) {
            PerchUtil::debug('Redirects App Version: '.MORRISON_REDIRECTS_VERSION);

            $migrations = json_decode(file_get_contents(MORRISON_REDIRECTS_PATH.'/database/migrations.json'));

            try {
                foreach ($migrations as $key => $migration) {
                    if (version_compare($migration->version, $installed_version, '>')) {
                        PerchUtil::debug('Running Migration: '.$migration->file);
                        include(MORRISON_REDIRECTS_PATH.'/database/'.$migration->file);
                    }
                }

                PerchUtil::debug('Updated Redirects App to Version: '.MORRISON_REDIRECTS_VERSION);
                $Settings->set('morrison_redirects_version', MORRISON_REDIRECTS_VERSION);

                return true;
            } catch (Error $e) {
                PerchUtil::debug('Error running migrations for Redirects App', 'error');
                PerchUtil::debug($e, 'error', false);
                return false;
            }
        }
    }
}
