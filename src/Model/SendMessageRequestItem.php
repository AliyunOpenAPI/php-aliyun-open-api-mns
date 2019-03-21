<?php

namespace Aliyun\MNS\Model;

use Aliyun\MNS\Traits\MessagePropertiesForSend;

// this class is used for BatchSend
class SendMessageRequestItem
{

    use MessagePropertiesForSend;


    public function __construct($messageBody, $delaySeconds = null, $priority = null)
    {
        $this->messageBody  = $messageBody;
        $this->delaySeconds = $delaySeconds;
        $this->priority     = $priority;
    }


    public function writeXML(\XMLWriter $xmlWriter, $base64)
    {
        $xmlWriter->startELement('Message');
        $this->writeMessagePropertiesForSendXML($xmlWriter, $base64);
        $xmlWriter->endElement();
    }
}
