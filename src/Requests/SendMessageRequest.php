<?php

namespace Aliyun\MNS\Requests;

use Aliyun\MNS\Constants;
use Aliyun\MNS\Traits\MessagePropertiesForSend;

class SendMessageRequest extends BaseRequest
{

    use MessagePropertiesForSend;

    private $queueName;


    public function __construct($messageBody, $delaySeconds = null, $priority = null)
    {
        parent::__construct('post', null);

        $this->queueName    = null;
        $this->messageBody  = $messageBody;
        $this->delaySeconds = $delaySeconds;
        $this->priority     = $priority;
    }


    public function getQueueName()
    {
        return $this->queueName;
    }


    public function setQueueName($queueName)
    {
        $this->queueName    = $queueName;
        $this->resourcePath = 'queues/' . $queueName . '/messages';
    }


    public function generateBody()
    {
        $xmlWriter = new \XMLWriter;
        $xmlWriter->openMemory();
        $xmlWriter->startDocument("1.0", "UTF-8");
        $xmlWriter->startElementNS(null, "Message", Constants::MNS_XML_NAMESPACE);
        $this->writeMessagePropertiesForSendXML($xmlWriter);
        $xmlWriter->endElement();
        $xmlWriter->endDocument();

        return $xmlWriter->outputMemory();
    }


    public function generateQueryString()
    {
        return null;
    }
}
