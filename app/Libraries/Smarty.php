<?php

namespace App\Libraries;

require_once( APPPATH . 'ThirdParty/Smarty/libs/SmartyBC.class.php' );

class Smarty extends \Smarty {

    protected $config;

    public function __construct() {
        parent::__construct();
        $this->template_dir = APPPATH . 'Views/smarty/synadmin';
        $this->compile_dir = WRITEPATH . 'smarty/compiled';
        $this->config_dir = WRITEPATH . 'smarty/caches';
        $this->cache_dir = WRITEPATH . 'smarty/configs';
        $this->force_compile = true;
        $this->caching = \Smarty::CACHING_LIFETIME_CURRENT;
        $this->cache_lifetime =15;
    }

    public function view(string $view, array $options = null) {
        $result = $this->fetch($view);
        return $result;
    }

    public function setData(array $data = []) {
        foreach ($data as $key => $value) {
            $this->assign($key, $value);
        }
        return($this);
    }

}

?>
