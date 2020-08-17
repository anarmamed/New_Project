<?php
/**
 * This is a utility class, it contains useful methods
 *
 * @since      1.0.0
 */

namespace Plugin_Scope;

class Utility
{


    /**
     * Get content of a given file
     *
     * @param string $file
     * @param mixed $vars
     * @return mixed
     * @since 1.0.0
     */
    public static function tpl($file = '', $vars = array())
    {
        echo self::get_tpl($file, $vars);
    }

    /**
     * Get content of a given file
     *
     * @param string $file
     * @param mixed $vars
     * @return mixed
     * @since 1.0.0
     */
    public static function get_tpl($file = '', $vars = [])
    {
        extract($vars);

        $path = PLUGIN_DIR.'/'.$file.'.php';

        $c = '';

        if (file_exists($path)) {
            ob_start();

            include $path;

            $c = ob_get_clean();

        }

        return $c;
    }

    /**
     * Print array/obj in a readable format
     *
     * @param array|object $data
     * @param boolean $exit
     * @return void
     * @since 1.0.0
     */
    public static function pr($data, $exit = false)
    {
        echo '<pre>'.print_r($data, 1).'</pre>';

        if ($exit) {
            exit;
        }
    }


    /**
     * Display admin notice
     *
     * @param string $msg
     * @param string $type
     * @return string
     * @since 1.0.0
     */
    public static function show_notice($msg, $type = 'error')
    {

        add_action('admin_notices', function () use ($msg, $type) {
            echo '<div class="wsa-notice notice notice-'.$type.'"><p>'.$msg.'</p></div>';
        });
    }


    /**
     * Log errors in a error.log file in the root of the plugin folder
     *
     * @param mixed $msg
     * @param string $code
     * @return void
     * @since 1.0.0
     */
    public static function error_log($msg, $code = '')
    {

        if (! is_string($msg)) {
            $msg = print_r($msg, true);
        }

        error_log('Error '.$code.' ['.date('Y-m-d h:m:i').']: '.$msg.PHP_EOL, 3, ERROR_PATH);
    }


    /**
     * @param array $pairs
     * @param array $atts
     * @return array
     */
    public static function atts($pairs = array(), $atts = array())
    {
        $atts = (array)$atts;
        $out  = array();

        foreach ($pairs as $name => $default) {
            if (array_key_exists($name, $atts)) {
                $out[$name] = $atts[$name];
            } else {
                $out[$name] = $default;
            }
        }

        return $out;
    }

}