<?php

use Doctrine\DBAL\Types\Types;

$GLOBALS['TL_DCA']['tl_files']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_files']['fields'],[
    'active_file'=>[
    'sql' => "char(1) NOT NULL default '1'"
        ]
]);