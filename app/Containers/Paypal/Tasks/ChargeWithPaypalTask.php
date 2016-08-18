<?php

namespace App\Containers\Paypal\Tasks;

use Anouar\Paypalpayment\PaypalPayment;
use App\Containers\Payment\Contracts\Chargeable;
use App\Containers\Paypal\Exceptions\PaypalApiErrorException;
use App\Containers\User\Models\User;
use App\Port\Task\Abstracts\Task;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Class ChargeWithPaypalTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ChargeWithPaypalTask extends Task implements Chargeable
{

    /**
     * @var  \Anouar\Paypalpayment\PaypalPayment
     */
    private $paypalPayment;

    /**
     * ChargeWithPaypalTask constructor.
     *
     * @param \Anouar\Paypalpayment\PaypalPayment $paypalPayment
     */
    public function __construct(Paypalpayment $paypalPayment)
    {
        $this->paypalPayment = $paypalPayment;

        $this->paypalApi = $paypalPayment->apiContext(
            Config::get('paypal_payment.Account.ClientId'),
            Config::get('paypal_payment.Account.ClientSecret')
        );
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $amount
     * @param string                           $currency
     *
     * @return  array|null
     */
    public function run(User $user, $amount, $currency = 'USD')
    {

        // TODO:
        // this is code sample from the package readme.
        // this does not seem to be compatible with paypal
        // I need to remove this package (Paypalpayment) and replace with something else
        // was checking the Payum laravel package seems compatible with Paypal Express Checkout

        $card = $this->paypalPayment->creditCard();
        $card->setType("visa")
            ->setNumber("4758411877817150")
            ->setExpireMonth("05")
            ->setExpireYear("2019")
            ->setCvv2("456")
            ->setFirstName("Joe")
            ->setLastName("Shopper");

        $fi = $this->paypalPayment->fundingInstrument();
        $fi->setCreditCard($card);

        $payer = $this->paypalPayment->payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));

        $item1 = $this->paypalPayment->item();
        $item1->setName('Ground Coffee 40 oz')
            ->setDescription('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setTax(0.3)
            ->setPrice(7.50);

        $item2 = $this->paypalPayment->item();
        $item2->setName('Granola bars')
            ->setDescription('Granola Bars with Peanuts')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setTax(0.2)
            ->setPrice(2);

        $itemList = $this->paypalPayment->itemList();
        $itemList->setItems(array($item1, $item2));

        $details = $this->paypalPayment->details();
        $details->setShipping("1.2")
            ->setTax("1.3")
            //total of items prices
            ->setSubtotal("17.5");

        //Payment Amount
        $amount = $this->paypalPayment->amount();
        $amount->setCurrency("USD")
            // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
            ->setTotal("20")
            ->setDetails($details);

        $transaction = $this->paypalPayment->transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $payment = $this->paypalPayment->payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));

        try {

            $response = $payment->create($this->paypalApi);

        } catch (Exception $e) {
            throw (new PaypalApiErrorException('Paypal API error (payment)'))->debug($e->getMessage(), true);
        }

        if ($response['state'] != 'approved') {
            throw new PaypalApiErrorException('Paypal response status not succeeded (payment)');
        }

        // this data will be stored on the pivot table (user credits)
        return [
            'payment_method' => 'paypal',
            'description'    => $response['id'], // Pay ID
        ];
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $amount
     * @param string                           $currency
     *
     * @return  array|null
     */
    public function charge(User $user, $amount, $currency = 'USD')
    {
        return $this->run($user, $amount, $currency);
    }

}
