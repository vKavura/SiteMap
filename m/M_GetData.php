<?php

/**
* 
*/
class M_GetData
{
    private $ch;
    
    public function __construct($url, $auth)
    {
        $auth = base64_encode(implode(':', $auth));
        $this->ch = curl_init();
        $opt_curl = [CURLOPT_URL => $url,
                    CURLOPT_HEADER => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HTTPHEADER => ["Authorization: Basic $auth"]
        ];

        curl_setopt_array($this->ch, $opt_curl);
    }

    public function GetArray()
    {
        $html = curl_exec($this->ch);

        if ($html == NULL) {
            new C_Errors('Данные не получены');
        }

        $data = $this->GetJsonData($html);
        $dataArray = json_decode($data[0], true);

        $this->CheckStatus($data[1]);

        if (!$dataArray) {
            new C_Errors('Ошибка в полученных данных');
        }

        return $dataArray;
    }

    private function GetJsonData($html)
    {
        $p_n = "\r\n\r\n";
        $html = str_replace("\n\n", $p_n, $html);
        
        $start = strpos($html, $p_n);
        $head = substr($html, 0, $start);
        $body = substr($html, $start + strlen($p_n));

        
        return [$body, $head];
    }

    private function CheckStatus($head)
    {
        $a = explode(' ',$head);
        if ($a[1] !== '200') {
            new C_Errors("Статус полученной страницы $a[1]");
        }
    }

    public function __destruct ()
    {
        curl_close($this->ch);
    }
}