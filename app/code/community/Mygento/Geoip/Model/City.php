<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2014 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Model_City extends Mygento_Geoip_Model_Abstract
{

    private $city;

    public function __construct()
    {
        parent::__construct();
        if (!Mage::getSingleton('core/session')->getGeoCity()) {
            $this->city = $this->getCityByIp(Mage::helper('core/http')->getRemoteAddr());
            Mage::getSingleton('core/session')->setGeoCity($this->city);
        }
    }

    public function getCityByIp($ip)
    {
        $SxGeo = new GeoIP_SxGeo(Mage::getBaseDir('var') . DS . 'geoip' . DS . 'SxGeoCity.dat');
        $city_full = $SxGeo->getCity($ip);
        unset($SxGeo);
        if ($city_full['city']['name_ru'] != '') {
            return $city_full['city']['name_ru'];
        }
        return Mage::getStoreConfig('geoip/general/city');
    }

    public function getCity()
    {
        if (!$this->city) {
            $this->city = $this->getCityByIp(Mage::helper('core/http')->getRemoteAddr());
        }
        return $this->city;
    }
}
