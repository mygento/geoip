<?php

class Mygento_Geoip_Block_Version extends Mage_Adminhtml_Block_Abstract implements Varien_Data_Form_Element_Renderer_Interface
{

    private $_name = 'cdn';
    private $_full = 'Mygento_Geoip';
    private $_url = '/modules/geoip.html';

    /**
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     *
     * @SuppressWarnings("unused")
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, 'http://www.mygento.ru/extension/module/index/name/' . $this->_name . '/version/' . Mage::getConfig()->getNode('modules/' . $this->_full . '/version'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $data = json_decode(curl_exec($curl));
            curl_close($curl);
        }
        $info = '<fieldset class="config' . (!$data->result ? ' success-msg' : ' error-msg') . '" style="padding-left:30px;">' .
            '<img src="//www.mygento.ru/media/favicon/default/favicon.png" width="16" height="16" />' .
            $this->__('Mygento GeoIP version: %s', Mage::getConfig()->getNode('modules/' . $this->_full . '/version'));
        $info.='<a style="float:right" target="_blank" href="' . $this->_url . '">' . ($data->result ? $this->__('Check for update') . ' [' . $data->version . ']' : $this->__('Module page')) . '</a></fieldset>';
        return $info;
    }
}
