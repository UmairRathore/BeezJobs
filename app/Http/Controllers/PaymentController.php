<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use App\Models\StripeConnect;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\UserCards;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Stripe\Account;
use Stripe\PaymentIntent;
use Stripe\Payout;
use Stripe\Stripe;
use Stripe\Transfer;


class PaymentController extends Controller
{
    //
    public function storeOrUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'card_number' => 'required',
            'full_name' => 'required',
            'expiring' => 'required',
            'cvv' => 'required',
            'ssn_last_4' => 'nullable|digits:4',
            'phone' => 'nullable',
            'email' => 'email',
            'routing_number' => 'required_with:account_number',
            'account_number' => 'required_with:routing_number',
        ]);

        $user_id = $validatedData['user_id'];
        $card = UserCards::where('user_id', $user_id)->first();

        if ($card) {
            // Update the existing card and bank account information
            $card->card_number = Crypt::encrypt($validatedData['card_number']);
            $card->expiring = $validatedData['expiring'];
            $card->cvv = Crypt::encrypt($validatedData['cvv']);
            $card->ssn_last_4 = $validatedData['ssn_last_4'];
            $card->phone = $validatedData['phone'];
            $card->email = $validatedData['email'];
            $card->routing_number = Crypt::encrypt($validatedData['routing_number']);
            $card->account_number = Crypt::encrypt($validatedData['account_number']);
            $card->save();
            $message = 'Card and bank account information updated successfully!';
        } else {
            // Create a new card and bank account entry
            $card = new UserCards();
            $card->user_id = $user_id;
            $card->card_number = Crypt::encrypt($validatedData['card_number']);
            $card->full_name = $validatedData['full_name'];
            $card->expiring = $validatedData['expiring'];
            $card->cvv = Crypt::encrypt($validatedData['cvv']);
            $card->ssn_last_4 = $validatedData['ssn_last_4'];
            $card->phone = $validatedData['phone'];
            $card->email = $validatedData['email'];
            $card->routing_number = Crypt::encrypt($validatedData['routing_number']);
            $card->account_number = Crypt::encrypt($validatedData['account_number']);
            $card->save();
            $message = 'Card and bank account information saved successfully!';
        }

        return redirect()->back()->with('success', $message)->with('card', $card);
    }


    public function checkpayment(Request $request)
    {
        $id = '22';

        // Retrieve the offer and payment details
        $order = Order::find($id);
        $paymentIntentId = $order->payment_intent_id;
        $offerId = $order->offer_id;

        // Retrieve the from the orders table
        $order_id = $order->id;


        // Retrieve the seller_id and buyer_id from the messages table
        $message = Message::where('offer_id', $offerId)->first();
        $sellerId = $message->receiver_id;
        $buyer_id = $message->sender_id;

        // Retrieve the seller's bank account details from the database
        $sellerBank = UserCards::select('users.*', 'user_cards.*', 'user_cards.email as card_email')
            ->where('user_id', $sellerId)->join('users', 'users.id', 'user_cards.user_id')->first();
        $sellerAccountNumber = decrypt($sellerBank->account_number);
        $sellerRoutingNumber = decrypt($sellerBank->routing_number);
        $sellerEmail = $sellerBank->card_email;
        $sellerSSNLastFour = $sellerBank->ssn_last_4;
        $sellerPhoneNumber = $sellerBank->phone;
        $sellerBusinessWebsite = 'http://beezjobs.com/';

        $sellerBirthday = $sellerBank->birthday;
// Split the date into day, month, and year components
        list($sellerYear, $sellerMonth, $sellerDay) = explode('-', $sellerBirthday);


        // Retrieve the seller's bank account details from the database
        $adminBank = UserCards::select('users.*', 'user_cards.*', 'user_cards.email as card_email')->where('user_id', 1)->join('users', 'users.id', 'user_cards.user_id')->first();
        $adminAccountNumber = decrypt($adminBank->account_number);
        $adminRoutingNumber = decrypt($adminBank->routing_number);
        $adminEmail = $adminBank->card_email;
        $adminSSNLastFour = $adminBank->ssn_last_4;
        $adminPhoneNumber = $adminBank->phone;
        $adminBusinessWebsite = 'http://beezjobs.com/';

        $adminBirthday = $adminBank->birthday; // Assuming $sellerBank->birthday is "1995-04-09"
        list($adminYear, $adminMonth, $adminDay) = explode('-', $adminBirthday);


        if ($paymentIntentId) {

            $paymentIntentId = 'pi_3Nfp4kBKx4V0XOuh2oZTDCWs';
            // Retrieve the payment intent
            Stripe::setApiKey('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');
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
//            dd($paymentIntent->amount);
 
            $checkStripeConnect = StripeConnect::where('user_id', $sellerId)->first();
            if ($checkStripeConnect == null) {
                $sellerConnectAccount = Account::create([
                    'type' => 'custom',
                    'country' => 'US',
                    'email' => $sellerEmail,
                    'business_type' => 'individual',
                    'capabilities' => [
                        'transfers' => ['requested' => true],
                    ],
                    'individual' => [
                        'first_name' => $sellerBank->full_name,
                        'last_name' => $sellerBank->full_name,
                        'dob' => [
                            'day' => $sellerDay,
                            'month' => $sellerMonth,
                            'year' => $sellerYear,
                        ],
                        'email' => $sellerEmail,
                        'ssn_last_4' => $sellerSSNLastFour,
                        'phone' => $sellerPhoneNumber,
                    ],
                    'business_profile' => [
                        'mcc' => '7372', // Merchant Category Code (dummy value for illustrative purposes)
                        'url' => $sellerBusinessWebsite,
                    ],
                    'external_account' => [
                        'object' => 'bank_account',
                        'country' => 'US',
                        'currency' => 'usd',
                        'routing_number' => $sellerRoutingNumber,
                        'account_number' => $sellerAccountNumber,
                    ],
                ]);

// Update the terms of service acceptance for the connected account
                $acceptTermsofService = Account::update(
                    $sellerConnectAccount->id,
                    [
                        'tos_acceptance' => [
                            'date' => time(), // Replace with the actual timestamp of acceptance
                            'ip' => $_SERVER['REMOTE_ADDR'], // Replace with the user's IP address
                        ],
                    ]
                );

                // Use the created seller Connect account for the payment
                $sellerBankAccountID = $sellerConnectAccount->external_accounts->data[0]->id;
                $sellerAccountId = $sellerConnectAccount->id;

                $stripeConnect = new StripeConnect();
                $stripeConnect->bank_account_id = $sellerBankAccountID;
                $stripeConnect->connect_id = $sellerAccountId;
                $stripeConnect->user_id = $sellerId;
                $stripeConnect->save();

            } else {
                $SellerConnectStripeConnect = $checkStripeConnect->connect_id;
                $sellerAccountId = $SellerConnectStripeConnect;
            }

            $adminId = '1';
            $checkAdminStripeConnect = StripeConnect::where('user_id', $adminId)->first();
            if ($checkAdminStripeConnect == null) {
                $adminConnectAccount = Account::create([
                    'type' => 'custom',
                    'country' => 'US',
                    'email' => $adminEmail,
                    'business_type' => 'individual',
                    'capabilities' => [
                        'transfers' => ['requested' => true],
                    ],
                    'individual' => [
                        'first_name' => $adminBank->full_name,
                        'last_name' => $adminBank->full_name,
                        'dob' => [
                            'day' => $adminDay,
                            'month' => $adminMonth,
                            'year' => $adminYear,
                        ],
                        'email' => $adminEmail,
                        'ssn_last_4' => $adminSSNLastFour,
                        'phone' => $adminPhoneNumber,
                    ],
                    'business_profile' => [
                        'mcc' => '7372', // Merchant Category Code (dummy value for illustrative purposes)
                        'url' => $adminBusinessWebsite,
                    ],
                    'external_account' => [
                        'object' => 'bank_account',
                        'country' => 'US',
                        'currency' => 'usd',
                        'routing_number' => $adminRoutingNumber,
                        'account_number' => $adminAccountNumber,
                    ],
                    // Additional settings and details...
                ]);

                $acceptTermsofService = Account::update(
                    $adminConnectAccount->id,
                    [
                        'tos_acceptance' => [
                            'date' => time(), // Replace with the actual timestamp of acceptance
                            'ip' => $_SERVER['REMOTE_ADDR'], // Replace with the user's IP address
                        ],
                    ]
                );

//        // Retrieve the admin's account ID from the created account object and stripe connect bank_account id
                $adminBankAccountID = $adminConnectAccount->external_accounts->data[0]->id;
                $adminAccountId = $adminConnectAccount->id;

                $stripeConnect = new StripeConnect();
                $stripeConnect->bank_account_id = $adminBankAccountID;
                $stripeConnect->connect_id = $adminAccountId;
                $stripeConnect->user_id = $adminId;
                $stripeConnect->save();
            } else {
                $AdminConnectStripeConnect = $checkAdminStripeConnect->connect_id;
                $adminAccountId = $AdminConnectStripeConnect;
            }


            // Get the captured amount from the payment intent
            $capturedAmount = $paymentIntent->amount / 100; // Convert amount from cents to dollars

            // Calculate the amounts for admin and seller
            $adminAmount = $capturedAmount * 0.05; // 5% for admin
            $sellerAmount = $capturedAmount - $adminAmount; // Remaining for seller


            // Create a transfer top seller's Connect account
            $sellerTransfer = Transfer::create([
                'amount' => $sellerAmount * 100, // Convert amount to cents
                'currency' => 'usd',
                'destination' => $sellerAccountId, // Use the seller's Connect account ID
                'transfer_group' => $offerId, // Use a unique identifier for the transfer
            ]);

            // Create a transfer to admin's Connect account
            $adminTransfer = Transfer::create([
                'amount' => $adminAmount * 100, // Convert amount to cents
                'currency' => 'usd',
                'destination' => $adminAccountId, // Use the admin's Connect account ID
                'transfer_group' => $offerId, // Use a unique identifier for the transfer
            ]);

            // Handle any errors during transfers
            if ($sellerTransfer->status !== 'completed' || $adminTransfer->status !== 'completed') {
                return back()->with('error', 'Transfer to Connect account failed. Please try again.');
            }


            // Record the Amount in  wallet for seller
            $wallet = Wallet::where('user_id', $sellerId)->first();
            $wallet->uncleared_balance += $sellerAmount;
            $wallet->save();

            // Record the transaction history for seller
            $sellerTransaction = new TransactionHistory();
            $sellerTransaction->user_id = $sellerId;
            $sellerTransaction->amount = $sellerAmount;
            $sellerTransaction->type = 'received';
            $sellerTransaction->offer_id = $offerId;
            $sellerTransaction->save();

            // Record the transaction history for admin
            $adminTransaction = new TransactionHistory();
            $adminTransaction->user_id = 1;
            $adminTransaction->amount = $adminAmount;
            $adminTransaction->type = 'received';
            $adminTransaction->offer_id = $offerId;
            $adminTransaction->save();

            $transfercheckforcompletion = new \App\Models\Transfer();
            $transfercheckforcompletion->seller_id = $sellerId;
            $transfercheckforcompletion->buyer_id = $buyer_id;
            $transfercheckforcompletion->order_id = $order_id;
            $transfercheckforcompletion->amount = $sellerAmount;
            $transfercheckforcompletion->status = 'un_cleared';
            $transfercheckforcompletion->save();
        }

        return back()->with('accepted', 'Order Task submission accepted Successfully');
    }


}
