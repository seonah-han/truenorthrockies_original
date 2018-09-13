<?php
    if(filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){

        $data = [
            'email'     => filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
            'status'    => 'pending'
        ];

        syncMailchimp($data);

    }

    function syncMailchimp($data) {
        $apiKey = '5b0d4e1d0a9990c179a19e8e4750725a-us14';
        $listId = '98b1a0fd2d';

        $memberId = md5(strtolower($data['email']));
        $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
        $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/';

        $json = json_encode([
            'email_address' => $data['email'],
            'status'        => $data['status']
        ]);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        echo json_decode($result, true)['status'];

        return $httpCode;
    }
?>