<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initView()
    {
        // Initialize view
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('Nemonic');
        
        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
                                                                             'ViewRenderer'
                                                                             );
        $viewRenderer->setView($view);
        
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }
    
    protected function _initRequest()
    {
        // Ensure the front controller is initialized
        $this->bootstrap('FrontController');
        
        // Retrieve the front controller from the bootstrap registry
        $front = $this->getResource('FrontController');
        
        $request = new Zend_Controller_Request_Http();
        $request->setBaseUrl('/foo');
        $front->setRequest($request);
        
        // Ensure the request is stored in the bootstrap registry
        return $request;
    }
}

