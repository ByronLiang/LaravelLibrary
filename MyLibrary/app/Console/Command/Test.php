<?php

namespace App\Console\Command;

use Illuminate\Console\Command;

class Test extends Command
{
	protected $signature = 'command:test';

    protected $description = 'test some order';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
    	$this->info('Hello, this is my question?');
    	$name = $this->ask('What is your name? ');
    	$this->error('Your name is '. $name . ' I do not like you, sorry that!');
    }
}