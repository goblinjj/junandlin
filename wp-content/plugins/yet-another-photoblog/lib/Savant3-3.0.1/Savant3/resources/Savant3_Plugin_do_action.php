<?php

class Savant3_Plugin_do_action extends Savant3_Plugin {

	public function do_action($hookname, $value=null) {
		
		$savant = $this->Savant;
		
		/* @var $savant Savant3 */
		
		// Die Hooks werden mittels Savant3->setPluginConf übergeben
		
		if (!isset($this->hooks)) {
			echo 'Keine Hooks!';
		}
		
		$hooks = $this->hooks;
		
		/* @var $hooks Hooks */
		
		$hooks->do_action($hookname, $value);
		
	}

}

?>