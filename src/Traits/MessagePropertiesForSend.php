<?php

namespace Aliyun\MNS\Traits;

use Aliyun\MNS\Constants;

trait MessagePropertiesForSend
{

    protected $messageBody;

    protected $delaySeconds;

    protected $priority;


    public function getMessageBody()
    {
        return $this->messageBody;
    }


    public function setMessageBody($messageBody)
    {
        $this->messageBody = $messageBody;
    }


    public function getDelaySeconds()
    {
        return $this->delaySeconds;
    }


    public function setDelaySeconds($delaySeconds)
    {
        $this->delaySeconds = $delaySeconds;
    }


    public function getPriority()
    {
        return $this->priority;
    }


    public function setPriority($priority)
    {
        $this->priority = $priority;
    }


    public function writeMessagePropertiesForSendXML(\XMLWriter $xmlWriter)
    {
        if ($this->messageBody != null) {
            $xmlWriter->writeElement(Constants::MESSAGE_BODY, base64_encode($this->messageBody));
        }
        if ($this->delaySeconds != null) {
            $xmlWriter->writeElement(Constants::DELAY_SECONDS, $this->delaySeconds);
        }
        if ($this->priority != null) {
            $xmlWriter->writeElement(Constants::PRIORITY, $this->priority);
        }
    }
}
