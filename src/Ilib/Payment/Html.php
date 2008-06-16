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
    
    private $provider;
    private $merchant;
    private $verification_key;
    private $session_id;
    
    public function __construct($provider, $merchant, $verification_key, $session_id)
    {
        if(!ereg("^[a-zA-Z0-9]+", $provider)) {
            trigger_error('Invalid provider name!', E_USER_ERROR);
            return false;
        }
        
        $this->provider = $provider;
        $this->merchant = $merchant;
        $this->verification_key = $verification_key;
        $this->session_id = $session_id;
    }
    
    
    /**
     * Returns the prepare object
     * 
     * @return object html payment prepare object
     */
    public function getPrepare() {
        
        require_once 'Ilib/Payment/Html/Provider/'.$this->provider.'/Prepare.php';
        $class_name = 'Ilib_Payment_Html_Provider_'.$this->provider.'_Prepare'; 
        return new $class_name($this->merchant, $this->verification_key, $this->session_id);
        
    }
    
    /**
     * Returns the post process object
     * 
     * @return object html payment prepare object
     */
    public function getPostProcess() {
        
        require_once 'Ilib/Payment/Html/Provider/'.$this->provider.'/Postprocess.php';
        $class_name = 'Ilib_Payment_Html_Provider_'.$this->provider.'_Postprocess'; 
        return new $class_name($this->merchant, $this->verification_key, $this->session_id);
        
    }
    
    /**
     * Returns the input object
     * 
     * @return object html payment object
     */
    public function getInput() {
        
        require_once 'Ilib/Payment/Html/Provider/'.$this->provider.'/Input.php';
        $class_name = 'Ilib_Payment_Html_Provider_'.$this->provider.'_Input'; 
        return new $class_name;
        
    }
    
    /**
     * Returns payment process object
     */
    public function getPaymentProcess() {
        $class_name = 'Ilib_Payment_Html_Provider_'.$this->provider.'_PaymentProcess';
        $file_name = 'Ilib/Payment/Html/Provider/'.$this->provider.'/PaymentProcess.php';
        @include_once $file_name;
        if(class_exists($class_name)) {
            return new $class_name($this->verification_key);
        }
        else {
            return false;
        }
    }
    
    
}


?>
