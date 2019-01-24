<?php
namespace Aliyun\MNS\Model;

use Aliyun\MNS\Constants;
use Aliyun\MNS\Exception\MnsException;

/**
 * Please refer to
 * https://help.aliyun.com/document_detail/44501.html
 * for more details
 */
class SmsAttributes
{
    public $freeSignName;
    public $templateCode;
    public $smsParams;
    public $receiver;

    public function __construct(
        $freeSignName,
        $templateCode,
        $smsParams = array(),
        $receiver = null
    ) {
        $this->freeSignName = $freeSignName;
        $this->templateCode = $templateCode;
        $this->smsParams = $smsParams;
        $this->receiver = $receiver;
    }

    public function getFreeSignName()
    {
        return $this->freeSignName;
    }

    public function setFreeSignName($freeSignName)
    {
        $this->freeSignName = $freeSignName;
    }

    public function getTemplateCode()
    {
        return $this->templateCode;
    }

    public function setTemplateCode($templateCode)
    {
        $this->templateCode = $templateCode;
    }

    public function getSmsParams()
    {
        return $this->smsParams;
    }

    public function setSmsParams($smsParams)
    {
        $this->smsParams = $smsParams;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }

    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    public function writeXML(\XMLWriter $xmlWriter)
    {
        $jsonArray = array();
        if ($this->freeSignName !== null) {
            $jsonArray[Constants::FREE_SIGN_NAME] = $this->freeSignName;
        }
        if ($this->templateCode !== null) {
            $jsonArray[Constants::TEMPLATE_CODE] = $this->templateCode;
        }
        if ($this->receiver !== null) {
            $jsonArray[Constants::RECEIVER] = $this->receiver;
        }

        if ($this->smsParams !== null) {
            if (!is_array($this->smsParams)) {
                throw new MnsException(400, "SmsParams should be an array!");
            }
            $jsonArray[Constants::SMS_PARAMS] = json_encode($this->smsParams, JSON_FORCE_OBJECT);
        }

        if (!empty($jsonArray)) {
            $xmlWriter->writeElement(Constants::DIRECT_SMS, json_encode($jsonArray));
        }
    }
}

?>
