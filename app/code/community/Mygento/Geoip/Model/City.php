<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright 2014 NKS LLC. (https://www.mygento.ru)
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
        if (!$this->isFileExists()) {
            return null;
        }
        $SxGeo = new GeoIP_SxGeo($this->local_file);
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
