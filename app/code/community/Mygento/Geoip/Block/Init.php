<?php

class Mygento_Geoip_Block_Init extends Mage_Core_Block_Template
{

    public function __construct()
    {
        if (!Mage::getStoreConfig('geoip/general/enabled') || !Mage::getStoreConfig('geoip/general/layout')) {
            return;
        }
        Mage::getSingleton('geoip/city');
        Mage::getSingleton('geoip/country');
    }
}
