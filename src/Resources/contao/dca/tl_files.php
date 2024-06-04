<?php

use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_files']['fields']['active_file'] = [
    'sql' => ['type' => Types::BOOLEAN, 'default' => false],
];