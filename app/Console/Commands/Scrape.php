<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Goutte;
use App\Pin;
use DB;

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
            $url = DB::table('pins')->where('id',$id)->value('url');
            $crawler = Goutte::request('GET', $url);  
            $price = filter_var($crawler->filter('#prix, .price')->text(),FILTER_SANITIZE_NUMBER_INT);
            DB::table('pins')->where('id',$id)->update(['actual_price'=>$price]);
        } 

    }
}
