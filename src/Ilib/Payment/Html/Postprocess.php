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
     * @var double amount
     */
    protected $amount;
    
    /**
     * @var integer $order_number
     */
    protected $order_number;
    
    /**
     * @var string $pbs_status
     */
    protected $pbs_status;
    
    /**
     * @var integer $transaction_number
     */
    protected $transaction_number;
        
    /**
     * @var string $transaction_status
     */
    protected $transaction_status;
    
    /**
     * @var string currency
     */
    protected $currency;

    /**
     * @var array $optional_values
     */
    protected $optional_values = array();
        
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
    public function setPaymentResponse($post, $get, $session, $payment_target) 
    {
        return false;
    }
    
    /**
     * returns the amount that has been paid.
     */
    public function getAmount() 
    {
        return $this->amount;
    }
    
    /**
     * returns the order number
     */
    public function getOrderNumber() 
    {
        return $this->order_number;
    }
    
    /**
     * returns the pbs status of the transaction
     */
    public function getPbsStatus()
    {
        return $this->pbs_status;
    }
    
    /**
     * returns the transaction id
     */
    public function getTransactionNumber() 
    {
        return $this->transaction_number;
    }

    /**
     * returns the transaction status
     * 
     * @return string transactions status
     */
    public function getTransactionStatus() 
    {
        return $this->transaction_status;
    }
    
    /**
     * returns the currency
     * 
     * @return string currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    
    /**
     * return optional value
     */
    public function getOptionalValues() 
    {
        return $this->optional_values;
    }    
}