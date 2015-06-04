<?php

/**
 *
 *
 * @category Mygento
 * @package Mygento_Geoip
 * @copyright Copyright © 2014 NKS LLC. (http://www.mygento.ru)
 */
class Mygento_Geoip_Model_Info extends Mygento_Geoip_Model_Abstract
{

    public function getDatFileDownloadDate()
    {
        $io = new Varien_Io_File();
        return $io->fileExists($this->local_file, true) ? filemtime($this->local_file) : 0;
    }
}
