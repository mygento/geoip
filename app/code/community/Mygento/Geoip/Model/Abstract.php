<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2015 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Model_Abstract
{

    protected $local_dir;
    protected $local_file;
    protected $local_archive;
    protected $remote_archive;

    public function __construct()
    {
        $this->local_dir = Mage::getBaseDir('var') . DS . 'geoip';
        $this->local_file = $this->local_dir . DS . 'SxGeoCity.dat';
        $this->local_archive = $this->local_dir . DS . 'SxGeoCity_utf8.zip';
        $this->remote_archive = 'http://sypexgeo.net/files/SxGeoCity_utf8.zip';
    }

    public function getArchivePath()
    {
        return $this->local_archive;
    }

    public function checkFilePermissions()
    {
        $io = new Varien_Io_File();
        if (!$io->isWriteable($this->local_dir)) {
            return 'folder is not writable';
        }
        $io->checkAndCreateFolder($this->local_dir);
        return '';
    }

    public function update()
    {
        $helper = Mage::helper('geoip');

        $ret = array('status' => 'error');

        if ($permissions_error = $this->checkFilePermissions()) {
            $ret['message'] = $permissions_error;
            return $ret;
        }
        $remote_file_size = $helper->getSize($this->remote_archive);
        if ($remote_file_size < 100000) {
            $ret['message'] = $helper->__('You are banned from downloading the file. Please try again in several hours.');
            return $ret;
        }

        /** @var $_session Mage_Core_Model_Session */
        $_session = Mage::getSingleton('core/session');
        $_session->setData('_geoip_file_size', $remote_file_size);

        $ch = curl_init($this->remote_archive);
        $fp = fopen($this->local_archive, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            $ret['message'] = $helper->__('Failed to Download Zip');
            fclose($fp);
            return $ret;
        }
        curl_close($ch);
        fclose($fp);

        $arch_size = new Zend_Validate_File_Size(array('min' => 1000));

        if (!$arch_size->isValid($this->local_archive)) {
            $ret['message'] = $helper->__('Download failed.');
            return $ret;
        }
        if (!$helper->unGZip($this->local_archive, $this->local_dir)) {
            $ret['message'] = $helper->__('UnGzipping failed');
            return $ret;
        }
        $ret['status'] = 'success';
        $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $ret['date'] = Mage::app()->getLocale()->date(filemtime($this->local_file))->toString($format);
        return $ret;
    }
}
