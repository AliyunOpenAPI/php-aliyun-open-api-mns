<?php

namespace Aliyun\MNS\Exception;

class MnsException extends \RuntimeException
{

    private $mnsErrorCode;

    private $requestId;

    private $hostId;


    public function __construct($code, $message, $previousException = null, $mnsErrorCode = null, $requestId = null, $hostId = null)
    {
        parent::__construct($message, $code, $previousException);

        if ($mnsErrorCode == null) {
            if ($code >= 500) {
                $mnsErrorCode = "ServerError";
            } else {
                $mnsErrorCode = "ClientError";
            }
        }
        $this->mnsErrorCode = $mnsErrorCode;

        $this->requestId = $requestId;
        $this->hostId    = $hostId;
    }


    public function __toString()
    {
        $str = "Code: " . $this->getCode() . " Message: " . $this->getMessage();
        if ($this->mnsErrorCode != null) {
            $str .= " MnsErrorCode: " . $this->mnsErrorCode;
        }
        if ($this->requestId != null) {
            $str .= " RequestId: " . $this->requestId;
        }
        if ($this->hostId != null) {
            $str .= " HostId: " . $this->hostId;
        }

        return $str;
    }


    public function getMnsErrorCode()
    {
        return $this->mnsErrorCode;
    }


    public function getRequestId()
    {
        return $this->requestId;
    }


    public function getHostId()
    {
        return $this->hostId;
    }
}
