<?php
require __DIR__ . '/artifacts/dts-half-finding.phar';

$service = new \DTS\eBaySDK\HalfFinding\Services\HalfFindingService(array(
    'apiVersion' => '123'
));

echo 'Version=' . \DTS\eBaySDK\HalfFinding\Services\HalfFindingService::VERSION;
