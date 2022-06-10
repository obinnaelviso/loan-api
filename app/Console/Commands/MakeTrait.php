<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeTrait extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create traits for additional functions';

    protected $type = 'Trait';

    public function getStub()
    {
        return __DIR__ . '/stubs/trait.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Traits';
    }

    public function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('DummyTrait', $this->argument('name'), $stub);
    }
}
