<?php
class EmptyAction extends Action {  
 	public function index() {  
    	header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->display('Public:404');  
    }  
    public function _empty() {  
        header('HTTP/1.1 404 Not Found');  
        $this->display('Public:404');  
    }  
}
?>