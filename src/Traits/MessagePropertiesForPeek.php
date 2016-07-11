<?php

namespace Aliyun\MNS\Traits;

use Aliyun\MNS\Model\Message;

trait MessagePropertiesForPeek
{

    use MessageIdAndMD5;

    protected $messageBody;

    protected $enqueueTime;

    protected $nextVisibleTime;

    protected $firstDequeueTime;

    protected $dequeueCount;

    protected $priority;


    public function readMessagePropertiesForPeekXML(\XMLReader $xmlReader)
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
    }


    public function getMessageBody()
    {
        return $this->messageBody;
    }


    public function getEnqueueTime()
    {
        return $this->enqueueTime;
    }


    public function getNextVisibleTime()
    {
        return $this->nextVisibleTime;
    }


    public function getFirstDequeueTime()
    {
        return $this->firstDequeueTime;
    }


    public function getDequeueCount()
    {
        return $this->dequeueCount;
    }


    public function getPriority()
    {
        return $this->priority;
    }
}
