<?php

namespace Ayg\Http;

class Client
{
    private $appId;
    private $privateKey;
    private $baseUrl;
    private $headers;

    /**
     * Construct
     *
     * @param string $appId
     * @param string $privateKey
     * @param string $baseUrl
     * @param array $headers
     */
    public function __construct($appId, $privateKey, $baseUrl = 'https://openapi.aiyuangong.com/', $headers = array('Content-Type: application/json'))
    {
        $this->appId      = $appId;
        $this->privateKey = $privateKey;
        $this->baseUrl    = $baseUrl;
        $this->headers    = $headers;

        if (env('AYG_DEBUG', false)) {
            $this->useSandbox();
        }
    }

    /**
     * url拼接
     *
     * @param string $path
     * @return String
     */
    public function buildUrl($path)
    {
        return $this->baseUrl . ltrim($path, '/');
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function useSandbox()
    {
        $this->baseUrl = 'https://openapitest.aiyuangong.com/';
    }

    /**
     * GET
     *
     * @param string $path
     * @param array $params
     * @return void
     */
    public function get($path, $params)
    {
        if (is_array($params)) {
            $params = build_ayg_query_string($params);
        }
        $url = $this->buildUrl($path) . '?' . $params;
        return $this->sendRequest('GET', $url);
    }

    /**
     * POST
     *
     * @param string $path
     * @param array $data
     * @return JSON
     */
    public function post($path, $data)
    {
        $params = [
            'appId'     => $this->appId,
            'nonce'     => get_random_string(32),
            'timestamp' => time(),
            'data'      => $data,
        ];
        $params['sign'] = $this->rsaSign($params);
        $params         = json_encode($params);
        $url            = $this->buildUrl($path);
        return $this->sendRequest('POST', $url, $params);
    }

    /**
     * POST File
     *
     * @param string $path
     * @param array $queryParams
     * @param array $formData
     * @return JSON
     */
    public function multipartPost($path, $queryParams, $formData)
    {
        $signData = [];
        if (is_array($formData)) {
            foreach ($formData as $key => $item) {
                if (is_file($item)) {
                    $signData[$key] = md5_file($item);
                    $formData[$key] = curl_file_create(realpath($item), mime_content_type($item));
                }
            }
        }

        if (is_array($queryParams)) {
            $queryParams['appId']     = $this->appId;
            $queryParams['nonce']     = get_random_string(32);
            $queryParams['timestamp'] = time();
            $signData                 = array_merge($signData, $queryParams);
            $queryParams['sign']      = $this->rsaSign($signData);
            $queryParams              = http_build_query($queryParams);
        }

        $url = $this->buildUrl($path) . '?' . $queryParams;
        return $this->sendRequest('POST', $url, $formData);
    }

    /**
     * Send
     *
     * @param string $method
     * @param string $url
     * @param array $params
     * @return JSON
     */
    public function sendRequest($method, $url, $params = [])
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);

        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        $errorno = curl_errno($curl);
        if ($errorno) {
            $errmsg = curl_error($curl);
            curl_close($curl);
            return compact('errorno', 'errmsg');
        }
        curl_close($curl);
        return json_decode($res, true);
    }

    /**
     * Sign
     *
     * @param array $data
     * @return string
     */
    public function rsaSign($data) {
        foreach ($data as $k => $v){
            if($k == 'signType'){
                unset($data[$k]);
            }
        }

        $query = build_ayg_query_string($data);
        $query = urldecode($query);
        $private_key = $this->privateKey;
        $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($private_key, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        openssl_sign($query, $sign, $res, OPENSSL_ALGO_SHA256);
        //base64编码
        $sign = base64_encode($sign);
        return $sign;
    }


}