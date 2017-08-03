<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding;

use Illuminate\Console\Command;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\SharedMethods;

class MigrationBuilder extends Command
{
    use SharedMethods;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:migration {name : Name of the service package in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create migration for a service';

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
        $table = $this->getTableName();
        $this->call('make:migration', [
            'name' => 'create_'.$table.'_table',
            '--create' => $table
        ]);
    }
    
}
