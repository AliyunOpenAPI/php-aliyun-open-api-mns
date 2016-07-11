<?php

namespace Aliyun\MNS\Requests;

use Aliyun\MNS\Constants;
use Aliyun\MNS\Traits\MessagePropertiesForPublish;

class PublishMessageRequest extends BaseRequest
{

    use MessagePropertiesForPublish;

    private $topicName;


    public function __construct($messageBody)
    {
        parent::__construct('post', null);

        $this->topicName   = null;
        $this->messageBody = $messageBody;
    }


    public function getTopicName()
    {
        return $this->topicName;
    }


    public function setTopicName($topicName)
    {
        $this->topicName    = $topicName;
        $this->resourcePath = 'topics/' . $topicName . '/messages';
    }


    public function generateBody()
    {
        $xmlWriter = new \XMLWriter;
        $xmlWriter->openMemory();
        $xmlWriter->startDocument("1.0", "UTF-8");
        $xmlWriter->startElementNS(null, "Message", Constants::MNS_XML_NAMESPACE);
        $this->writeMessagePropertiesForPublishXML($xmlWriter);
        $xmlWriter->endElement();
        $xmlWriter->endDocument();

        return $xmlWriter->outputMemory();
    }


    public function generateQueryString()
    {
        return null;
    }
}
