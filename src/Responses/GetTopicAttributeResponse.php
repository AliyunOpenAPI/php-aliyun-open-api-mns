<?php

namespace Aliyun\MNS\Responses;

use Aliyun\MNS\Common\XMLParser;
use Aliyun\MNS\Constants;
use Aliyun\MNS\Exception\MnsException;
use Aliyun\MNS\Exception\TopicNotExistException;
use Aliyun\MNS\Model\TopicAttributes;

class GetTopicAttributeResponse extends BaseResponse
{

    private $attributes;


    public function __construct()
    {
        $this->attributes = null;
    }


    public function getTopicAttributes()
    {
        return $this->attributes;
    }


    public function parseResponse($statusCode, $content)
    {
        $this->statusCode = $statusCode;
        if ($statusCode == 200) {
            $this->succeed = true;
        } else {
            $this->parseErrorResponse($statusCode, $content);
        }

        $xmlReader = new \XMLReader();
        try {
            $xmlReader->XML($content);
            $this->attributes = TopicAttributes::fromXML($xmlReader);
        } catch (\Exception $e) {
            throw new MnsException($statusCode, $e->getMessage(), $e);
        } catch (\Throwable $t) {
            throw new MnsException($statusCode, $t->getMessage());
        }
    }


    public function parseErrorResponse($statusCode, $content, MnsException $exception = null)
    {
        $this->succeed = false;
        $xmlReader     = new \XMLReader();
        try {
            $xmlReader->XML($content);
            $result = XMLParser::parseNormalError($xmlReader);
            if ($result['Code'] == Constants::TOPIC_NOT_EXIST) {
                throw new TopicNotExistException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
            }
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
}
