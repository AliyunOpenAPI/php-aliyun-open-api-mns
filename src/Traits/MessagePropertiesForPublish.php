<?php

namespace Aliyun\MNS\Traits;

use Aliyun\MNS\Constants;

trait MessagePropertiesForPublish
{

    protected $messageBody;


    public function getMessageBody()
    {
        return $this->messageBody;
    }


    public function setMessageBody($messageBody)
    {
        $this->messageBody = $messageBody;
    }


    public function writeMessagePropertiesForPublishXML(\XMLWriter $xmlWriter)
    {
        if ($this->messageBody != null) {
            $xmlWriter->writeElement(Constants::MESSAGE_BODY, base64_encode($this->messageBody));
        }
    }
}
