<?php

class Savant3_Plugin_apply_filters extends Savant3_Plugin {

	public function apply_filters($hookname, $value) {
		
		$savant = $this->Savant;
		
		/* @var $savant Savant3 */
		
		// Die Hooks werden mittels Savant3->setPluginConf übergeben
		
		$hooks = $this->hooks;
		
		/* @var $hooks Hooks */
		
		return $hooks->apply_filters($hookname, $value);
		
	}

}

?>