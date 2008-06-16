<?php
class Ilib_Payment_Html_Controller_Server_Process extends k_Controller
{   
    
    public function POST()
    {
        $session =& $this->registry->get('k_http_Session')->get();
        
        $go_to_url = $this->context->getPaymentProcess()->process(
            $this->POST->getArrayCopy(), 
            $session);
        
        throw new k_http_Redirect($go_to_url);
    }
    
    
}
?>
