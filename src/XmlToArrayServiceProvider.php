<?php

namespace EnricoDeLazzari\XmlToArray;

use EnricoDeLazzari\XmlToArray\Commands\XmlToArrayCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class XmlToArrayServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-xml-to-array')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_xml_to_array_table')
            ->hasCommand(XmlToArrayCommand::class);
    }
}
