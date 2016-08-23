<?php
class Validator
{
  private $regNum;

  public function checkService()
  {
    $client = new SoapClient(
      "http://82.138.16.126:8888/TaxiPublic/Service.svc?wsdl",
      [
        'trace'        => 1,
        'encoding'     => 'utf-8',
        'exceptions'   => true,
        'cache_wsdl'   => WSDL_CACHE_NONE,
        'soap_version' => SOAP_1_1,
      ]
    );

    try {
      $requestTime = microtime(true);
      $response = $client->GetTaxiInfos(
        [
          'request' => [
            'RegNum' => $this->regNum,
          ]
        ]
      );
      $responseTime = microtime(true);
      $latency = $responseTime - $requestTime;
      $status = $this->validateFields($response);

      return [
        'status'        => $status,
        'date_request'  => date('Y-m-d H:i:s', (int)$requestTime),
        'date_response' => date('Y-m-d H:i:s', (int)$requestTime),
        'header'        => ! $status ? $client->__getLastResponseHeaders() : null,
        'body'          => ! $status ? $client->__getLastResponse() : null,
        'latency'       => $latency,
      ];
    } catch (SoapFault $f) {

    }
  }
  private function validateFields($response)
  {
    $example = [
      'GetTaxiInfosResult' => [
        'TaxiInfo' => [
          'LicenseNum'  => '02651',
          'LicenseDate' => '08.08.2011 0:00:00',
          'Name'        => 'ООО "НЖТ-ВОСТОК"',
          'OgrnNum'     => '1107746402246',
          'OgrnDate'    => '17.05.2010 0:00:00',
          'Brand'       => 'FORD',
          'Model'       => 'FOCUS',
          'RegNum'      => 'ЕМ33377',
          'Year'        => '2011',
          'BlankNum'    => '002695',
          'Info'        => '',
        ],
      ],
    ];
    $example = json_decode(json_encode($example)); // to stdObject
    return $response == $example;
  }

  public function __construct($regNum)
  {
    $this->regNum = $regNum;
  }

}
