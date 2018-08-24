<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 22/08/18
 * Time: 13:36
 */

namespace App\Command;


use App\Repository\VehicleCheckRepository;
use App\Service\AntenasManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FinishVehicleChecksCommand extends Command
{
//    private $vehicleCheckRepository;
    private $antenasManager;

    /**
     * FinishVehicleChecksCommand constructor.
     * @param $vehicleCheckRepository
     */
    public function __construct(AntenasManager $antenasManager)
    {
        $this->antenasManager = $antenasManager;
        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setName('app:finish-checks')
            ->setDescription('Finishes current VehicleChecks and sets to current next paused in line')
            ->setHelp('just use php bin/console app:finish-checks');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->antenasManager->changeVehicleCheckStatusCommand();
        if($result['set_to_current'] > 0) {
            $vehicleCheck = $this->antenasManager->getCurrentVehicleCheck();
            $this->antenasManager->sendVehicleCheckToSocket($vehicleCheck);
        }
//        $result = $this->vehicleCheckRepository->changeVehicleCheckStatusCommand();
//        $output->writeln("rows afectados: $result");
    }

}