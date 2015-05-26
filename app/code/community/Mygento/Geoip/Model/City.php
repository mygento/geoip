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

        $this->city = $this->getCityByIp(Mage::helper('core/http')->getRemoteAddr());
    }

    public function getCityByIp($ip)
    {
        #$this->local_file
        include_once Mage::getBaseDir('lib') . DS . 'geoip' . DS . 'SxGeo.php';
        $SxGeo = new SxGeo(Mage::getBaseDir('var') . '/geoip/SxGeoCity.dat');
        $city_full = $SxGeo->getCity($ip);
        unset($SxGeo);
        if ($city_full['city']['name_ru'] != '') {
            return $city_full['city']['name_ru'];
        } else {
            return Mage::getStoreConfig('geoip/general/city');
        }
    }

    public function getCity()
    {
        return $this->city;
    }
}
