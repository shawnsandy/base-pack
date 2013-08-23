<?php

/**
 * The file description. *
 * @package Pico
 * @subpackage Bootstrap
 * @since BJ 1.0
 * @author Shawn Sandy <shawnsandy04@gmail.com>
 */
class Pico_Base {

    private $base_url = null;
    private $theme_url = null;

    public function __construct() {

    }

    public function config_loaded(&$settings) {
        $this->base_url = $settings['base_url'];
    }

    public function before_render(&$twig_vars, &$twig) {

        $base_pack = $this->base_url . '/plugins/' . basename(__DIR__);

        if (isset($this->base_url)):

            $css = $this->base_url . $base_pack.'/css';

            $js = $this->base_url . $base_pack.'/js';

            $bootstrap_css = $base_pack . '/bootstrap/css/bootstrap.css';
            $bootstrap_css_min = $base_pack . '/bootstrap/css/bootstrap.min.css';

            $bootstrap_js_min = $base_pack . '/bootstrap/js/bootstrap.min.js';
            $bootstrap_js = $base_pack . '/bootstrap/js/bootstrap.js';

            $twig_vars['bootstrap_css'] = $this->css($bootstrap_css);

            $twig_vars['bootstrap_css_min'] = $this->css($bootstrap_css_min);

            $twig_vars['bootstrap_js'] = $this->js($bootstrap_js);

            $twig_vars['bootstrap_js_min'] = $this->js($bootstrap_js_min);

            $twig_vars['jquery_cdn'] = $this->js('http://code.jquery.com/jquery.js');

            $twig_vars['jquery'] = $this->js($js.'/jquery-1.10.2.min.js');

            $twig_vars['theme_stylesheet'] = '';

        endif;
    }

    protected function js($files) {

        $script = "<script src=\"{$files}\"/></script>";
        return $script;
    }

    protected function css($files) {
        $style = "<link rel=\"stylesheet\" href=\"{$files}\" />";
        return $style;
    }

}

