<?php

namespace tests;

use tests\overrides\TestAwesomeMarkerAsset;
use yii\web\AssetBundle;

class AwesomeMarkerAssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        TestAwesomeMarkerAsset::register($view);
        $this->assertCount(2,$view->assetBundles);
        $this->assertTrue($view->assetBundles['tests\\overrides\\TestAwesomeMarkerAsset'] instanceof AssetBundle);
        $content = $view->render('//layouts/rawlayout.php');
        $this->assertContains('leaflet.css', $content);
        $this->assertContains('leaflet.awesome-markers.js', $content);

    }
}
