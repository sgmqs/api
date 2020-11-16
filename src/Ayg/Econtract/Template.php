<?php
namespace Ayg\Econtract;

use Ayg\Http\Client;

class Template
{
    public $templateId;
    public $extrSystemId;

    public function __construct($appId, $privateKey)
    {
        $this->client = new Client($appId, $privateKey);
    }
    /**
     * 7.10 下载合同模版文件
     *
     * @param string $localFileName 本地文件路径 
     * @return string 
     */
    public function download($localFileName = null)
    {
        $path = '/econtract/extr/template/download';
        $params = [
            'extrSystemId' => $this->extrSystemId,
            'templateId'   => $this->templateId,
        ];
        $url = $this->client->buildUrl($path) . '?' . http_build_query($params);
        $fileData = file_get_contents($url);
        if ($localFileName && $fileData) {
            file_put_contents($localFileName, $fileData);
        }
        return $fileData;
    }
}