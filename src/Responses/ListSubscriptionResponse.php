<?php

namespace Aliyun\MNS\Responses;

use Aliyun\MNS\Exception\MnsException;
use Aliyun\MNS\Common\XMLParser;

class ListSubscriptionResponse extends BaseResponse
{

    private $SubscriptionNames;

    private $nextMarker;


    public function __construct()
    {
        $this->SubscriptionNames = array();
        $this->nextMarker        = null;
    }


    public function isFinished()
    {
        return $this->nextMarker == null;
    }


    public function getSubscriptionNames()
    {
        return $this->SubscriptionNames;
    }


    public function getNextMarker()
    {
        return $this->nextMarker;
    }


    public function parseResponse($statusCode, $content)
    {
        $this->statusCode = $statusCode;
        if ($statusCode != 200) {
            $this->parseErrorResponse($statusCode, $content);

            return;
        }

        $this->succeed = true;
        $xmlReader     = $this->loadXmlContent($content);
        try {
            while ($xmlReader->read()) {
                if ($xmlReader->nodeType == \XMLReader::ELEMENT) {
                    switch ($xmlReader->name) {
                        case 'SubscriptionURL':
                            $xmlReader->read();
                            if ($xmlReader->nodeType == \XMLReader::TEXT) {
                                $subscriptionName          = $this->getSubscriptionNameFromSubscriptionURL($xmlReader->value);
                                $this->SubscriptionNames[] = $subscriptionName;
                            }
                            break;
                        case 'NextMarker':
                            $xmlReader->read();
                            if ($xmlReader->nodeType == \XMLReader::TEXT) {
                                $this->nextMarker = $xmlReader->value;
                            }
                            break;
                    }
                }
            }
        } catch (\Exception $e) {
            throw new MnsException($statusCode, $e->getMessage(), $e);
        } catch (\Throwable $t) {
            throw new MnsException($statusCode, $t->getMessage());
        }
    }


    public function parseErrorResponse($statusCode, $content, MnsException $exception = null)
    {
        $this->succeed = false;
        $xmlReader     = $this->loadXmlContent($content);
        try {
            $result = XMLParser::parseNormalError($xmlReader);

            throw new MnsException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
        } catch (\Exception $e) {
            if ($exception != null) {
                throw $exception;
            } elseif ($e instanceof MnsException) {
                throw $e;
            } else {
                throw new MnsException($statusCode, $e->getMessage());
            }
        } catch (\Throwable $t) {
            throw new MnsException($statusCode, $t->getMessage());
        }
    }


    private function getSubscriptionNameFromSubscriptionURL($subscriptionURL)
    {
        $pieces = explode("/", $subscriptionURL);
        if (count($pieces) == 7) {
            return $pieces[6];
        }

        return "";
    }
}
