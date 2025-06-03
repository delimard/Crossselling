<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace CrossSelling;

use Thelia\Module\BaseModule;
use Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator;

class CrossSelling extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'crossselling';

    /**
     * @param ServicesConfigurator $servicesConfigurator
     * @return void
     */
    public static function configureServices(ServicesConfigurator $servicesConfigurator): void
    {
        $servicesConfigurator->load(self::getModuleCode().'\\', __DIR__)
            ->exclude([THELIA_MODULE_DIR . ucfirst(self::getModuleCode()). "/I18n/*"])
            ->autowire(true)
            ->autoconfigure(true);
    }

  
}
