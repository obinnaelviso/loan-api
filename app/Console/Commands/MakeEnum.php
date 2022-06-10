<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeEnum extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:enum {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create enums for holding constants';

    protected $type = 'Enum';

    public function getStub()
    {
        return __DIR__ . '/stubs/enum.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Enums';
    }

    public function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('DummyEnum', $this->argument('name'), $stub);
    }
}
