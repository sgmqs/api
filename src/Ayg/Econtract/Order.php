<?php
namespace Ayg\Econtract;

use Ayg\Http\Client;

class Order
{
    public $client;

    public $templateId;
    public $templateGroupId;
    public $extrSystemId;

    public $notifyUrl;
    public $list      = [];

    public $orderId;
    public $extrOrderId;

    public $identity;
    public $identityType;
    public $name;
    public $personalMobile;

    public function __construct($appId, $privateKey)
    {
        $this->client = new Client($appId, $privateKey);
    }

    /**
     * 7.3 批量提交请求签约合同-异步
     *
     * @return JSON
     */
    public function batchSubmit()
    {
        $path = '/econtract/extr/order/batchsubmit';
        $data = [
            'templateId' => $this->templateId,
            'notifyUrl'  => $this->notifyUrl,
            'list'       => $this->list,
        ];
        return $this->client->post($path, $data);

    }

    /**
     * 批量添加签约信息
     *
     * @param string $extrOrderId 外部订单号
     * @param string $identity 证件号
     * @param string $name 姓名
     * @param string $identityType 证件类型
     * @param string $personalMobile 手机
     * @param string $extrUserId 外部用户标识
     * @return void
     */
    public function appendListItem($extrOrderId, $identity, $name, $identityType, $personalMobile, $extrUserId = null)
    {
        $item = [
            'extrOrderId'    => $extrOrderId,
            'identity'       => $identity,
            'name'           => $name,
            'identityType'   => $identityType,
            'personalMobile' => $personalMobile,
        ];
        if ($extrUserId) {
            $item['extrUserId'] = $extrUserId;
        }
        $this->list[] = $item;
    }


    /**
     * 7.4 查询合同订单信息
     *
     * @return JSON
     */
    public function queryOrder()
    {
        $path = '/econtract/extr/order/qry';
        $data = [
            'orderId'     => $this->orderId,
            'extrOrderId' => $this->extrOrderId,
        ];
        return $this->client->post($path, $data);
    }


    /**
     * 7.5 实时查询签约状态信息
     *
     * @return JSON
     */
    public function realtimeQueryOrder()
    {
        $path = '/econtract/extr/order/rtqry';
        $data = [
            'orderId'     => $this->orderId,
            'extrOrderId' => $this->extrOrderId,
        ];
        return $this->client->post($path, $data);
    }

    /**
     * 7.6 单笔提交请求签约合同
     *
     * @return JSON
     */
    public function submit()
    {
        $path = '/econtract/extr/order/submit';
        $data = [
            'templateId'     => $this->templateId,
            'notifyUrl'      => $this->notifyUrl,
            'extrOrderId'    => $this->extrOrderId,
            'identity'       => $this->identity,
            'name'           => $this->name,
            'identityType'   => $this->identityType,
            'personalMobile' => $this->personalMobile,
        ];
        return $this->client->post($path, $data);
    }


    /**
     * 7.7 多服务商电子签约API
     *
     * @return JSON
     */
    public function batchTemplateGroupSubmit()
    {
        $path = '/econtract/extr/order/templategroup-submit';
        $data = [
            'templateGroupId' => $this->templateGroupId,
            'notifyUrl'       => $this->notifyUrl,
            'list'            => $this->list,
        ];
        return $this->client->post($path, $data);
    }


    /**
     * 7.8 取消签约流程
     *
     * @return JSON
     */
    public function cancelSign()
    {
        $path = '/econtract/extr/order/cancelsign';
        $data = [
            'extrSystemId' => $this->extrSystemId,
            'orderId'      => $this->orderId,
            'extrOrderId'  => $this->extrOrderId,
        ];
        return $this->client->post($path, $data);
    }


    /**
     * 7.11 外部电子签约订单同步接口【同步】
     * @param array $data 
     * [
     *  contractId
     *  templateId
     *  createTime
     *  extrOrderId
     *  outerDownloadUrl
     *  partyaSignTime
     *  partyaUserId
     *  partyaUserName
     *  partybSignTime
     *  partybUserId
     *  partybUserName
     *  partycSignTime
     *  partycUserId
     *  partycUserName
     *  personalIdentity
     *  personalIdentityType
     *  personalMobile
     *  personalName
     *  personalCertId
     *  personalCertType
     *  manufacturer
     *  contractContentBase64
     *  check
     * ]
     * @return JSON
     */
    public function outerSync($data)
    {
        $path = '/econtract/extr/order/outer-sync';
        return $this->client->post($path, $data);
    }

    /**
     * 查询合同组订单信息
     *
     * @return JSON
     */
    public function queryOrderGroup()
    {
        $path = '/econtract/extr/order/templategroup-qry';
        $data = [
            'templateGroupId' => $this->templateGroupId,
            'extrOrderId'     => $this->extrOrderId,
            'name'            => $this->name,
            'identity'        => $this->identity,
        ];
        return $this->client->post($path, $data);
    }
    
}