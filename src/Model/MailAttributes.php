<?php
namespace Aliyun\MNS\Model;

use Aliyun\MNS\Constants;

/**
 * Please refer to
 * https://docs.aliyun.com/?spm=#/pub/mns/api_reference/intro&intro
 * for more details
 */
class MailAttributes
{
    public $subject;
    public $accountName;
    public $addressType;
    public $replyToAddress;
    public $isHtml;

    public function __construct(
        $subject,
        $accountName,
        $addressType = 0,
        $replyToAddress = false,
        $isHtml = false
    ) {
        $this->subject = $subject;
        $this->accountName = $accountName;
        $this->addressType = $addressType;
        $this->replyToAddress = $replyToAddress;
        $this->isHtml = $isHtml;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getAccountName()
    {
        return $this->accountName;
    }

    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
    }

    public function getAddressType()
    {
        return $this->addressType;
    }

    public function setAddressType($addressType)
    {
        $this->addressType = $addressType;
    }

    public function getReplyToAddress()
    {
        return $this->replyToAddress;
    }

    public function setReplyToAddress($replyToAddress)
    {
        $this->replyToAddress = $replyToAddress;
    }

    public function getIsHtml()
    {
        return $this->isHtml;
    }

    public function setIsHtml($isHtml)
    {
        $this->isHtml = $isHtml;
    }

    public function writeXML(\XMLWriter $xmlWriter)
    {
        $jsonArray = array();
        if ($this->subject !== null) {
            $jsonArray[Constants::SUBJECT] = $this->subject;
        }
        if ($this->accountName !== null) {
            $jsonArray[Constants::ACCOUNT_NAME] = $this->accountName;
        }
        if ($this->addressType !== null) {
            $jsonArray[Constants::ADDRESS_TYPE] = $this->addressType;
        } else {
            $jsonArray[Constants::ADDRESS_TYPE] = 0;
        }
        if ($this->replyToAddress !== null) {
            if ($this->replyToAddress === true) {
                $jsonArray[Constants::REPLY_TO_ADDRESS] = "1";
            } else {
                $jsonArray[Constants::REPLY_TO_ADDRESS] = "0";
            }
        }
        if ($this->isHtml !== null) {
            if ($this->isHtml === true) {
                $jsonArray[Constants::IS_HTML] = "1";
            } else {
                $jsonArray[Constants::IS_HTML] = "0";
            }
        }

        if (!empty($jsonArray)) {
            $xmlWriter->writeElement(Constants::DIRECT_MAIL, json_encode($jsonArray));
        }
    }
}

?>
