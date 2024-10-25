<?php

namespace App\Services\PaymentGateways;

use Illuminate\Http\Exceptions\HttpResponseException;
use Modules\Support\Traits\ApiTrait;
use Modules\Support\Traits\consumeExternalServices;

class MyfatoorahService
{
    use consumeExternalServices, ApiTrait;

    protected $baseUri;
    protected $app_key;

    public function __construct()
    {
        $this->baseUri = config('payment-gateways.myfatoorah.base_uri');
        $this->app_key = config('payment-gateways.myfatoorah.app_key');
    }

    // to resolve the autorization
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    // create the access token
    public function resolveAccessToken()
    {
        return "Bearer {$this->app_key}";
    }

    // resolve the factor (to solve zero decimal currency problem)
    public function resolveFactor($currency)
    {
        $zeroDecimalCurrencies = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencies)) {
            return 1;
        }
        return 100;
    }

    // to decode the response of the sent request
    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    // send a payment
    public function sendPayment($name, $email, $value, $currency, $orderId)
    {
        try {
            $req = $this->makeRequest(
                'POST',
                '/v2/SendPayment',
                [],
                [
                    "UserDefinedField" => (string) $orderId,
                    "CustomerName" => $name,
                    "NotificationOption" => "LNK",
                    "CustomerEmail" => $email,
                    "InvoiceValue" => round($value * $factor = $this->resolveFactor($currency)) / $factor,
                    "DisplayCurrencyIso" => strtoupper($currency),
                    "CallBackUrl" => route('approval'),
                    "ErrorUrl" => route('cancelled'),
                    "Language" => "en",
                ],
                [],
                $isJsonRequest = true
            );


        } catch (\Throwable $th) {

            if ($th->getResponse()) {
                $decodeResponse = json_decode($th->getResponse()->getBody()->getContents(), true);
                $ResponseErrors = data_get($decodeResponse, 'ValidationErrors', [['Error' => 'payment has error']]);
                $errors = collect($ResponseErrors)->pluck('Error')->toArray();

                throw new HttpResponseException($this->sendErrorData(['error' => $errors], data_get($errors, 0, 'payment has error')));
            }

            $message = 'payment has error';
            throw new HttpResponseException($this->sendErrorData(['error' => [$message]], $message));
        }

        return $req;
    }

    // get payment status
    public function getPaymentStatus($keyId, $KeyType = 'InvoiceId')
    {
        return $this->makeRequest(
            'POST',
            '/v2/getPaymentStatus',
            [],
            [
                'Key' => $keyId,
                'KeyType' => $KeyType
            ],
            [],
            $isJsonRequest = true
        );
    }

    public function makeRefund($invoiceId, $amount)
    {
        try {
            $req = $this->makeRequest(
                'POST',
                '/v2/MakeRefund',
                [],
                [
                    "Key" => $invoiceId,
                    "KeyType" => "InvoiceId",
                    "RefundChargeOnCustomer" => false,
                    "ServiceChargeOnCustomer" => false,
                    "Amount" => $amount,
                    "Comment" => "test comment",
                    "CurrencyIso" => "SAR"
                ],
                [],
                $isJsonRequest = true
            );


        } catch (\Throwable $th) {

            // if ($th->getResponse()) {
            //     $decodeResponse = json_decode($th->getResponse()->getBody()->getContents(), true);
            //     $ResponseErrors = data_get($decodeResponse, 'ValidationErrors', [['Error' => 'payment has error']]);
            //     $errors = collect($ResponseErrors)->pluck('Error')->toArray();

            //     throw new HttpResponseException($this->sendErrorData(['error' => $errors], data_get($errors, 0, 'payment has error')));
            // }

            // $message = 'payment has error';
            // throw new HttpResponseException($this->sendErrorData(['error' => [$message]], $message));

            return;
        }

        return $req;
    }

    // get payment status
    public function getRefundStatus($keyId, $KeyType = 'InvoiceId')
    {
        try {
            return $this->makeRequest(
                'POST',
                '/v2/GetRefundStatus',
                [],
                [
                    'Key' => $keyId,
                    'KeyType' => $KeyType
                ],
                [],
                $isJsonRequest = true
            );

        } catch (\Throwable $th) {

            return false;
        }

    }

}
