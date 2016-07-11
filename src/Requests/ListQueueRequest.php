<?php

namespace Aliyun\MNS\Requests;

class ListQueueRequest extends BaseRequest
{

    private $retNum;

    private $prefix;

    private $marker;


    public function __construct($retNum = null, $prefix = null, $marker = null)
    {
        parent::__construct('get', 'queues');

        $this->setRetNum($retNum);
        $this->setPrefix($prefix);
        $this->setMarker($marker);
    }


    public function getRetNum()
    {
        return $this->retNum;
    }


    public function setRetNum($retNum)
    {
        $this->retNum = $retNum;
        if ($retNum != null) {
            $this->setHeader("x-mns-ret-number", $retNum);
        } else {
            $this->removeHeader("x-mns-ret-number");
        }
    }


    public function getPrefix()
    {
        return $this->prefix;
    }


    public function setPrefix($prefix)
    {
        $this->prefis = $prefix;
        if ($prefix != null) {
            $this->setHeader("x-mns-prefix", $prefix);
        } else {
            $this->removeHeader("x-mns-prefix");
        }
    }


    public function getMarker()
    {
        return $this->marker;
    }


    public function setMarker($marker)
    {
        $this->marker = $marker;
        if ($marker != null) {
            $this->setHeader("x-mns-marker", $marker);
        } else {
            $this->removeHeader("x-mns-marker");
        }
    }


    public function generateBody()
    {
        return null;
    }


    public function generateQueryString()
    {
        return null;
    }
}
