<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Utils {
	
	public function data_php_to_sql($phpData){
		if($phpData != NULL && $phpData != '' && preg_match("/^([1-9]|0[1-9]|[1-2][0-9]|3[0-1])-([1-9]|0[1-9]|1[0-2])-[0-9]{4}$/", str_replace('/', '-', $phpData))){
			return date("Y-m-d", strtotime(str_replace('/', '-', $phpData)));
		}else{
			return NULL;
		}
	}
	
	public function data_sql_to_php($sqlData){
		if($sqlData != NULL && $sqlData != '' && $sqlData != '0000-00-00'){
			return date("d/m/Y",strtotime($sqlData));
		}else{
			return '';
		}
	}
}
