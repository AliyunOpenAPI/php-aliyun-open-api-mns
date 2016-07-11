<?php

namespace Aliyun\MNS\Requests;

use Aliyun\MNS\Constants;
use Aliyun\MNS\Model\SendMessageRequestItem;

class BatchSendMessageRequest extends BaseRequest
{

    protected $queueName;

    protected $sendMessageRequestItems;


    public function __construct(array $sendMessageRequestItems)
    {
        parent::__construct('post', null);

        $this->queueName               = null;
        $this->sendMessageRequestItems = $sendMessageRequestItems;
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


    public function getSendMessageRequestItems()
    {
        return $this->sendMessageRequestItems;
    }


    public function addSendMessageRequestItem(SendMessageRequestItem $item)
    {
        $this->sendMessageRequestItems[] = $item;
    }


    public function generateBody()
    {
        $xmlWriter = new \XMLWriter;
        $xmlWriter->openMemory();
        $xmlWriter->startDocument("1.0", "UTF-8");
        $xmlWriter->startElementNS(null, "Messages", Constants::MNS_XML_NAMESPACE);
        foreach ($this->sendMessageRequestItems as $item) {
            $item->writeXML($xmlWriter);
        }
        $xmlWriter->endElement();
        $xmlWriter->endDocument();

        return $xmlWriter->outputMemory();
    }


    public function generateQueryString()
    {
        return null;
    }
}
