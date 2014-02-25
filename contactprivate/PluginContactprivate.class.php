<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginContactprivate extends Plugin {

	
	
    public $aInherits = array(

        'module' => array(
            'ModuleUser' => '_ModuleUser',
        ),
    );
	
    public function Activate() {
        if (!$this->isTableExists('prefix_user_cast_history')) {
            $resutls = $this->ExportSQL(dirname(__FILE__) . '/activate.sql');
            return $resutls['result'];
        }

        return true;
    }

    public function Deactivate(){
    	return true;
    }

    public function Init() {    	
		return true;
    }
}
?>
