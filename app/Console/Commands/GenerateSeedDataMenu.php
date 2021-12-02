<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSeedDataMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed_menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate data menu';

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
        $items = \App\Models\Menu::get();
        $path = database_path('data/menu.json');
        file_put_contents($path, json_encode($items->toArray()));
        return 0;
    }
}
