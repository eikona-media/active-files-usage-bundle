<?php

namespace EikonaMedia\Contao\ActiveFilesUsageBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use EikonaMedia\Contao\ActiveFilesUsageBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoActiveFilesUsageBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
