<?php
 
namespace App\Console\Commands;

use App\KategoriUsaha;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
 
class testCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
 
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
        KategoriUsaha::create([
            'uuid'=> Str::random(36),
            'kategori_usaha' => "usaha besar",     
            'created_at' => date("Y-m-d h:i:s")
        ]);
       
    }
}