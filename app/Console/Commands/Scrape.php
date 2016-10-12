<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\PriceNotification;

use App\Pin;
use App\User;

use DB;

use App\Services\Contracts\ScrapeServiceContract;


class Scrape extends Command
{

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
    public function __construct(ScrapeServiceContract $scrapeService)
    {
        parent::__construct();
        $this->scrape = $scrapeService;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $alreadyNotified = [];
        $ids = DB::table('pins')->pluck('id');
        foreach ($ids as $id) {
            $pin = Pin::find($id);
            $url = $pin->url;

            $price = $this->scrape->scrapePrice($url);
            $this->info($price);
            DB::table('pins')->where('id',$id)->update(['actual_price'=>$price]);   

            if ($pin->want_price >= $price){
                $user = User::find($pin->user_id);
                $cole = $user->notifications->pluck('data');
                foreach ($cole as $col){
                    array_push($alreadyNotified, $col['pin_id']);
                }
                if (in_array($id, $alreadyNotified)==false){
                     $user->notify(new PriceNotification($pin));
                }
            }     
        } 

    }
}
