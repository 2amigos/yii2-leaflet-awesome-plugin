<?php

namespace tests\overrides;

use dosamigos\leaflet\plugins\awesome\AwesomeMarker;

class TestAwesomeMarker extends AwesomeMarker
{
    public function registerAssetBundle($view)
    {
        TestAwesomeMarkerAsset::register($view);
        return $this;
    }
}
