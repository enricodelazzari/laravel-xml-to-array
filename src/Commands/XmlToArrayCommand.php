<?php

namespace EnricoDeLazzari\XmlToArray\Commands;

use Illuminate\Console\Command;

class XmlToArrayCommand extends Command
{
    public $signature = 'laravel-xml-to-array';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
