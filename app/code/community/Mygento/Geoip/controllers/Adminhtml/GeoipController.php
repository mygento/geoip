<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright 2014 NKS LLC. (https://www.mygento.ru)
 */
class Mygento_Geoip_Adminhtml_GeoipController extends Mage_Adminhtml_Controller_Action
{

    public function statusAction()
    {
        $_realSize = filesize(Mage::getModel('geoip/info')->getArchivePath());
        $_totalSize = Mage::getSingleton('core/session')->getData('_geoip_file_size');
        $result = $_totalSize ? $_realSize / $_totalSize * 100 : 0;
        $this->getResponse()->setBody($result);
    }

    public function synchronizeAction()
    {
        $result = Mage::getModel('geoip/info')->update();
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
}
