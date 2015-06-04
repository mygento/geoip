<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2014 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Block_System_Config_Synchronize extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mygento/geoip/system/config/synchronize.phtml');
    }

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     *
     * @SuppressWarnings("unused")
     */

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }

    public function getAjaxSyncUrl()
    {
        return Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/geoip/synchronize');
    }

    public function getAjaxStatusUpdateUrl()
    {
        return Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/geoip/status');
    }

    public function getButtonHtml()
    {
        /** @var $button Mage_Adminhtml_Block_Widget_Button */
        $button = $this->getLayout()->createBlock('adminhtml/widget_button');
        $button->setData(array(
            'id' => 'synchronize_button',
            'label' => $this->helper('adminhtml')->__('Synchronize'),
            'onclick' => 'javascript:synchronize(); return false;'
        ));

        return $button->toHtml();
    }

    public function getSyncStorageParams()
    {
        $flag = Mage::getSingleton('core/file_storage')->getSyncFlag();
        $flagData = $flag->getFlagData();

        if ($flag->getState() == Mage_Core_Model_File_Storage_Flag::STATE_NOTIFIED && is_array($flagData) && isset($flagData['destination_storage_type']) && $flagData['destination_storage_type'] != '' && isset($flagData['destination_connection_name'])
        ) {
            $storageType = $flagData['destination_storage_type'];
            $connectionName = $flagData['destination_connection_name'];
        } else {
            $storageType = Mage_Core_Model_File_Storage::STORAGE_MEDIA_FILE_SYSTEM;
            $connectionName = '';
        }

        return array(
            'storage_type' => $storageType,
            'connection_name' => $connectionName
        );
    }
}
