<?php

namespace Amrghamrawy\MacroSearch\Commands;

use Illuminate\Console\Command;

class MacroSearchCommand extends Command
{
    public $signature = 'macro-search';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
