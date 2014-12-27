<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2014 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Adminhtml_GeoipController extends Mage_Adminhtml_Controller_Action {

    public function statusAction() {
        $_session=Mage::getSingleton('core/session');
        $info=Mage::getModel('geoip/info');

        $_realSize=filesize($info->getArchivePath());
        $_totalSize=$_session->getData('_geoip_file_size');
        echo $_totalSize ? $_realSize / $_totalSize * 100 : 0;
    }

    public function synchronizeAction() {
        $info=Mage::getModel('geoip/info');
        $info->update();
    }

}
