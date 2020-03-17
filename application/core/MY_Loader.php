<?php
/**
 * Created by PhpStorm.
 * User: 55134289
 * Date: 26/04/2019
 * Time: 13:37
 */
class MY_Loader extends CI_Loader {
	/**
	 * Override default loader, force our header and footer onto every page.
	 * @param string $view
	 * @param array $vars
	 * @param bool $return
	 * @return MY_Loader|object|string
	 */
    public function view($view, $vars = array(), $return = FALSE)
    {
    	//call parent add header
		$header = parent::view('templates/header', $vars, $return);

		//add view from controller which call this method
    	$content = parent::view($view, $vars, $return);

    	//call parent add footer
    	$footer = parent::view('templates/footer', $vars, $return);

    	//return as string or as obj SEE PARENT
        return $return ? $header.$content.$footer : $this;
    }
}
?>
