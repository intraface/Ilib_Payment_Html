<?php
/**
 * Postprocess to extend from for online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Html
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

class Ilib_Payment_Html_Postprocess 
{
    
    /**
     * @var string merhcant number
     */
    protected $merchant;
    
    /**
     * @var string language
     */
    protected $language;
    
    /**
     * @var string verification_key
     */
    protected $verification_key;   
    
    /**
     * @var string session_id the users session id.
     */
    protected $session_id;
    
    /**
     * @var array $values
     */
    protected $values = array();

    /**
     * @var array $optional_values
     */
    protected $optional_values = array();

    /**
     * @var array compare values set by
     */
    protected $compare_values = array();
        
    /**
     * Contructor
     * 
     * @param string $merchant merchant number
     * @param string $language the language used in the payment
     */

    public function __construct($merchant, $verification_key, $session_id)
    {
        $this->merchant = $merchant;
        $this->verification_key = $verification_key;
        $this->session_id = $session_id;
        
    }
    
    /**
     * Set postprocess input. The input is supposed to come from the online payment
     * Needs to be customized for the provider. 
     * 
     * @param array $input input for postprocess
     */
    public function setPaymentResponse($input) 
    {
        return false;
    }
    
    /**
     * returns the amount that has been paid.
     */
    public function getAmount() 
    {
        return $this->values['amount'];
    }
    
    /**
     * returns the order number
     */
    public function getOrderNumber() 
    {
        return $this->values['order_number'];
    }
    
    /**
     * returns the pbs status of the transaction
     */
    public function getPbsStatus()
    {
        return $this->values['pbs_status'];
    }
    
    /**
     * returns the transaction id
     */
    public function getTransactionId() 
    {
        return $this->values['transaction_id'];
    }
    
    /**
     * return optional value
     */
    public function getOptionalValues() {
        return $this->optional_values;
    }
     
}


?>
