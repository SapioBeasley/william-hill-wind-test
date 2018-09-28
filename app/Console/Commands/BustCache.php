<?php

namespace App\Console\Commands;

use App\Lib\CacheInterface;
use Illuminate\Console\Command;

class BustCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bust:wind {zipcode}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear wind cache for specified zipcode';

    /** @var $cacheInterface */
    protected $cacheInterface;

    /**
     * Create a new command instance.
     * @param CacheInterface $cacheInterface
     * @return void
     */
    public function __construct(CacheInterface $cacheInterface)
    {
        parent::__construct();

        $this->cacheInterface = $cacheInterface;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Clearing cache for ' . $this->argument('zipcode'));

        if ($this->cacheInterface->has($this->argument('zipcode'))) {
            $this->info('Zip code has not been cached');
        }

        $this->cacheInterface->forget($this->argument('zipcode'));

        $this->info('Cache has been busted');
    }
}
