Mygento_Geoip
=====

Use Sypex Geo DB in Magento

База Sypex Geo - по ходу использования и тестов  - в РФ определяет города лучше аналогичных публичных баз.


USAGE:
1. Insert into head.phtml:  <?php Mage::helper('geoip')->init(); ?>
2. Get current city: <?php echo Mage::helper('geoip')->getCurrentCity(); ?>
3. You can set current city by sending POST ($postData['city'])) to geoip/ajax/set controller.