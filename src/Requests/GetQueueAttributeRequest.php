<?php

namespace Aliyun\MNS\Requests;

class GetQueueAttributeRequest extends BaseRequest
{

    private $queueName;


    public function __construct($queueName)
    {
        parent::__construct('get', 'queues/' . $queueName);

        $this->queueName = $queueName;
    }


    public function getQueueName()
    {
        return $this->queueName;
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
