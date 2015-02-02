<?php

/*
  Plugin Name: S3 Storage
  Version: 0.1.0
  Description: S3 Stream Storage
  Author: Sunrise Productions
  Author URI: http://sunriseproductions.github.io/
  Plugin URI: http://sunriseproductions.github.io/
*/

use Aws\S3\S3Client;

if (!class_exists('S3_Storage')) {

    final class S3_Storage
    {

        private $client;

        public function __construct()
        {
            // Include required files
            $this->includes();

            // Filters
            add_action('init', array($this, 'initialize'));
            add_filter('pre_option_upload_path', array($this, 'uploads_path'));
            add_filter('pre_option_upload_url_path', array($this, 'uploads_url_path'));
            add_filter('upload_dir', array($this, 'upload_dir'));
        }

        private function includes()
        {
            require_once('includes/libraries/aws/aws.phar');

            include_once('includes/template-functions.php');

            include_once('includes/admin/class-admin-settings.php');
        }

        public function initialize()
        {
            $options = get_option('s3_storage');

            $this->client = S3Client::factory(array(
                'key' => $options['aws_key'],
                'secret' => $options['aws_secret']
            ));

            // Register the s3:// stream wrapper
            $this->client->registerStreamWrapper();
        }

        public function uploads_path($path)
        {
            $options = get_option('s3_storage');

            if ($options['s3_bucket']) {
                return 's3://' . $options['s3_bucket'];
            } else {
                return $path;
            }
        }

        public function uploads_url_path($path)
        {
            $options = get_option('s3_storage');

            if ($options['cloudfront_url']) {
                return $options['cloudfront_url'];
            } else {
                return $path;
            }
        }

        public function upload_dir($details)
        {
            $options = get_option('s3_storage');

            if ($options['s3_bucket'] && $options['cloudfront_url']) {
                $details['basedir'] = 's3://' . $options['s3_bucket'];
                $details['path'] = $details['basedir'] . $details['subdir'];

                $details['baseurl'] = $options['cloudfront_url'];
                $details['url'] = $details['baseurl'] . $details['subdir'];
            }

            return $details;
        }

    }

}

return new S3_Storage();