<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {model} {--reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criador de Repository';

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
        $model = $this->argument('model');
        $options = $this->options();

        if (!file_exists(app_path('Repositories/') . "BaseRepository.php")) {
            mkdir(app_path('Repositories'));
            $this->info('Diretório app/Repositories criado');
            $this->makeBaseRepository();
        }

        if (!file_exists(app_path('Models/') . "{$model}.php")) {
            $this->error('O modelo não existe');
            return;
        }

        if (file_exists(app_path('Repositories/') . "{$model}Repository.php")) {
            if ($options['reset']) {
                $this->make($model);
                return;
            }
            $this->error('Este repositório já existe, caso queira refazê-lo, acrescente o option --reset');
            return;
        }

        $this->make($model);
    }

    protected function make($model)
    {
        $struct = '<?php

namespace App\Repositories;

use App\Models\%1$s;

/**
 * Class %1$sRepository
 * @package App\Repositories
 */
class %1$sRepository extends BaseRepository
{
    /**
     * @var %1$s
     */
    public $model;
    
    /**
     * %1$sRepository constructor.
     * @param %1$s $%1$s
     */
    public function __construct(%1$s $%1$s)
    {
        $this->model = $%1$s;
    }
}';
        file_put_contents(app_path('Repositories/') . "{$model}Repository.php", sprintf($struct, $model));
        $this->info('Repositório criado com sucesso');
    }

    protected function makeBaseRepository()
    {
        $struct = '<?php
        
namespace App\Repositories;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
abstract class BaseRepository
{
    /**
     * @var
     */
	protected $model;

    /**
     * @param $id
     * @return mixed
     */
	public function find($id)
	{
		return $this->model->find($id);
	}

    /**
     * @param $data
     * @return mixed
     */
	public function create($data)
	{		
		return $this->model->create($data);
	}

    /**
     * @param $data
     * @return mixed
     */
	public function delete($data)
	{
		return $this->model->delete($data);
	}

    /**
     * @return mixed
     */
	public function all()
	{
		return $this->model->all();
	}

    /**
     * @return mixed
     */
	public function model()
	{
		return $this->model;
	}
}';
        file_put_contents(app_path('Repositories/') . "BaseRepository.php", sprintf($struct));
        $this->info('BaseRepository.php criado com sucesso');
    }
}
