<?php

namespace EikonaMedia\Contao\ActiveFilesUsageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EikonaMediaContaoActiveFilesUsageBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}



