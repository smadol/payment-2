<?php
/**
 * Created by PhpStorm.
 * User: overnic
 * Date: 2018/4/18
 * Time: 15:04
 */
namespace OverNick\Payment\Tests\Alipay;

use OverNick\Payment\PaymentManage;
use OverNick\Payment\Tests\BaseTestCase as TestCase;

/**
 * Class BaseTestCase
 * @package OverNick\Payment\Tests\Alipay
 */
class PayTest extends TestCase
{
    protected $driver = PaymentManage::DRIVER_ALIPAY;

    /**
     * 移动端支付
     *
     * @test
     */
    public function wapPay()
    {
        $params = [
            'notify_url' => 'http://localhost/pay/ali',
            'return_url' => 'http://localhost/pay/ali/orderReturn'
        ];

        $bizContent = [
            'out_trade_no' => 'D20190102001111'.mt_rand(100,9999),
            'product_code' => 'FAST_INSTANT_TRADE_PAY',
            'subject' => '订单支付',
            'body' => 'O126 PP 17 CRYSTAL  (001) 白色  G SMALL等商品',
            'total_amount' => 0.02,
            'qr_pay_mode' => 3,     // 使用方式查看支付宝文档
        ];

        // 获取值为一个跳转链接
        $result = $this->getPay()->pay->wap($bizContent, $params);

        $this->assertEquals('string', gettype($result));
    }

    /**
     * 网页支付
     *
     * @test
     */
    public function pagePay()
    {
        $params = [
            'notify_url' => 'http://localhost/pay/ali',
            'return_url' => 'http://localhost/pay/ali/orderReturn'
        ];

        $bizContent = [
            'out_trade_no' => 'D20190102001111'.mt_rand(100,9999),
            'product_code' => 'FAST_INSTANT_TRADE_PAY',
            'subject' => '订单支付',
            'body' => 'O126 PP 17 CRYSTAL  (001) 白色  G SMALL等商品',
            'total_amount' => 0.02,
            'qr_pay_mode' => 3,     // 使用方式查看支付宝文档
        ];

        // 获取值为一个跳转链接
        $result = $this->getPay()->pay->page($bizContent,$params);

        $this->assertEquals('string', gettype($result));
    }

    /**
     * @test
     */
    public function payment()
    {
        $params = [
            'notify_url' => 'http://123456789.cn'
        ];

        $bizContent = [
            'subject' => '商品购买2',
            'out_trade_no' => '201904160011',
            'scene' => 'bar_code',
            'body' => 'iPhone X 赠送贴膜',
            'total_amount' => 0.01,
            'auto_code' => '12345678902123'
        ];

        $result = $this->getPay($this->driver)->pay->create($bizContent, $params);

        $this->assertEquals('array', gettype($result));
    }
}