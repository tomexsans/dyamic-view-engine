<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_view_engine Extends Sessions{

    protected $view_template = 'template/default'; //default template to be used
    protected $view_path = ''; //the property that will hold the url class and method
    protected $view_directory = 'templates'; // the views folder 

    protected $SYS_DATA = array(); //the property that will hold all views data
    protected $SYS_CSS = array(); //the property that will hold a user assigned css path
    protected $SYS_JS_TOP = array(); //the property that will hold a user assigned js top path
    protected $SYS_JS_BOT = array(); //the property that will hold  a user assigned js bot path
    protected $SYS_PAGE_TITLE = ''; //page title
    protected $SYS_APP_TITLE  = ''; //app title
    protected $ASSET_PATH = 'assets';
    protected $display_output = true;

    protected $TEMPLATE_PARTS = array();

    public function __construct(){
        parent::__construct();
    }

    /* Change CI OUTPUT to output our self made template */
    public function _output($output)
    {
        if($this->display_output === false){
            exit;
        }

        if($this->view_path !== FALSE && empty($this->view_path)){
            $this->view_path = $this->view_directory.'/'.strtolower($this->router->class) . '/' . strtolower($this->router->method);
        }

        $_final_data['SYS_APP_TITLE']    = $this->SYS_APP_TITLE;
        $_final_data['SYS_PAGE_TITLE']   = $this->SYS_PAGE_TITLE;
        $_final_data['SYS_CSS']          = $this->_process_assets('css',$this->SYS_CSS);
        $_final_data['SYS_JS_TOP']       = $this->_process_assets('js',$this->SYS_JS_TOP);
        $_final_data['SYS_JS_BOT']       = $this->_process_assets('js',$this->SYS_JS_BOT);


        $_final_data_merged = array_merge($_final_data,$this->TEMPLATE_PARTS);
        $page_content = file_exists(APPPATH . 'views/' . $this->view_path . '.php') ? $this->load->view($this->view_path, $this->SYS_DATA, TRUE) : FALSE ;
        //ad more yield here


        if(file_exists(APPPATH . '/views/' . $this->view_template . '.php') ){
            $_final_data_merged['page_content'] = $page_content === FALSE ? '' : $page_content;
            echo $this->load->view($this->view_template,$_final_data_merged,TRUE);
        }else if($yield){
            echo $yield;
        }else{
            //no template found
            //no yield found
            //what to print? i dunno
        }
        exit;
    }

    private function _process_assets($type = '',$config = array()){


        
        $this->load->helper('url');
        $type = strtolower($type);

        if($type == '' OR !in_array($type, array('js','css') )){
            return '';
        }

        if(count($config) == 0){
            return '';
        }
        
        $css_template = '<link rel="stylesheet" type="text/css" href="{{link}}">';
        $js_template = '<script type="text/javascript" src="{{link}}" ></script>';
        $output = '';

        if(strtolower($type) == 'css'){
            $template = $css_template;
            $ext = '.css';
        }elseif (strtolower($type) == 'js') {
            $template = $js_template;
            $ext = '.js';
        }else{
            $template = false;
            $ext = '';
            return '';
        }



        foreach($config as $path){

            if($path[0] == '#'){
                $isExternal = true;
                $cpath = substr($path,1);
            }else{
                $isExternal = false;
                $cpath = $path;
            }

            $pos = strpos($cpath,'[');
            if(  $pos > 0 ){
                preg_match("/\[(.*?)\]/",$cpath,$matches);
                if($matches){
                    $fpath = substr($cpath,0,$pos);
                    $prepend = preg_replace("/\s/im", '', $matches[1] );
                }else{
                    $fpath = $cpath;
                    $prepend = '';
                }
            }else{
                $fpath = $cpath;
                $prepend = '';
            }

            $final = $isExternal === true ? $fpath.$prepend : base_url($this->ASSET_PATH.'/'.$fpath.$ext).$prepend;
            $output .= str_replace('{{link}}', $final, $template);
        }

        return $output;
    }
}