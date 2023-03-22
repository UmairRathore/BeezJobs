<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    function add_freelancer_portfolio(Request $request)
    {

        $user_id = auth()->user()->id;
        $image = '';
        $date = date('d-m-Y');
        if ($request->hasFile('file')) {
            $image = $request->file;
            $fileName = date('dmyhisa') . '-' . $image->getClientOriginalName();
            $fileName = str_replace(" ", "-", $fileName);
            $image->move('images/user_portfolio/' . $date . '/', $fileName);
            $image = 'images/user_portfolio/' . $date . '/' . $fileName;
        }

        $portfolio = new Portfolio();
        $portfolio->title = $request->title;
        $portfolio->link = $request->link;
        $portfolio->file = $image;
        $portfolio->user_id = $user_id;
        $check = $portfolio->save();
        if ($check) {
            return redirect()->back()->with('alert', 'Portfolio is added successfully!');
        } else {
            return redirect()->back()->with('alert', 'Something is wrong!');
        }
    }
    function delete_freelancer_portfolio($id)
    {
        $data = Portfolio::where('id', $id)->first();
        if ($data) {
            $data->delete();
            return redirect()->back()->with('alert', 'Portfolio is Deleted Successfully!');
        } else {
            return redirect()->back()->with('alert', 'Something is wrong!');

        }
    }
}