<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/connectors/sources/ext/rest/rest.php');
class ext_rest_spaces extends ext_rest {
	public function __construct(){
		parent::__construct();
		$this->_enable_in_wizard = false;
		$this->_enable_in_hover = true;
	}
	
	/*
	 * getItem
	 * 
	 * As the spaces connector does not have a true API call, we simply
	 * override this abstract method
	 */
	public function getItem($args=array(), $module=null){}


	/*
	 * getList
	 * 
	 * As the spaces connector does not have a true API call, we simply
	 * override this abstract method
	 */	
	public function getList($args=array(), $module=null){}
	
	
	public function __destruct(){
		parent::__destruct();
	}
}
 
?>