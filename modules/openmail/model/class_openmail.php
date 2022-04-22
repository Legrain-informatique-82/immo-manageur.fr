<?php

/**
 * Class OpenmailFaxNumberInformation
 */
class OpenmailFaxNumberInformation{
	/**
	 * country name
	 * @var String
	 */
	public $countryName;
	/**
	 * Price per page
	 * @var Float
	 */
	public $pricePerPage;
	/**
	 * country code
	 * @var String
	 */
	public $countryCode;
	/**
	 * iso country code
	 * @var String
	 */
	public $isoCountryCode;
    /**
     * id of country
     * @var Int
     */
    public $id;
	/**
     * new OpenmailFaxNumberInformation
	 * @api
	 * @param String $countryName
	 * @param Float $pricePerPage
	 * @param String $countryCode
	 * @param String $isoCountryCode
     * @param Int $id
	 */
	public function __construct($countryName,$pricePerPage,$countryCode,$isoCountryCode,$id){
	 $this->countryName=$countryName;
	 $this->pricePerPage=$pricePerPage;
	 $this->countryCode=$countryCode;
	 $this->isoCountryCode=$isoCountryCode;
     $this->id= $id;
	}

}

/**
 * Class OpenMailFax
 */
class OpenMailFax{
	/**
	 * email address used to notification
	 * @var String
	 */
	public $referer;
	/**
	 * array of OpenMailFaxRecipient
	 * @var OpenMailFaxRecipient[]
	 */
	public $recipients;
	/**
	 * pdf encoded in base 64
	 * @var String
	 */
	public $pdfB64;
	/**
	 * url to pdf
	 * @var String
	 */
	public $pdfUrl;
	/**
	 * fax quality
	 * @var String
	 */
	public $quality;

	/**
	 * id openMail fax
 	 * @var Int
	 */
	public $id;
	/**
	 * price per fax
	 * @var Float
	 */
	public $priceTotal;
	/**
	 * date sending
	 * @var Int
	 */
	public $dateSending ;
	/**
	 * total number of page
	 * @var Int
	 */
	public $totalNumberOfPages;

	/**
     *  new OpenMailFax
     * @api
	 * @param String $referer
	 * @param OpenMailFaxRecipient[] $recipients
	 * @param String $pdfB64
	 * @param String $pdfUrl
	 * @param String $quality
	 */
	public function __construct($referer,$recipients,$quality,$pdfB64,$pdfUrl){
		$this->referer = $referer;
		$this->recipients = $recipients;
		$this->pdfB64 = $pdfB64;
		$this->pdfUrl = $pdfUrl;
		$this->quality = $quality;
	}
}

class OpenMailFaxReferer{
    /**
     * @var String
     */
    public $libel;
    /**
     * @var String
     */
    public $address;
    /**
     * @var Int
     */
    public $id;

    /**
     * new OpenMailFaxReferer
     * @api
     * @param String $libel
     * @param String $address
     * @param Int $id
     */
    public function __construct($libel,$address,$id){
        $this->libel = $libel;
        $this->address = $address;
        $this->id = $id;
    }

}
/**
 * Class OpenMailFaxRecipient
 */
class OpenMailFaxRecipient{
	/**
     * fax number
	 * @var String
	 */
	public $number;
	/**
     * country code
	 * @var String
	 */
	public $country_code;
    /**
     * Country name
     * @var String
     */
    public $country_name;
    /**
     * Price in euro per page sent
     * @var Float
     *
     */
    public $price_per_page;


	/**
     * new OpenMailFaxRecipient
     * @api
	 * @param String $number
	 * @param String $country_code
     * @param String $country_name
     * @param Float $price_per_page
	 */
	public function __construct($number,$country_code,$country_name,$price_per_page){
		$this->number = $number;
		$this->country_code = $country_code;
        $this->country_name = $country_name;
        $this->price_per_page = $price_per_page;
	}
}

/**
 * Class OpenMailSms
 */
class OpenMailSms{
	/**
     * from
	 * @var String
	 */
	public $from;
	/**
     * to
	 * @var Array
	 */
	public $to;
	/**
     * message
	 * @var String
	 */
	public $message;
	/**
     * the sms class: flash(0),phone display(1),SIM(2),toolkit(3), default is 1
	 * @var int
	 */
	public $smsClass;
	/**
	 * boolean noStop : do not display 'STOP au XXXXX' clause (FR only), this requires that this is not an advertising message
	 * @var Bool
	 */
	public $noStop;
	/**
     * openmail ID
	 * @var Int
	 */
	public $id;
	/**
     * date sent
	 * @var String
	 */
	public $dateSending;

	/**
     * status
	 * @var String
	 */
	public $status;
	
	/**
     * name of emailCampaign
	 * var String
	 */
	public $nameOfCampaign;
	

	/**
     * new OpenMailSms
     * @api
	 * @param String $from
	 * @param Array $to
	 * @param String $message
	 * @param Int $smsClass  the sms class: flash(0),phone display(1),SIM(2),toolkit(3), default is 1
	 * @param Bool $noStop do not display 'STOP au XXXXX' clause (FR only), this requires that this is not an advertising message
	 * @param String $dateSending Optional timestamp date sent
	 * @param String $nameOfCampaign Optional Name of emailCampaign sms ( optionnal)
	 */
	function __construct($from,$to,$message,$smsClass,$noStop,$dateSending,$nameOfCampaign){
		$this->from = $from;
		$this->to=$to;
		$this->message= $message;
		$this->smsClass = $smsClass==null?1:$smsClass;
		$this->noStop=$noStop==null?false:$noStop;
		$this->dateSending = $dateSending;
		$this->nameOfCampaign = $nameOfCampaign;
	}
}

/**
 * Class Connect
 */
class Connect{
	/**
     * login openmail
	 * @var String
	 */
	public $user;
	/**
     * password openmail
	 * @var String
	 */
	public $password;
	/**
     * land ( code iso), FR, EN...
	 * @var String
	 */
	public $lang;
	/**
	 * Partner code
	 * @var String
	 */
	public $partnerCode;
	/**
     * new Connect
     * @api
	 * @param String $user
	 * @param String $password
	 * @param String $lang
	 * @param String $partnerCode
	 */
	function __construct($user,$password,$lang,$partnerCode){
		$this->user = $user;
		$this->password = $password;
		$this->lang = strtolower($lang);
		$this->partnerCode = $partnerCode;
	}
}

/**
 * Class OpenMailEmailCampaign
 */
class OpenMailEmailCampaign{
    /**
     * id campaign
     * @var Int
     */
    public $id;
    /**
     * Title
     * @var String
     */
    public $title;
    /**
     * Subject of your campaign
     * @var String
     */
    public $subject;
    /**
     * Content of Email
     * @var String
     */
    public $content;
    /**
     * From
     * @var OpenMailEmailFrom
     */
    public $from;

    /**
     * list
     * @var OpenMailEmailCampaignListsContact
     */
    public $listContacts;

    /**
     * list of contacts
     * @var OpenMailEmailCampaignContacts[]
     */
    public $to;
    /**
     * date
     * @var String
     */
    public $dateSending;

    /**
     * @param Int $id
     * @param String $title
     * @param String $subject
     * @param String $content
     * @param $from OpenMailEmailFrom
     * @param $listContact OpenMailEmailCampaignListsContact
     * @param $to OpenMailEmailCampaignContacts[]
     * @param String $dateSending
     */
    public function __construct($id,$title,$subject,$content,$from,$listContact,$to,$dateSending){
        $this->id=$id;
        $this->title=$title;
        $this->subject=$subject;
        $this->content=$content;
        $this->from = $from;
        $this->listContacts = $listContact;
        $this->to = $to;
        $this->dateSending = $dateSending;
    }
}
/**
 * Class OpenMailEmail
 */
class OpenMailEmail{
	/**
     * from
	 * @var String
	 */
	public $from;
	/**
     * to
	 * @var array
	 */
	public $to;
    /**
     * Reply to
     * @var string
     */
    public $reply_to;
	/**
     * subject
	 * @var String
	 */
	public $subject;
	/**
     * message
	 * @var String
	 */
	public $message;
	/**
     * attachment in base 64
	 * @var OpenMailAttachmentB64[]
	 */
	public $attachment_base64;
	/**
     * url of attachment
	 * @var OpenMailAttachment[]
	 */
	public $attachment_url;
	/**
     * date
	 * @var String
	 */
	public $dateSending;
	/**
     * int
	 * @var Int
	 */
	public $id;
    /**
     * @var String Optional Default = $subject
     */
    public $nameOfGroup;
	

	/**
     * new OpenMailEmail
	 * @api
	 * @param string $from
	 * @param array $to
	 * @param string $reply_to
	 * @param string $subject
	 * @param string $message
	 * @param OpenMailAttachmentB64[] $attachment_base64
	 * @param OpenMailAttachment[] $attachment_url
	 * @param String $dateSending date in US format ( y-m-d H:i:s)
	 * @param Int $id Optional
     * @param $nameOfGroup String|OpenMailGroupEmail Optional
	 */
	public function __construct($from,$to,$reply_to,$subject,$message,$attachment_base64,$attachment_url,$dateSending,$id,$nameOfGroup){
		$this->from=$from;
		$this->to=$to;

		$this->reply_to=$reply_to;
		$this->subject=$subject;
		$this->message=$message;
		$this->attachment_base64=$attachment_base64;
		$this->attachment_url=$attachment_url;
		$this->dateSending = $dateSending;
		$this->id = $id;
        $this->nameOfGroup=$nameOfGroup==null?$subject:$nameOfGroup;
	}

}

/**
 * Class OpenMailAttachmentB64
 */
class OpenMailAttachmentB64{
	/**
     * attachment encoded in base 64
	 * @var String
	 */
	public $filename;
	/**
     * filename
	 * @var String
	 */
	public $file;
	/**
     * new OpenMailAttachmentB64
	 * @api
	 * @param String $filename
	 * @param String $file
	 */
	public function __construct($filename,$file){
		$this->filename=$filename;
		$this->file = $file;
	}
}

/**
 * Class OpenMailAttachment
 */
class OpenMailAttachment{
	/**
     * filename
	 * @var String
	 */
	public $filename;
	/**
     * url
	 * @var String
	 */
	public $url;
	/**
     * new OpenMailAttachment
	 * @api
	 * @param String $filename
	 * @param String $url
	 */
	public function __construct($filename,$url){
		$this->filename=$filename;
		$this->url = $url;
	}
}

/**
 * Class OpenMailEmailFrom
 */
class OpenMailEmailFrom{
	/**
	 * id
	 * @var Int
	 */
	public $id;
	/**
	 * name
	 * @var String
	 */
	public $name;
	/**
	 * address
	 * @var String
	 */
	public $address;
	/**
	 * address reply to
	 * @var String
	 */
	public $addressReplyTo;
	/**
	 * active
	 * @var Bool
	 */
	public $active;
	/**
     *  new OpenMailEmailFrom
	 * @api
	 * @param Int $id
	 * @param String $name
	 * @param String $address
	 * @param String $addressReplyTo
	 * @param Bool $active
	 */
	public function __construct($id,$name,$address,$addressReplyTo,$active){
		$this->id=$id;
		$this->name=$name;
		$this->address=$address;
		$this->addressReplyTo=$addressReplyTo;
		$this->active=$active;
	}
}

/**
 * Class OpenMailGroupEmail
 */
class OpenMailGroupEmail{
    /**
     * id group email
     * @var Int
     */
    public $id;
    /**
     * Name of group
     * @var String
     */
    public $name;
    /**
     * date sending
     * @var String
     */
    public $dateSending;
    /**
     * Total email
     * @var Int
     */
    public $totalEmailSent;

    /**
     * new OpenMailGroupEmail
     * @api
     * @param $id
     * @param $name
     * @param $dateSending
     * @param $totalEmailSent
     */
    public function __construct($id,$name,$dateSending,$totalEmailSent){
        $this->id=$id;
        $this->name=$name;
        $this->dateSending=$dateSending;
        $this->totalEmailSent=$totalEmailSent;
    }
}

/**
 * Class OpenMailEmailCampaignListContact
 */
class OpenMailEmailCampaignListsContact{
    /**
     * @var INT $id
     */
    public $id;
    /**
     * @var String $name
     */
    public $name;
    /**
     * @var Int $subscribers
     */
    public $subscribers;
    /**
     * @var Int
     */
    public $created_at;
    /**
     * @var Int
     */
    public $last_activity;

    /**
     * @param Int $id
     * @param String $name
     * @param Int $subscribers
     * @param Int $created_at
     * @param Int $last_activity
     * @return OpenMailEmailCampaignListsContact
     */
    public function __construct($id,$name,$subscribers,$created_at,$last_activity){
        $this->id=$id;
        $this->name = $name;
        $this->subscribers=$subscribers;
        $this->created_at = $created_at;
        $this->last_activity=$last_activity;
    }



}

/**
 * Class OpenMailEmailCampaignContacts
 */
class OpenMailEmailCampaignContacts{
    /**
     * @var Int $id
     */
    public $id;

    /**
     * @var String Email of your contact
     */
    public $email;
    /**
     * @var Int Amount of emails sent to this contact
     */
    public $sent;

    /**
     * @var Int Date of subscription of your contact
     */
    public $created_at;
    /**
     * @var Int Timestamp of the last activity relative to this contact.
     */
    public $last_activity;
    /**
     * @var Bool false=subscriber, true=unsubscribed
     */
    public $unsub;

    /**
     * @var Bool true=active, false=inactive
     */
    public $active;



    /**
     * @param int $id
     * @param String $email  Email of your contact
     * @param Int $sent  Amount of emails sent to this contact
     * @param Int $created_at  Date of subscription of your contact
     * @param Int $last_activity  Timestamp of the last activity relative to this contact.
     * @param Bool $unsub  0=subscriber, 1=unsubscribed
     * @param Bool $active  true=active, false=inactive
     * @return OpenMailEmailCampaignContacts
     */
    public function __construct($id,$email,$sent,$created_at,$last_activity,$unsub,$active){

        $this->id=$id;
        $this->email=$email;
        $this->sent=$sent;
        $this->created_at=$created_at;
        $this->last_activity=$last_activity;
        $this->unsub=(Bool)$unsub;
        $this->active=(Bool)$active;

    }
}


