<?php

namespace tests;


use dosamigos\leaflet\plugins\awesome\AwesomeMarker;
use tests\overrides\TestAwesomeMarker;

class AwesomeMarkerTest extends TestCase
{
    public function testMake()
    {
        $plugin = new AwesomeMarker();
        $icon = $plugin->make('rocket');

        $this->assertEquals('L.AwesomeMarkers.icon({"icon":"rocket"})', $icon);
    }

    public function testEncode()
    {
        $plugin = new AwesomeMarker(['icon' => 'rocket']);

        $this->assertEquals('plugin:awesomemarker', $plugin->getPluginName());

        $contents = $plugin->encode();

        $this->assertEquals('L.AwesomeMarkers.icon({"icon":"rocket"})', $contents);

        $plugin->icon = null;
        $this->assertEmpty($plugin->encode());

        $plugin->icon = 'rocket';
        $plugin->name = 'testName';
        $this->assertEquals('var testName = L.AwesomeMarkers.icon({"icon":"rocket"});', $plugin->encode());
    }

    public function testRegister()
    {
        $view = $this->getView();
        $plugin = new TestAwesomeMarker();

        $this->assertEquals($plugin, $plugin->registerAssetBundle($view));

        $this->assertCount(2, $view->assetBundles);

        $this->assertArrayHasKey('tests\overrides\TestAwesomeMarkerAsset', $view->assetBundles);

        $this->assertEquals(
            'js/leaflet.awesome-markers.js',
            $view->assetBundles['tests\overrides\TestAwesomeMarkerAsset']->js[0]
        );
    }

}
