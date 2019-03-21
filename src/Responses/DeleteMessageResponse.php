<?php

namespace Aliyun\MNS\Responses;

use Aliyun\MNS\Constants;
use Aliyun\MNS\Exception\MnsException;
use Aliyun\MNS\Exception\QueueNotExistException;
use Aliyun\MNS\Exception\InvalidArgumentException;
use Aliyun\MNS\Exception\ReceiptHandleErrorException;
use Aliyun\MNS\Common\XMLParser;

class DeleteMessageResponse extends BaseResponse
{

    public function __construct()
    {
    }


    public function parseResponse($statusCode, $content)
    {
        $this->statusCode = $statusCode;
        if ($statusCode == 204) {
            $this->succeed = true;
        } else {
            $this->parseErrorResponse($statusCode, $content);
        }
    }


    public function parseErrorResponse($statusCode, $content, MnsException $exception = null)
    {
        $this->succeed = false;
        $xmlReader     = $this->loadXmlContent($content);
        try {
            $result = XMLParser::parseNormalError($xmlReader);

            if ($result['Code'] == Constants::INVALID_ARGUMENT) {
                throw new InvalidArgumentException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
            }
            if ($result['Code'] == Constants::QUEUE_NOT_EXIST) {
                throw new QueueNotExistException($statusCode, $result['Message'], $exception, $result['Code'], $result['RequestId'], $result['HostId']);
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
