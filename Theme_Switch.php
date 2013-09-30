<?php

/**
 * Pcio Theme switcher
 *
 * @package Pico
 * @subpackage TODO
 * @since version TODO
 * @author TODO Shawn Sandy
 * @link TODO http://www.shawnsandy.com
 * @license http://opensource.org/licenses/MIT
 */
class Theme_Switch {

    private $active_themes = null, $base_url;

    public function __construct() {
        if (!isset($_SESSION))
            session_start();
    }

    public function plugins_loaded() {

    }

    public function request_url(&$url) {

        $this->base_url = $url;
        if (isset($_GET['theme']) and $_GET['theme'] != 'close'):
            $_SESSION['theme'] = $_GET['theme'];
        endif;
    }

    public function config_loaded(&$settings) {

        // delete session
        if (isset($_GET['theme']) and trim($_GET['theme'], '/') == 'close'):
            unset($_SESSION['theme']);
            header("Location:  {$settings['base_url']}");
            exit();
        endif;

        // change the theme setting
        if (isset($_SESSION["theme"])):
            $theme = THEMES_DIR . $_SESSION['theme'] . '/index.html';
            if (file_exists($theme)):
                $settings['theme'] = $_SESSION['theme'];
            endif;
        endif;

        //get theme list
        if (isset($settings['theme-list'])):
            $this->active_themes = $settings['theme_list'];
        endif;
    }

    public function before_render(&$twig_vars, &$twig) {

        if (isset($_SESSION['theme']))
            $twig_vars['preview_theme'] = $_SESSION['theme'];
    }

    public function after_render(&$output) {
        $directory = THEMES_DIR;
    }

}
