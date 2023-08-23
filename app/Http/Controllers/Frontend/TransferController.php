<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\StripeConnect;
use App\Models\UserCards;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Payout;
use Stripe\Stripe;
use Stripe\Transfer;

class TransferController extends Controller
{
    public function initiateTransfer(Request $request)
    {

        try {
        Stripe::setApiKey('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');
//
//            // Retrieve the user's Connect account ID from your database
//
        $StripeConnectAccountId = StripeConnect::where('user_id', auth()->user()->id)->first();
//
        $userConnectAccountId = $StripeConnectAccountId->connect_id;
        $userConnectBankAccountId = $StripeConnectAccountId->bank_account_id;

            $amountInCents = $request->amount;

            $amountInDollars = $amountInCents * 100 ;

        $payout = \Stripe\Payout::create([
            'amount' => $amountInDollars,
            'currency' => 'usd',
            'description' => 'first payout payment transfer on stripe',
            'destination' => $userConnectBankAccountId,
            'source_type' => 'bank_account',
            'statement_descriptor' => 'first payout payment transfer on stripe ',
        ],
            ["stripe_account" => "$userConnectAccountId"]);

            if ($payout->status === 'completed') {
                $amountInDollars = $amountInCents / 100;
                ///minus the total amount from the wallet of the user
                $wallet = Wallet::find(auth()->user()->id);
                $walletBalanceRemaining = $wallet->available_balance - $amountInDollars;
                $wallet->available_balance=$walletBalanceRemaining;
                $wallet->save();
                return response()->json(['message' => 'Transfer completed successfully']);
            } else {
                return response()->json(['message' => 'Transfer failed'], 500);
            }

        } catch (\Exception $e) {
            // Handle error response
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred. Please try again later.'], 500);
        }
    }

}
