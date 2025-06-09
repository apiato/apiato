<?php

declare(strict_types=1);

namespace App\Ship\Commands;

use Apiato\Core\Console\Command as ParentCommand;
use App\Ship\Seeders\TestingDataSeeder;

final class SeedTestingData extends ParentCommand
{
    /** @var string */
    protected $signature = 'apiato:seed-test';

    /** @var string */
    protected $description = 'Seed testing data.';

    public function handle(): void
    {
        $this->call('db:seed', [
            '--class' => TestingDataSeeder::class,
        ]);

        $this->info('Testing Data Seeded Successfully.');
    }
}
