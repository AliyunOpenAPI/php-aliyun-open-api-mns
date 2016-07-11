<?php

namespace Aliyun\MNS\Http;

use Aliyun\MNS\AsyncCallback;
use Aliyun\MNS\Config;
use Aliyun\MNS\Constants;
use Aliyun\MNS\Exception\MnsException;
use Aliyun\MNS\Requests\BaseRequest;
use Aliyun\MNS\Responses\BaseResponse;
use Aliyun\MNS\Responses\MnsPromise;
use Aliyun\MNS\Signature\Signature;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Request;

class HttpClient
{

    private $client;

    private $accessId;

    private $accessKey;

    private $securityToken;


    public function __construct($endPoint, $accessId, $accessKey, $securityToken = null, Config $config = null)
    {
        if ($config == null) {
            $config = new Config;
        }
        $this->accessId      = $accessId;
        $this->accessKey     = $accessKey;
        $this->client        = new \GuzzleHttp\Client([
            'base_uri' => $endPoint,
            'defaults' => [
                'headers' => [
                    'Host' => $endPoint
                ],
                'proxy'   => $config->getProxy(),
                'expect'  => $config->getExpectContinue(),
                'timeout' => $config->getRequestTimeout()
            ]
        ]);
        $this->securityToken = $securityToken;
    }


    private function addRequiredHeaders(BaseRequest &$request)
    {
        $body        = $request->generateBody();
        $queryString = $request->generateQueryString();

        $request->setBody($body);
        $request->setQueryString($queryString);

        if ($body != null) {
            $request->setHeader(Constants::CONTENT_LENGTH, strlen($body));
        }
        $request->setHeader('Date', gmdate(Constants::GMT_DATE_FORMAT));
        if ( ! $request->isHeaderSet(Constants::CONTENT_TYPE)) {
            $request->setHeader(Constants::CONTENT_TYPE, 'text/xml');
        }
        $request->setHeader(Constants::MNS_VERSION_HEADER, Constants::MNS_VERSION);

        if ($this->securityToken != null) {
            $request->setHeader(Constants::SECURITY_TOKEN, $this->securityToken);
        }

        $sign = Signature::SignRequest($this->accessKey, $request);
        $request->setHeader(Constants::AUTHORIZATION, Constants::MNS . " " . $this->accessId . ":" . $sign);
    }


    public function sendRequestAsync(BaseRequest $request, BaseResponse &$response, AsyncCallback $callback = null)
    {
        $promise = $this->sendRequestAsyncInternal($request, $response, $callback);

        return new MnsPromise($promise, $response);
    }


    public function sendRequest(BaseRequest $request, BaseResponse &$response)
    {
        $promise = $this->sendRequestAsync($request, $response);

        return $promise->wait();
    }


    private function sendRequestAsyncInternal(BaseRequest &$request, BaseResponse &$response, AsyncCallback $callback = null)
    {
        $this->addRequiredHeaders($request);

        $parameters  = array( 'exceptions' => false, 'http_errors' => false );
        $queryString = $request->getQueryString();
        $body        = $request->getBody();
        if ($queryString != null) {
            $parameters['query'] = $queryString;
        }
        if ($body != null) {
            $parameters['body'] = $body;
        }

        $request = new Request(strtoupper($request->getMethod()), $request->getResourcePath(), $request->getHeaders());
        try {
            if ($callback != null) {
                return $this->client->sendAsync($request, $parameters)->then(function ($res) use (&$response, $callback) {
                    try {
                        $response->parseResponse($res->getStatusCode(), $res->getBody());
                        $callback->onSucceed($response);
                    } catch (MnsException $e) {
                        $callback->onFailed($e);
                    }
                });
            } else {
                return $this->client->sendAsync($request, $parameters);
            }
        } catch (TransferException $e) {
            $message = $e->getMessage();
            if ($e->hasResponse()) {
                $message = $e->getResponse()->getBody();
            }
            throw new MnsException($e->getCode(), $message, $e);
        }
    }
}
