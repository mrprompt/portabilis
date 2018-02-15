<?php
namespace App\Command;

use App\Service\CourseService;
use App\Entity\CourseEntity;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use League\Csv\Reader;
use League\Csv\Statement;

/**
 * Import courses from csv
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class ImportCoursesCommand extends Command
{
    private $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import:courses')
            ->setDescription('Import courses from csv file.')
            ->setHelp('Import courses from specified csv file.')
            ->addArgument('file', InputArgument::REQUIRED, 'The csv file with courses.')
            ->addArgument('offset', InputArgument::OPTIONAL, 'offset to start - default 0', 0)
            ->addArgument('limit', InputArgument::OPTIONAL, 'limit to import - default 1000', 1000)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Courses Importer',
            '================',
            '',
        ]);

        $file = $input->getArgument('file');
        $offset = $input->getArgument('offset');
        $limit = $input->getArgument('limit');

        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0); //set the CSV header offset

        $stmt = (new Statement())->offset($offset)->limit($limit);

        $records = $stmt->process($csv);
        
        foreach ($records as $record) {
            $course = new CourseEntity;
            $course->setName($record['course_name']);
            $course->setMonthlyPayment((float) $record['monthly_amount']);
            $course->setRegistrationFee((float) $record['registration_tax']);
            $course->setPeriod($record['period']);
            $course->setDuration((int) $record['duration']);

            $this->courseService->create($course);
            
            $output->writeln($course->getName() . ' imported');
        }
    }
}