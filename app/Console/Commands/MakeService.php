<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {service} {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criador de services';

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
        $service = $this->argument('service');
        $options = $this->options();

        if (!is_dir(app_path('Services'))) {
            mkdir(app_path('Services'));
            $this->info('Diretório app/Services criado');
        }

        if (file_exists(app_path('Services/') . "{$service}Service.php")) {
            if ($options['reset']) {
                $this->make($service);
                return;
            }
            $this->error('Este serviço já existe, caso queira refazê-lo, acrescente o option --reset');
            return;
        }

        $this->make($service);
    }

    protected function make($service)
    {
        $estrutura = '<?php

namespace App\Services;

/**
 * Class %1$sService
 * @package App\Services
 */
class %1$sService
{
    /**
     * %1$sService constructor.
     */
    public function __construct()
    {
        #call your models, repositories and another things here
    }
}';

        file_put_contents(app_path('Services/') . $service . 'Service.php', sprintf($estrutura, $service));
        $this->info('Service criado com sucesso');
    }
}
