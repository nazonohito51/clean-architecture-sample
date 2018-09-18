<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Acme\Application\UseCases\GetUserInteractor;
use App\Presenters\ConsolePresenter;
use App\UseCaseRequests\GetUserRequest;
use App\ViewModels\ViewModel;
use Illuminate\Console\Command;

class GetUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:get {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get user';

    /**
     * @var GetUserInteractor
     */
    private $useCase;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GetUserInteractor $useCase)
    {
        parent::__construct();
        $this->useCase = $useCase;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $response = $this->useCase->handle(new GetUserRequest((int)$this->argument('id')));

        $viewModel = new ViewModel([
            'id' => $response->getUserId(),
            'name' => $response->getUserName(),
            'email' => $response->getMailAddress()
        ]);
        (new ConsolePresenter($this->output))->info($viewModel);
    }
}
