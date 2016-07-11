<?php

namespace Aliyun\MNS\Traits;

use Aliyun\MNS\Model\Message;

trait MessagePropertiesForReceive
{

    use MessagePropertiesForPeek;

    protected $receiptHandle;


    public function readMessagePropertiesForReceiveXML(\XMLReader $xmlReader)
    {
        $message                = Message::fromXML($xmlReader);
        $this->messageId        = $message->getMessageId();
        $this->messageBodyMD5   = $message->getMessageBodyMD5();
        $this->messageBody      = $message->getMessageBody();
        $this->enqueueTime      = $message->getEnqueueTime();
        $this->nextVisibleTime  = $message->getNextVisibleTime();
        $this->firstDequeueTime = $message->getFirstDequeueTime();
        $this->dequeueCount     = $message->getDequeueCount();
        $this->priority         = $message->getPriority();
        $this->receiptHandle    = $message->getReceiptHandle();
    }


    public function getReceiptHandle()
    {
        return $this->receiptHandle;
    }
}
