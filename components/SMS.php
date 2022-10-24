<?php 

namespace app\components;

use Yii;
use yii\httpclient\Client;
use yii\base\Component;

class SMS extends Component
{
    public $username;
    public $password;
    public $smsSender = 'HYUNDAI';

    public function getPrefix()
    {
        
    }
    
    public function send($to, $content)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('https://www.intouchsms.co.rw/api/sendsms/.json')
            ->setData([
                'username' =>$this->username, 
                'password' => $this->password,
                'sender' => $this->smsSender,
                'recipients' => $to,
                'message' => $content,
            ])
            ->send();
        if ($response->isOk) {
           $data =  trim($response->content);
           $data = explode(' ', $data);
           return $data[0] == 'Success' || $data[0] == 'success';
        }


        $data=array("sender"=>'Intouch',"recipients"=>"0785495363","message"=>"hello world",);

        return false;
    }
    
}