<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright 2014 NKS LLC. (https://www.mygento.ru)
 */
class Mygento_Geoip_Model_Detect extends Mygento_Geoip_Model_Abstract
{

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
        return null;
    }
}
