<?php
/**
 * To control input page for online payments
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Html_Provider
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Html_Input
{
    /**
     * @var string merchant number
     */
    protected $merchant; 
    
    /**
     * @var string verification key
     */
    protected $verification_key;
    
    /**
     * @var string session_id
     */
    protected $session_id;
    
    /**
     * Constructor
     * 
     * @param string $merchant merchant number
     * @param string $verification_key verification key
     * @param string $session_id session id
     */
    public function __construct($merchant, $verification_key, $session_id)
    {
        $this->merchant = $merchant;
        $this->verification_key = $verification_key; 
        $this->session_id = $session_id;
    }
    
    /**
     * Returns a path to a input template matching the provider.
     * Should be replaced in local classes
     * 
     * @return string template path
     */
    public function getInputTemplatePath() 
    {
        return false;
    }
    
    /**
     * Returns the url to set in front of local urls, to make it secured
     * Should be replaced in local classes
     * 
     * @return string secure tunnel url
     */
    public function getSecureTunnelUrl()
    {
        return false;
    }
    
    /**
     * returns merchant number
     * 
     * @return string merchant number
     */
    public function getMerchant() 
    {
        return $this->merchant;
    }
    
    /**
     * returns the verification key
     * 
     * @return string verification key
     */
    public function getVerificationKey()
    {
        return $this->verification_key;
    }
}