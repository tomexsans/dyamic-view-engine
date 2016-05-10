<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller Extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
    }
}


/*
| -------------------------------------------------------------------
|  The Dynamic View Engine class
| -------------------------------------------------------------------
| Extends the MY_Controller if you have a different setup
| Do so and change the Dynamic_view_engine parent class
*/

include APPPATH.'/core/Dynamic_view_engine.php';


class Test_dynamic_view_engin Extends Dynamic_view_engine{
	
	public function __construct(){
		parent::__construct();
		//will show the sidemenu and menubar
        $this->show_side_main_menu();
	}

    public function show_side_main_menu(){
        $data1['test'] = 'sidebar data';        
        $this->TEMPLATE_PARTS['thesidebar'] = $this->load->view('template/temp_sidebar',$data1,TRUE);

        $data2['link_name'] = 'menu data';
        $this->TEMPLATE_PARTS['themenubar'] = $this->load->view('template/temp_menubar',$data2,TRUE);
    }
}
