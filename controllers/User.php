<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User Extends Test_dynamic_view_engine{

	public function __construct(){
		parent::__construct();

	}

	public function index(){

		$this->SYS_JS_TOP = array('#http://this/is/some/path/from/construct[?gdfgsdfg]',
								  'test/test/test[?vedgdf]',
								  '#test/test/test/test/hudhfashf.js[?vedgdf]');
		$this->SYS_DATA['estpoad1'] = 'Man 1: WHy are you looking up';
		$this->SYS_DATA['estpoad2'] = 'Man 2: Because i saw superman';
		$this->SYS_DATA['estpoad3'] = 'Man 1: Are you serious';
		$this->SYS_DATA['estpoad4'] = 'Man 2: Yes i am';
		$this->SYS_DATA['estpoad5'] = 'Man 1: K';
		$this->SYS_DATA['estpoad6'] = 'Man 2: K Bye';

		//$this->view_path = false;
		//$this->display_output = true;
	}
}