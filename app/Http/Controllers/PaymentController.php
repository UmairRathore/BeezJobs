<?php

namespace App\Http\Controllers;

use App\Models\UserCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


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
        ]);

        $user_id = $validatedData['user_id'];
        $card = UserCards::where('user_id', $user_id)->first();


        if ($card) {
            // Update the existing card information
            $card->card_number = Crypt::encrypt($validatedData['card_number']);
            $card->expiring = Crypt::encrypt($validatedData['expiring']);
            $card->cvv = Crypt::encrypt($validatedData['cvv']);
            $card->save();
            $message = 'Card information updated successfully!';
        } else {
            // Create a new card entry
            $card = new UserCards();
            $card->user_id = $user_id;
            $card->card_number = Crypt::encrypt($validatedData['card_number']);
            $card->full_name = $validatedData['full_name'];
            $card->expiring = Crypt::encrypt($validatedData['expiring']);
            $card->cvv = Crypt::encrypt($validatedData['cvv']);
            $card->save();
            $message = 'Card information saved successfully!';
        }

        return redirect()->back()->with('success', $message)->with('card', $card);
    }


}
