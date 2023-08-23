<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Transfer;
use App\Models\Wallet;


class ClearUnclearedBalances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:clear_uncleared_balances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear uncleared balances from pending transfers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pendingTransfers = Transfer::where('status', 'un_cleared')->get();
        foreach ($pendingTransfers as $transfer) {
            if (Carbon::parse($transfer->created_at)->addDays(7)->isPast()) {
                $transfer->status = 'cleared';
                $transfer->save();

                $wallet = Wallet::where('user_id', $transfer->buyer_id)->first();
                $uncleared_balance = $wallet->uncleared_balance - $transfer->amount;
                $available_balance = $wallet->available_balance + $transfer->amount;
                $total_earnings = $wallet->total_balance + $transfer->amount;
                $wallet->uncleared_balance =  $uncleared_balance; // Deduct from uncleared balance
                $wallet->available_balance = $available_balance; // Add to available balance
                $wallet->total_balance = $total_earnings; // Add to Total_earnings
                $wallet->save();

                $this->info('Pending transfers marked as completed after 7-day waiting period.');
            }
        }

//        $completedTransfers = Transfer::where('status', 'cleared')->get();
//
//        foreach ($completedTransfers as $transfer) {
//            $wallet = Wallet::where('user_id', $transfer->user_id)->first();
//            $wallet->uncleared_balance -= $transfer->amount; // Deduct from uncleared balance
//            $wallet->available_balance += $transfer->amount; // Add to available balance
//            $wallet->total_earnings += $transfer->amount; // Add to Total_earnings
//            $wallet->save();
//            $this->info('Uncleared balance updated for completed transfers.');
//        }
    }


}
