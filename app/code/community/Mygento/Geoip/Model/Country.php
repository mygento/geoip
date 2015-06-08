<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2015 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Model_Country extends Mygento_Geoip_Model_Abstract
{

    private $country;

    public function __construct()
    {
        parent::__construct();
        if (!Mage::getSingleton('core/session')->getGeoCountry()) {
            $this->country = $this->getCountryByIp(Mage::helper('core/http')->getRemoteAddr());
            Mage::getSingleton('core/session')->setGeoCountry($this->country);
        }
    }

    public function getCountryByIp($ip)
    {
        if (!$this->isFileExists()) {
            return null;
        }
        $SxGeo = new GeoIP_SxGeo($this->local_file);
        $country = $SxGeo->getCountry($ip);
        if ($country) {
            return $country;
        }
        return Mage::getStoreConfig('geoip/general/country');
    }

    public function getCity()
    {
        if (!$this->city) {
            $this->city = $this->getCityByIp(Mage::helper('core/http')->getRemoteAddr());
        }
        return $this->city;
    }
}
