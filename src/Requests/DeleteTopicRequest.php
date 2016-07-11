<?php

namespace Aliyun\MNS\Requests;

class DeleteTopicRequest extends BaseRequest
{

    private $topicName;


    public function __construct($topicName)
    {
        parent::__construct('delete', 'topics/' . $topicName);
        $this->topicName = $topicName;
    }


    public function getTopicName()
    {
        return $this->topicName;
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
