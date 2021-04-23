<?php

namespace App\Console\Commands;

use App\KategoriUsaha;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email every minutes';

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
            'kategori_usaha' => "usaha besar 12",     
            'created_at' => date("Y-m-d h:i:s")
        ]);
    }
}
