<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AuthTokenGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um token para ser utilziado no AuthRedirect entre aplicações';

    /**
     * Instância o token
     * @var
     */
    protected static $token;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        self::$token = Str::random(32);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (file_exists($path = $this->envPath()) === false) {
            return $this->displayKey();
        }

        if (Str::contains(file_get_contents($path), 'AUTH_TOKEN') === false) {
            file_put_contents($path, PHP_EOL . "AUTH_TOKEN=" . self::$token, FILE_APPEND);
        } else {
            // Cria a nova entrada
            file_put_contents($path, str_replace(
                'AUTH_TOKEN=' . env('AUTH_TOKEN'),
                'AUTH_TOKEN=' . self::$token, file_get_contents($path)
            ));
        }
        $this->displayKey();
    }

    /**
     *
     */
    protected function displayKey()
    {
        $this->info("Seu novo token: [" . self::$token . "] gerado com sucesso.");
    }

    /**
     * Obtem o Path do arquivo .env
     * @return string
     */
    protected function envPath()
    {
        if (method_exists($this->laravel, 'environmentFilePath')) {
            return $this->laravel->environmentFilePath();
        }
        // Check na versão do laravel 5.4.17
        if (version_compare($this->laravel->version(), '5.4.17', '<')) {
            return $this->laravel->basePath() . DIRECTORY_SEPARATOR . '.env';
        }
        return $this->laravel->basePath('.env');
    }
}
