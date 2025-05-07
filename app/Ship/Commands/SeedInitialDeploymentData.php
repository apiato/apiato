<?php

namespace App\Ship\Commands;

use Apiato\Core\Console\Command as ParentCommand;
use App\Ship\Seeders\InitialDeploymentDataSeeder;

final class SeedInitialDeploymentData extends ParentCommand
{
    protected $signature = 'apiato:seed-deploy';
    protected $description = 'Seed data for the initial deployment.';

    public function handle(): void
    {
        $this->call('db:seed', [
            '--class' => InitialDeploymentDataSeeder::class,
        ]);

        $this->info('Deployment Data Seeded Successfully.');
    }
}
