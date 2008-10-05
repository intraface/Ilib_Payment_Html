<?php
class Ilib_Payment_Html_Controller_Server extends k_Controller
{   
    public function getPaymentProcess() 
    {
        $server = $this->registry->get('onlinepayment:payment_html')->getPaymentProcess();
        if(!$server) {
            throw new Exception('Unable to find a payment process object');
        }
        return $server;
    }
    
    public function POST()
    {
        $this->document->template = 'Ilib/Payment/Html/templates/server-container-tpl.php';
        
        $session =& $this->registry->get('k_http_Session')->get();
        
        $response = $this->getPaymentProcess()->getPage(
            $this->POST->getArrayCopy(), 
            $session, 
            $this->url('./process'));
        
        throw new k_http_Response(200, $response);
    }
    
    public function forward($name) 
    {
        if($name == 'process') {
            $next = new Ilib_Payment_Html_Controller_Server_Process($this, $name);
            return $next->handleRequest();
        }
    }
}
