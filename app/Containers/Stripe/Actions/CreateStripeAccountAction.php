<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Stripe\Models\StripeAccount;
use App\Containers\Stripe\Repositories\Eloquent\StripeAccountRepository;
use App\Containers\User\Models\User;
use App\Port\Action\Abstracts\Action;
use Auth;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @var  \App\Containers\Stripe\Repositories\Eloquent\StripeAccountRepository
     */
    private $stripeAccountRepository;

    /**
     * CreateStripeAccountAction constructor.
     *
     * @param \App\Containers\Stripe\Repositories\Eloquent\StripeAccountRepository $stripeAccountRepository
     */
    public function __construct(StripeAccountRepository $stripeAccountRepository)
    {
        $this->stripeAccountRepository = $stripeAccountRepository;
    }

    /**
     * Create stripe account in my database
     *
     * @param \App\Containers\User\Models\User $user
     * @param                                  $customer_id
     * @param                                  $card_id
     * @param                                  $card_funding
     * @param                                  $card_last_digits
     * @param                                  $card_fingerprint
     *
     * @return  \App\Containers\Stripe\Models\StripeAccount|mixed
     */
    public function run(User $user, $customer_id, $card_id, $card_funding, $card_last_digits, $card_fingerprint)
    {
        $stripeAccount = new StripeAccount();
        $stripeAccount->customer_id = $customer_id;
        $stripeAccount->card_id = $card_id;
        $stripeAccount->card_funding = $card_funding;
        $stripeAccount->card_last_digits = $card_last_digits;
        $stripeAccount->card_fingerprint = $card_fingerprint;
        $stripeAccount->user()->associate($user);

        $stripeAccount = $this->stripeAccountRepository->create($stripeAccount->toArray());

        return $stripeAccount;
    }

}
