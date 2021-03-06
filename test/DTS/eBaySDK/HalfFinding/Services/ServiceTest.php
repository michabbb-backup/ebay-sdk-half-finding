<?php
use DTS\eBaySDK\HalfFinding\Services\HalfFindingBaseService;
use DTS\eBaySDK\HalfFinding\Mocks\Service;
use DTS\eBaySDK\Mocks\HttpClient;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->httpClient = new HttpClient();
        $this->service = new Service(array(), $this->httpClient);
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\HalfFinding\Mocks\Service', $this->service);
    }

    public function testEbayHeaders()
    {
        $this->service->config('appId', '321');

        $this->service->testOperation();

        // Test required headers first.
        $this->assertArrayHasKey(HalfFindingBaseService::HDR_APP_ID , $this->httpClient->headers);
        $this->assertEquals('321', $this->httpClient->headers[HalfFindingBaseService::HDR_APP_ID]);

        $this->assertArrayHasKey(HalfFindingBaseService::HDR_OPERATION_NAME, $this->httpClient->headers);
        $this->assertEquals('testOperation', $this->httpClient->headers[HalfFindingBaseService::HDR_OPERATION_NAME]);

        // Test that optional headers have not been set until they have been configured.
        $this->assertArrayNotHasKey(HalfFindingBaseService::HDR_API_VERSION, $this->httpClient->headers);
        $this->assertArrayNotHasKey(HalfFindingBaseService::HDR_GLOBAL_ID, $this->httpClient->headers);

        // Now configure optional headers.
        $this->service->config('apiVersion', '123');
        $this->service->config('globalId', '999');

        $this->service->testOperation();

        $this->assertArrayHasKey(HalfFindingBaseService::HDR_API_VERSION, $this->httpClient->headers);
        $this->assertEquals('123', $this->httpClient->headers[HalfFindingBaseService::HDR_API_VERSION]);

        $this->assertArrayHasKey(HalfFindingBaseService::HDR_GLOBAL_ID, $this->httpClient->headers);
        $this->assertEquals('999', $this->httpClient->headers[HalfFindingBaseService::HDR_GLOBAL_ID]);
    }
}
