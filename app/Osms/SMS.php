<?php

namespace App\Osms;


use App\Osms\Http\SMSClient;
use App\Osms\Http\Requests\ContractsRequest;
use App\Osms\Http\Requests\StatisticsRequest;
use App\Osms\Http\Requests\OutboundSMSRequest;
use App\Osms\Http\Requests\OrdersHistoryRequest;
use App\Osms\Http\Requests\SMSDRCheckCallbackRequest;
use App\Osms\Http\Requests\SMSDRDeleteCallbackRequest;
use App\Osms\Http\Requests\SMSDRRegisterCallbackRequest;

class SMS
{
    /**
     * @var string
     */
    protected $recipientNumber;
    /**
     * @var string
     */
    protected $senderNumber;

    /**
     * @var string
     */
    protected $senderName;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var SMSClient
     */
    protected $client;

    /**
     * Outbound SMS Object constructor.
     *
     * @param SMSClient $client
     */
    public function __construct(SMSClient $client)
    {
        $this->client = $client;
    }

     /**
      * Set SMS client.
      *
     * @param SMSClient $client
     * @return $this
     */
    public function setClient(SMSClient $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Set SMS recipient.
     *
     * @param string $recipientNumber
     * @return $this
     */
    public function to($recipientNumber)
    {
        $this->recipientNumber = $recipientNumber;

        return $this;
    }

    /**
     * set SMS sender details.
     *
     * @param string $number
     * @param string|null $name
     * @return $this
     */
    public function from($number, $name = null)
    {
        $this->senderNumber = $number;

        $this->senderName = $name;

        return $this;
    }

    /**
     * Set SMS message.
     *
     * @param string $message
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Send SMS.
     *
     * @return array
     */
    public function send()
    {
        return $this->client->executeRequest(
            new OutboundSMSRequest(
                $this->message,
                $this->recipientNumber,
                $this->senderNumber,
                $this->senderName
            )
        );
    }

    /**
     * Get SMS contracts.
     *
     * @param string|null $country
     * @return array
     */
    public function balance($country = null)
    {
        return $this->client->executeRequest(
            new ContractsRequest($country)
        );
    }

    public function realBalance($country = null)
    {
        $balance = $this->balance($country);

        $contracts = $balance['partnerContracts']['contracts'][0]['serviceContracts'][0];

        $restant = $contracts['availableUnits'];
        $date = $contracts['expires'];

        $data = [
            'available' => $restant,
            'expire_in' => $date
        ];

        return $data;
    }



    /**
     * Get SMS orders history.
     *
     * @param string|null $country
     * @return array
     */
    public function ordersHistory($country = null)
    {
        return $this->client->executeRequest(
            new OrdersHistoryRequest($country)
        );
    }

    /**
     * Get SMS statistics.
     *
     * @param string|null $country
     * @param string|null $appID
     * @return array
     */
    public function statistics($country = null, $appID = null)
    {
        return $this->client->executeRequest(
            new StatisticsRequest($country, $appID)
        );
    }

    /**
     * Set the SMS DR notification endpoint.
     *
     * @param $url
     * @param $sender
     * @return array
     */
    public function setDeliveryReceiptNotificationUrl($url, $sender = null)
    {
        return $this->client->executeRequest(
            new SMSDRRegisterCallbackRequest($url, $sender ?: $this->senderNumber)
        );
    }

    /**
     * Check the SMS DR notification endpoint.
     *
     * @param $id
     * @return array
     */
    public function checkDeliveryReceiptNotificationUrl($id)
    {
        return $this->client->executeRequest(
            new SMSDRCheckCallbackRequest($id)
        );
    }

    /**
     * Delete the SMS DR notification endpoint.
     *
     * @param $id
     * @param $sender
     * @return array
     */
    public function deleteDeliveryReceiptNotificationUrl($id, $sender = null)
    {
        return $this->client->executeRequest(
            new SMSDRDeleteCallbackRequest($id, $sender ?: $this->senderNumber)
        );
    }
}
