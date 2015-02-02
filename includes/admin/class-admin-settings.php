<?php

class S3_Storage_Settings
{

    public function __construct()
    {
        // Add menus
        add_action('admin_menu', array($this, 'admin_menu'), 9);
        add_action('admin_init', array($this, 'add_settings'));
    }

    public function admin_menu()
    {
        add_submenu_page('options-general.php', 'S3 Storage', 'S3 Storage', 'administrator', 's3-storage', array($this, 'settings_page'));
    }

    public function settings_page()
    {
        s3_storage_load_template('admin/s3-storage-admin-settings', array(
            'options' => get_option('s3_storage')
        ));
    }

    public function add_settings()
    {
        register_setting('s3_storage', 's3_storage', array($this, 's3_storage_validate'));
    }

    public function s3_storage_validate($input)
    {
        if ($input['aws_secret'] && $input['aws_secret'] == 'aws-secret')
        {
            $options = get_option('s3_storage');
            $input['aws_secret'] = $options['aws_secret'];
        }

        return $input;
    }
}

return new S3_Storage_Settings();
