<?php

namespace App\Command;

use App\Dto\WeatherApiRequest\WeatherRequestDto;
use App\Scenario\Contract\ScenarioInterface;
use App\Scenario\SendWeatherRequestScenario;
use App\ValueObject\PasswordValue;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:testing',
    description: 'Add a short description for your command',
)]
class TestingCommand extends Command
{
    public function __construct(private SendWeatherRequestScenario $scenario)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dto = new WeatherRequestDto('rr', 'Sevastopol');
        dd($this->scenario->execute($dto));
        return Command::SUCCESS;
    }
}
