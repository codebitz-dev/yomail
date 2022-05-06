<?php

namespace Codebitz\Yomail\Commands;

use Illuminate\Console\Command;
use Artisan;

class YoMailInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yomail:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->runMigrations();
        $this->installConfig();
        $this->installAssets();
        $this->info('');
        $this->info('👍 Yomail has been installed.');
        $this->info('⭐ If you like this package please star it on Github https://github.com/codebitz-dev/yomail');
        $this->info('⚡ You can also follow me on Twitter https://twitter.com/aaronlumsden');
        return 0;
    }

    private function installConfig(){
        Artisan::call('vendor:publish --tag=yomailconfig --force');
        $this->info('✅ YoMail config file installed at '.config_path('yomail.php'));
    }

    private function installAssets(){
        Artisan::call('vendor:publish --tag=yomailassets --force');
        $this->info('✅ Assets created!');
    }

    private function runMigrations(){
        $feedback = Artisan::call('migrate');
        $this->info('✅ YoMail migrations run!');
    }
}
