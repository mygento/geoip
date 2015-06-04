<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2015 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case
{

    /**
     * @test
     * @return Mygento_Cdn_Helper_Data
     */
    public function checkClass()
    {
        /* @var Mygento_Geoip_Helper_Data $helper */
        $helper = Mage::helper('geoip');

        $this->assertInstanceOf('Mygento_Geoip_Helper_Data', $helper);
        return $helper;
    }
}
