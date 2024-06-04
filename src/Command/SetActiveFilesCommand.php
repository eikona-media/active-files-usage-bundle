<?php

namespace EikonaMedia\Contao\ActiveFilesUsageBundle\Command;

use Contao\Controller;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\Database;
use Contao\FilesModel;
use Contao\StringUtil;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: "eikona-media:set-active-files", description: "set active or used files to true in the database")]
class SetActiveFilesCommand extends Command
{

    private ContaoFramework $framework;


    public function __construct(ContaoFramework $framework)
    {

        parent::__construct();

        $this->framework = $framework;

    }

    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {


        $this->framework->initialize();
        $connection = Database::getInstance();
        $allTables = $connection->prepare('show tables;')->execute();

        foreach ($allTables->fetchAllAssoc() as $table)
        {
            foreach ($table as $key => $value)
            {
                $table = Controller::loadDataContainer($value);

                if (!empty($GLOBALS['TL_DCA'][$value]))
                {

                    // TL_DCA tl_jobs fields -> will find it
                    // TL_DCA tl_content (content) fields
                    foreach ($GLOBALS['TL_DCA'][$value]['fields'] as $key => $field)
                    {

                        if (!empty($field['inputType'])) {

                            if ($field['inputType'] === 'fileTree') {
                                $sqlStatement = sprintf('SELECT * from %s WHERE %s IS NOT NULL',$value,$key);
                                $tableColumnFiles = $connection->query($sqlStatement)->fetchAllAssoc();
                                foreach ($tableColumnFiles as $colKey => $colValue)
                                {
                                    try {
                                        if (!empty($colValue[$key] && !str_ends_with($colValue[$key], "{}"))) {

                                            $fileUuid = StringUtil::binToUuid(($colValue[$key]));
                                            $file = FilesModel::findByUuid($fileUuid);
                                            if (!empty($file)) {
                                                $sqlUpdateStatement = sprintf('UPDATE tl_files SET active_file = 1 WHERE id = %s', $file->id);
                                                $connection->execute($sqlUpdateStatement);
                                            }
                                        }
                                    }catch (\Exception $exception){
                                        $output->writeln($exception->getMessage());
                                        $output->writeln($colValue[$key]);
                                    }

                                }
                            }
                        }

                    }
                }
            }

        }

        return Command::SUCCESS;
    }

}