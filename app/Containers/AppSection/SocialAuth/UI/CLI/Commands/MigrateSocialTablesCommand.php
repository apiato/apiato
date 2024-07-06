<?php

namespace App\Containers\AppSection\SocialAuth\UI\CLI\Commands;

use App\Containers\AppSection\MemberFacebook\Models\MemberFacebook;
use App\Containers\AppSection\MemberGoogle\Models\MemberGoogle;
use App\Ship\Parents\Commands\ConsoleCommand;
use DB;

class MigrateSocialTablesCommand extends ConsoleCommand
{
    protected $signature = 'praisecharts:migrate_social_tables {--batch-size=1000}';
    protected $description = 'Migrate Facebook and Google social tables and merge them into one.';

    public function handle(): void
    {
        $this->info('Migrating Facebook and Google social tables and merging them into one...');

        $batchSize = $this->option('batch-size');

        // Migrate Facebook records
        $this->migrateSocialTable(
            MemberFacebook::class,
            function ($member) {
                return [
                    'user_id' => $member->MemberID,
                    'provider' => 'facebook',
                    'social_id' => $member->FacebookID,
                    'email' => $member->Email,
                    'name' => $member->FirstName . ' ' . $member->LastName,
                    'created_at' => $member->Date,
                    'updated_at' => $member->Date,
                ];
            },
            'facebook',
            $batchSize
        );

        // Migrate Google records
        $this->migrateSocialTable(
            MemberGoogle::class,
            function ($member) {
                return [
                    'user_id' => $member->MemberID,
                    'provider' => 'google',
                    'social_id' => $member->GoogleID,
                    'created_at' => $member->created_at,
                    'updated_at' => $member->updated_at,
                ];
            },
            'google',
            $batchSize
        );

        $this->info('Migrated Facebook and Google social tables and merged them into one.');
    }

    private function migrateSocialTable($model, $dataCallback, $provider, $batchSize)
    {
        // Fetch existing social IDs from oauth_identities table for the given provider
        $existingSocialIds = DB::table('oauth_identities')
                                ->where('provider', $provider)
                                ->pluck('social_id');

        // Adjust the query to use whereNotIn with the fetched IDs
        $query = $model::whereNotIn("{$provider}ID", $existingSocialIds);

        $count = $query->count();
        $this->output->progressStart($count);

        $query->chunk($batchSize, function ($users) use ($dataCallback) {
            $insertData = $users->map($dataCallback)->toArray();

            // Start building the raw SQL query for batch insert
            // Ensure you're handling data safely to avoid SQL injection
            $values = implode(',', array_map(function ($item) {
                return '(' . implode(',', array_map(function ($value) {
                    return DB::connection()->getPdo()->quote($value);
                }, array_values($item))) . ')';
            }, $insertData));

            $columns = implode(',', array_map(function ($column) {
                return "`$column`";
            }, array_keys($insertData[0])));

            $onDuplicateKeySQL = implode(',', array_map(function ($column) {
                return "`$column` = VALUES(`$column`)";
            }, array_keys($insertData[0])));

            $sql = "INSERT INTO `oauth_identities` ($columns) VALUES $values ON DUPLICATE KEY UPDATE $onDuplicateKeySQL;";

            DB::statement($sql);

            $this->output->progressAdvance(count($insertData));
        });

        $this->output->progressFinish();
    }
}
