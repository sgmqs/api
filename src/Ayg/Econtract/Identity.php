<?php
namespace Ayg\Econtract;

use Ayg\Http\Client;

class Identity
{
    public $client;

    public $identity;
    public $name;
    public $identityType;
    public $notifyUrl;

    public $frontfile;
    public $backfile;

    public function __construct($appId, $privateKey)
    {
        $this->client = new Client($appId, $privateKey);
    }

    /**
     * 7.2 上传身份证正反面(上传文件-同步接口)
     *
     * @return JSON
     */
    public function upload()
    {
        $path = '/econtract/extr/identity/upload';
        $queryParams = [
            'name'         => $this->name,
            'identity'     => $this->identity,
            'identityType' => $this->identityType,
        ];
        $formData = [
            'frontfile'    => $this->frontfile,
            'backfile'     => $this->backfile,
        ];
        $this->client->setHeaders(['multipart/form-data']);
        return $this->client->multipartPost($path, $queryParams, $formData);
    }

    /**
     * 7.9 上传身份证正反面(上传文件-异步接口)
     *
     * @return void
     */
    public function asyncUpload()
    {
        $path = '/econtract/extr/identity/asyn/upload';
        $queryParams = [
            'name'         => $this->name,
            'identity'     => $this->identity,
            'identityType' => $this->identityType,
            'notifyUrl'    => $this->notifyUrl,
        ];
        $formData = [
            'frontfile'    => $this->frontfile,
            'backfile'     => $this->backfile,
        ];
        $this->client->setHeaders(['multipart/form-data']);
        return $this->client->multipartPost($path, $queryParams, $formData);
    }
}