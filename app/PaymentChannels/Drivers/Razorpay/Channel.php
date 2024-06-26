<?php

namespace App\PaymentChannels\Drivers\Razorpay;

use App\Models\Order;
use App\Models\PaymentChannel;
use App\PaymentChannels\BasePaymentChannel;
use App\PaymentChannels\IChannel;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class Channel extends BasePaymentChannel implements IChannel
{
    protected $currency;
    protected $test_mode;
    protected $api_key;
    protected $api_secret;


    protected array $credentialItems = [
        'api_key',
        'api_secret',
    ];


    /**
     * Channel constructor.
     * @param PaymentChannel $paymentChannel
     */
    public function __construct(PaymentChannel $paymentChannel)
    {
        $this->currency = currency();
        $this->setCredentialItems($paymentChannel);
    }

    public function paymentRequest(Order $order)
    {

    }

    private function makeCallbackUrl(Order $order)
    {

    }

    public function verify(Request $request)
    {
        $input = $request->all();

        $user = auth()->user();
        $orderId = $request->input('order_id');

        $api = new Api($this->api_key, $this->api_secret);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        $order = Order::where('id', $orderId)
            ->where('user_id', $user->id)
            ->with('user')
            ->first();

        if (count($input) and !empty($input['razorpay_payment_id'])) {

            $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

            if (!empty($order)) {
                if ($response['status'] == 'captured') {
                    $order->update(['status' => Order::$paying]);
                } else {
                    $order->update(['status' => Order::$pending]);
                }

                $order->payment_method = Order::$paymentChannel;
                $order->save();

                return $order;
            }
        }

        return $order;
    }
}
