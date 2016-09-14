<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\PriceNotification;
use Illuminate\Notifications\Notifiable;

use Goutte;
use App\Pin;
use App\User;

use DB;

use Notification;

class Scrape extends Command
{

    use Notifiable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all prices in database';

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
     * @return mixed
     */
    public function handle()
    {
        $ids = DB::table('pins')->pluck('id');
        foreach ($ids as $id) {
            $pin = DB::table('pins')->find($id);
            $url = $pin->url;
            $crawler = Goutte::request('GET', $url);  
            $price = filter_var($crawler->filter('#prix, #main .price')->first()->text(),FILTER_SANITIZE_NUMBER_INT);
            DB::table('pins')->where('id',$id)->update(['actual_price'=>$price]);   

            if ($pin->want_price <= $price){
                $user = DB::table('users')->find($pin->user_id);
                Notification::send($user, new PriceNotification($pin));
            }     
        } 

    }
}
