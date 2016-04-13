Mygento GeoIP
=====
[![Build Status](https://travis-ci.org/mygento/geoip.svg?branch=master)](https://travis-ci.org/mygento/geoip) [![Code Climate](https://codeclimate.com/github/mygento/geoip/badges/gpa.svg)](https://codeclimate.com/github/mygento/geoip) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mygento/geoip/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mygento/geoip/?branch=master)

Use Sypex Geo DB in Magento

База Sypex Geo - по ходу использования и тестов  - в РФ определяет города лучше аналогичных публичных баз.


USAGE:
1. Insert into head.phtml:  <?php Mage::helper('geoip')->init(); ?><br/>
2. Get current city: <?php echo Mage::helper('geoip')->getCurrentCity(); ?><br/>
3. You can set current city by sending POST ($postData['city'])) to geoip/ajax/set controller.<br/>
