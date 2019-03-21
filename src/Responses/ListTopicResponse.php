<?php

namespace Aliyun\MNS\Responses;

use Aliyun\MNS\Exception\MnsException;
use Aliyun\MNS\Common\XMLParser;

class ListTopicResponse extends BaseResponse
{

    private $topicNames;

    private $nextMarker;


    public function __construct()
    {
        $this->topicNames = array();
        $this->nextMarker = null;
    }


    public function isFinished()
    {
        return $this->nextMarker == null;
    }


    public function getTopicNames()
    {
        return $this->topicNames;
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
                        case 'TopicURL':
                            $xmlReader->read();
                            if ($xmlReader->nodeType == \XMLReader::TEXT) {
                                $topicName          = $this->getTopicNameFromTopicURL($xmlReader->value);
                                $this->topicNames[] = $topicName;
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


    private function getTopicNameFromTopicURL($topicURL)
    {
        $pieces = explode("/", $topicURL);
        if (count($pieces) == 5) {
            return $pieces[4];
        }

        return "";
    }
}
