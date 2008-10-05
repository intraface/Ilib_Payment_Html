<?php
/**
 * Extendable prepare online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Html
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Html_Prepare 
{
    /**
     * @var string merhcant number
     */
    protected $merchant;  
    
    /**
     * @var string verification_key
     */
    protected $verification_key;   
    
    /**
     * @var string session_id the users session id.
     */
    protected $session_id;
    
    /**
     * @var string $post_destination
     */
    protected $post_destination;
    
    /**
     * @var array payment_values the values to prepare payment with
     */
    protected $payment_values;

    /**
     * @var array $optional_values
     */
    protected $optional_values;
    
    /**
     * Contructor
     * 
     * @param string $merchant merchant number
     * @param string $verification_key verification key, to verify the payment from the provider
     * @param string $session_id 
     */
    public function __construct($merchant, $verification_key, $session_id)
    {
        $this->merchant = $merchant;
        $this->verification_key = $verification_key;
        $this->session_id = $session_id;
        $this->payment_values = array();
        $this->optional_values = array();
        $this->post_destination = NULL;        
    }
    
    /**
     * sets values that should be prepared
     * 
     * @param integer $order_number number on the order to be payed.
     * @param double $price the amount to be payed.
     * @param string $currency the currency to make the payment in ('DKK', 'EUR', 'NOK', 'GBP', 'USD')
     * @param string $language the language of the payment interface (DK, GB, eg)
     * @param string $okpage the page to be forwarded to on success
     * @param string $errorpage the page to be forwarded to on failure
     * @param string $resultpage the page to notify about the result
     * @param string $inputpage page to be used to costumize 
     * 
     * @return boolean true or false
     */
    public function setPaymentValues($order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage)  
    {
        if ($this->validatePaymentFields($order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage)) {
            $this->payment_values['order_number'] = $order_number;
            $this->payment_values['amount'] = $amount;
            $this->payment_values['currency'] = $currency;
            $this->payment_values['language'] = $language;
            $this->payment_values['okpage'] = $okpage;
            $this->payment_values['errorpage'] = $errorpage;
            $this->payment_values['resultpage'] = $resultpage;
            $this->payment_values['inputpage'] = $inputpage;
            return true;
        }
        return false;        
    }
    
    /**
     * Makes it possible to set optional fields
     * 
     * @param array $values array with optional values
     */
    public function setOptionalValues($values)
    {
        $this->optional_values = $values;
        return true;
    }
    
    /**
     * Validates payment fields
     * 
     * See setPaymentValues for description of params. 
     * 
     * @return boolean true on success
     */
    protected function validatePaymentFields($order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage) 
    {
        require_once 'Ilib/Error.php';
        require_once 'Ilib/Validator.php';
        $error = new Ilib_Error;
        $validator = new Ilib_Validator($error);
        
        $validator->isString($this->verification_key, 'invalid verification key', '');
        $validator->isString($this->session_id, 'invalid session id', '');
        
        $validator->isNumeric($order_number, 'invalid order number', 'greater_than_zero');
        $validator->isNumeric($amount, 'invalid amount', 'greater_than_zero');
        // should check if it is a valid currency, DKK 
        $validator->isString($currency, 'no currency specified', '');
        if (!in_array($currency, array('DKK', 'EUR', 'NOK', 'GBP', 'USD'))) {
            $error->set('Invalid currency');
        }
        
        // should check the language, DK
        $validator->isString($language, 'invalid langugage', '');
        
        $validator->isString($okpage, 'error in ok page', '');
        $validator->isString($errorpage, 'error in error page', '');
        $validator->isString($resultpage, 'error in result page', '');
        $validator->isString($inputpage, 'error in ok page', '', 'allow_empty');
        
        if($error->isError()) {
            throw new Exception('Error in prepare payment '.implode(', ', $error->getMessage()));
        }
        
        return true;    
    }
    
    /**
     * returns the destination for the post form, should be uses in the forms action parameter
     * 
     * @return string post destination
     */
    public function getPostDestination() 
    {
        return $this->post_destination;
    }
    
    /**
     * Returns the field for posting to the payment gateway.
     * Need to be customized for each provider
     * 
     * @returns string fields
     */
    public function getPostFields() 
    {
        if (empty($this->payment_values)) {
            throw new Exception('You need to set payment values before ');
        }
        
        return false;
    }
    
    /**
     * Returns the name of the provider. Needs to be overridden in extends.
     * 
     * @return string name of provider
     */
    public function getProviderName()
    {
        return NULL;
    }
    
    /**
     * converts strings to safe to print to html
     * 
     * @input string $data
     * @return string formattet data
     */
    protected function safeToHtml($data) 
    {
        if (get_magic_quotes_gpc()) {
            $data = stripslashes($data);
        }

        return htmlspecialchars($data);
    }   
}