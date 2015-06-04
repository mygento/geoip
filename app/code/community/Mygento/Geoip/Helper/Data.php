<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2014 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getSize($file)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        return curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    }

    public function unGZip($archive, $destination)
    {
        $zip = new ZipArchive;
        if ($zip->open($archive) === true) {
            $zip->extractTo(Mage::getBaseDir('var') . DS . 'geoip' . DS);
            $zip->close();
            return true;
        }
        return false;
    }

    public function init()
    {
        if (!Mage::getSingleton('core/session')->getGeoCity()) {
            $geoIP = Mage::getSingleton('geoip/city');
            Mage::getSingleton('core/session')->setGeoCity($geoIP->getCity());
        }
    }

    public function setCity($city)
    {
        Mage::getSingleton('core/session')->setGeoCity($city);
        $this->_getQuote()->getShippingAddress()->setCity($city);
        $this->_getQuote()->save();
    }

    public function _getQuote()
    {
        return Mage::getModel('checkout/cart')->getQuote();
    }

    public function getCurrentCity()
    {
        return Mage::getSingleton('core/session')->getGeoCity();
    }
}
