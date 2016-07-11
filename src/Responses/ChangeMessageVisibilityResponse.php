<?php

namespace Aliyun\MNS\Responses;

use Aliyun\MNS\Common\XMLParser;
use Aliyun\MNS\Constants;
use Aliyun\MNS\Exception\InvalidArgumentException;
use Aliyun\MNS\Exception\MessageNotExistException;
use Aliyun\MNS\Exception\MnsException;
use Aliyun\MNS\Exception\QueueNotExistException;
use Aliyun\MNS\Exception\ReceiptHandleErrorException;
use Aliyun\MNS\Model\Message;

class ChangeMessageVisibilityResponse extends BaseResponse
{

    protected $receiptHandle;

    protected $nextVisibleTime;


    public function __construct()
    {
    }


    public function getReceiptHandle()
    {
        return $this->receiptHandle;
    }


    public function getNextVisibleTime()
    {
        return $this->nextVisibleTime;
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
            $message               = Message::fromXML($xmlReader);
            $this->receiptHandle   = $message->getReceiptHandle();
            $this->nextVisibleTime = $message->getNextVisibleTime();
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

            if ($result['Code'] == Constants::INVALID_ARGUMENT) {
                throw new InvalidArgumentException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
            }
            if ($result['Code'] == Constants::QUEUE_NOT_EXIST) {
                throw new QueueNotExistException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
            }
            if ($result['Code'] == Constants::MESSAGE_NOT_EXIST) {
                throw new MessageNotExistException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
            }
            if ($result['Code'] == Constants::RECEIPT_HANDLE_ERROR) {
                throw new ReceiptHandleErrorException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
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
