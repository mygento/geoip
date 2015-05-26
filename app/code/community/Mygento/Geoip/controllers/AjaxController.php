<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2014 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_AjaxController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        echo 'Nope. Visit <a href="http://www.mygento.ru/">Magento development</a>';
    }

    protected function _getQuote()
    {
        return $this->_getCart()->getQuote();
    }

    protected function _getCart()
    {
        return Mage::getSingleton('checkout/cart');
    }

    public function setAction()
    {
        if ($this->getRequest()->isPost()) {
            $postData = Mage::app()->getRequest()->getPost();
            if (isset($postData['city'])) {
                Mage::helper('geoip')->setCity($postData['city']);
            }
        }
    }
}
