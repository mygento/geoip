<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2015 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Test_Config_Base extends EcomDev_PHPUnit_Test_Case_Config
{

    /**
     * @test
     */
    public function testValidCodepool()
    {
        $this->assertModuleCodePool('community');
    }

    /**
     * @test
     */
    public function testBlockAlias()
    {
        $this->assertBlockAlias('geoip/version', 'Mygento_Geoip_Block_Version');
    }

    /**
     * @test
     */
    public function testModelAlias()
    {
        $this->assertModelAlias('geoip/city', 'Mygento_Geoip_Model_City');
        $this->assertModelAlias('geoip/country', 'Mygento_Geoip_Model_Country');
        $this->assertModelAlias('geoip/info', 'Mygento_Geoip_Model_Info');
    }

    /**
     * @test
     */
    public function testConfig()
    {
        $this->assertConfigNodeHasChild('global/helpers', 'geoip');
        $this->assertConfigNodeValue('global/helpers/geoip/class', 'Mygento_Geoip_Helper');
        $this->assertConfigNodeHasChild('global/models', 'geoip');
        $this->assertConfigNodeValue('global/models/geoip/class', 'Mygento_Geoip_Model');
        $this->assertConfigNodeHasChild('global/blocks', 'geoip');
        $this->assertConfigNodeValue('global/blocks/geoip/class', 'Mygento_Geoip_Block');
    }

    /**
     * @test
     */
    public function testDefaults()
    {
        // the module namespace
        $this->assertConfigNodeHasChild('default', 'geoip');

        // general presets
        $this->assertConfigNodeHasChild('default/geoip', 'general');
        $this->assertConfigNodeHasChild('default/geoip/general', 'enabled');
        $this->assertConfigNodeHasChild('default/geoip/general', 'layout');
        $this->assertConfigNodeHasChild('default/geoip/general', 'city');
        $this->assertConfigNodeHasChild('default/geoip/general', 'country');

        $this->assertEquals("0", Mage::getStoreConfig('geoip/general/enabled'));
        $this->assertEquals("1", Mage::getStoreConfig('geoip/general/layout'));
    }

    /**
     * @test
     */
    public function testModelResourceAlias()
    {
        //$this->assertResourceModelAlias('geoip/job', 'Mygento_Geoip_Model_Resource_Job');
    }

    /**
     * @test
     */
    public function testHelperAlias()
    {
        $this->assertHelperAlias('geoip', 'Mygento_Geoip_Helper_Data');
    }

    /**
     * @test
     */
    public function testEvent()
    {
    }

    /**
     * @test
     */
    public function testLayout()
    {
        $this->assertLayoutFileDefined('frontend', 'mygento/geoip.xml');
        $this->assertLayoutFileExists('frontend', 'mygento/geoip.xml');
    }
}
