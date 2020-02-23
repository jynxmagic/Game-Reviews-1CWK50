<?php
/**
 * Created by PhpStorm.
 * User: 55134289
 * Date: 26/04/2019
 * Time: 13:37
 */
class MY_Loader extends CI_Loader {
    public function view($view, $vars = array(), $return = FALSE)
    {
		$header = parent::view('templates/header', $vars, $return);

    	$content = parent::view($view, $vars, $return);
    	$footer = parent::view('templates/footer', $vars, $return);

        return $return ? $header.$content.$footer : $this;
    }
}
?>
