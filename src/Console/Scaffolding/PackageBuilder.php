<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding;

use Illuminate\Console\Command;

class PackageBuilder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:package {name : Name of the service package in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service package';

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
        $this->call('toolkit:model', ['name' => $this->argument('name')]);
        $this->call('toolkit:migration', ['name' => $this->argument('name')]);
        $this->call('toolkit:contract', ['name' => $this->argument('name')]);
        $this->call('toolkit:service', ['name' => $this->argument('name')]);
        $this->call('toolkit:controller', ['name' => $this->argument('name')]);
        $this->call('toolkit:routes', ['name' => $this->argument('name')]);
        $this->call('toolkit:views', ['name' => $this->argument('name')]);
    }
    
}
