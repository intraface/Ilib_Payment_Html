<?php
/**
 * Prepares and postprocess online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Html
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

class Ilib_Payment_Html 
{
    
    /**
     * Returns the payment object
     * 
     * @param string $provider the name of the provider
     * @return object html payment object
     */
    
    static function factory($provider, $action, $merchant, $verification_key, $session_id) {
        
        
        if(!ereg("^[a-zA-Z0-9]+", $provider)) {
            trigger_error('Invalid provider name!', E_USER_ERROR);
            return false;
        }
        
        if(!in_array($action, array('prepare', 'postprocess'))) {
            trigger_error('Invalid action '.$action.', should be either Prepare or Postprocess', E_USER_ERROR);
            return false;
        }
        
        
        $file_name = 'Ilib/Payment/Html/Provider/'.$provider.'/'.ucfirst($action).'.php';
        $class_name = 'Ilib_Payment_Html_Provider_'.$provider.'_'.ucfirst($action); 
        
        
        require_once $file_name;
        return new $class_name($merchant, $verification_key, $session_id);
        
    }
    
    
}


?>
