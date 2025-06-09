<?php

declare(strict_types=1);

namespace App\Ship\Commands;

use Apiato\Core\Console\Command as ParentCommand;
use App\Ship\Seeders\InitialDeploymentDataSeeder;

final class SeedInitialDeploymentData extends ParentCommand
{
    /** @var string */
    protected $signature = 'apiato:seed-deploy {--force : Force the operation to run when in production}';

    /** @var string */
    protected $description = 'Seed data for the initial deployment.';

    public function handle(): void
    {
        $this->call('db:seed', [
            '--class' => InitialDeploymentDataSeeder::class,
            '--force' => $this->option('force'),
        ]);

        $this->info('Deployment Data Seeded Successfully.');
    }
}
