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
        $this->getResponse()->setBody('Nope. Visit <a href="http://www.mygento.ru/">Magento development</a>');
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
