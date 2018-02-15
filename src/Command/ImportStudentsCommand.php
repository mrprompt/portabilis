<?php
namespace App\Command;

use DateTime;
use App\Service\UserService;
use App\Entity\UserEntity;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use League\Csv\Reader;
use League\Csv\Statement;

/**
 * Import students from csv
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class ImportStudentsCommand extends Command
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import:students')
            ->setDescription('Import students from csv file.')
            ->setHelp('Import students from specified csv file.')
            ->addArgument('file', InputArgument::REQUIRED, 'The csv file with students.')
            ->addArgument('offset', InputArgument::OPTIONAL, 'offset to start - default 0', 0)
            ->addArgument('limit', InputArgument::OPTIONAL, 'limit to import - default 1000', 1000)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Students Importer',
            '=================',
            '',
        ]);

        $file = $input->getArgument('file');
        $offset = $input->getArgument('offset');
        $limit = $input->getArgument('limit');

        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0); //set the CSV header offset
        $csv->setDelimiter(';');

        $stmt = (new Statement())->offset($offset)->limit($limit);

        $records = $stmt->process($csv);
        
        foreach ($records as $record) {
            $user = new UserEntity;
            $user->setName($record['name']);
            $user->setInternalId($record['id']);
            $user->setEmail($record['cpf'] . '@portabilis.com.br');
            $user->setPassword($record['cpf'] . $record['rg']);
            $user->setDocumentCPF($record['cpf']);
            $user->setDocumentRG($record['rg']);
            $user->setPhoneNumber($record['phone']);
            $user->setBirthDay(new DateTime($record['birthday']));

            $this->userService->create($user);
            
            $output->writeln($user->getName() . ' imported');
        }
    }
}