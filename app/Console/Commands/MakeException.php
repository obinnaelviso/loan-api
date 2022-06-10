<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeException extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:exception {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create custom exceptions for reporting errors';

    protected $type = 'Exception';

    public function getStub()
    {
        return __DIR__ . '/stubs/exception.stub';
    }

    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Exceptions';
    }

    public function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('DummyException', $this->argument('name'), $stub);
    }
}
