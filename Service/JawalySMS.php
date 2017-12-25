<?php

namespace Ibtikar\TaniaModelBundle\Service;


class JawalySMS
{

    private $apiSecret;
    private $fromSender;
    private $username;
    private $logger;


    /**
     * @param string $userName
     * @param string $apiSecret
     * @param string $fromSender
     */
    public function __construct($userName, $apiSecret, $fromSender, $logger)
    {
        $this->baseUri = 'http://smpp1.4jawaly.net';
        $this->username = $userName;
        $this->apiSecret = $apiSecret;
        $this->fromSender = $fromSender;
        $this->logger = $logger;

    }

    /**
     * @param $url
     * @param array $params
     * @return array
     */
    protected function jsonRequest($url,$params=array()) {

        $params['api_secret'] = $this->apiSecret;

        $request_url = $this->baseUri.'/'.$url.'?'.http_build_query($params);

        $request = curl_init($request_url);
        curl_setopt($request,CURLOPT_RETURNTRANSFER,true );
        curl_setopt($request,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($request, CURLOPT_HTTPHEADER,array('Accept: application/json'));

        $response = curl_exec($request);
        $curl_info = curl_getinfo($request);

        curl_close($request);
        return $response;
    }


    /**
     * @param string $number
     * @param string $text
     * @param int $unicode
     * @return array
     * @throws \Exception
     */
    public function sendText($number,$text, $unicode = false) {
        $number = str_ireplace('+','',$number);
        //$this->logger->debug("Send sms to $number with text '$text'");

        $params = array(
            'from' => $this->fromSender,
            'to' => $number,
            'msg_type' => $unicode ? 2 : 0,
            'text' => $text,
            'type' => 'text',
        );

        $responseMsg = $this->jsonRequest('Sendsms.aspx',$params);

        $response = explode(':', explode('|', $responseMsg)[0]);

        if(isset($response[0]) && $response[0] == 'ERROR')
            throw new \Exception($responseMsg);
    }

}
