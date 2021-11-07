<?php

namespace Mydevcodes\IpaymerPhp\Utils;

use GuzzleHttp\Client;
use Mydevcodes\IpaymerPhp\Exceptions\ValidationException;

class Request
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var
     */
    public $httpStatus;
    /**
     * @var
     */
    public $httpHeaders;
    /**
     * @var
     */
    public $httpBody;
    /**
     * @var
     */
    public $httpMessage;

    /**
     * Requests constructor.
     * @param Configuration $configuration
     */
    public function __construct(
        Configuration $configuration
    ) {
        $this->configuration = $configuration;
    }

    /**
     * @param string $url
     * @throws ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAPI(string $url)
    {
        try {
            $client = new Client(
                $this->getHeaders()
            );
            $request = $client->request(
                'GET',
                Routes::API_URL . $url
            );

            $this->httpStatus = $request->getStatusCode();
            $this->httpHeaders = $request->getHeaders();
            $this->httpBody = json_decode($request->getBody()->getContents());
        } catch (\Exception $e) {
            throw ValidationException::authorizationFailed();
        }
    }

    /**
     * @param string $url
     * @param $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ValidationException
     */
    public function postAPI(string $url, $data)
    {
        try {
            $client = new Client(
                $this->getHeaders()
            );
            $request = $client->request(
                'POST',
                Routes::API_URL . $url,
                [
                    'json' => $data,
                ]
            );

            $this->httpStatus = $request->getStatusCode();
            $this->httpHeaders = $request->getHeaders();
            $this->httpBody = json_decode($request->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
//            HandleExceptions::handle($e->getCode());
        }
    }

    protected function getHeaders(): array
    {
        return [
            'headers' => [
                'secret-key' => $this->configuration->getSecretKey(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ];
    }

    public function prepareResponse($message = ''): array
    {
        return [
            'status' => $this->httpStatus,
            'data' => isset($this->httpBody) ? $this->httpBody : NULL,
            'message' => $message
        ];
    }
}