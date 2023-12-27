<?php

namespace App\Ship\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Commands\ConsoleCommand;

class DiscoverPackageCommand extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiato:package:discover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Discover packages';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->components->info('Discovering vendor packages');
        $manifestPackages = $this->laravel->getCachedPackagesPath();
        //    //base_path() . '/bootstrap/cache/packages.php';
        //    $modulesPath = base_path() . DIRECTORY_SEPARATOR . 'modules';
        //    $discoverPackages = array();
        //    $currentDir = opendir($modulesPath);
        //    while (($filename = readdir($currentDir)) !== false) {
        //        $subDir = $modulesPath . DIRECTORY_SEPARATOR . $filename;
        //        if ($filename == '.' || $filename == '..') {
        //            continue;
        //        } else if (is_dir($subDir)) {
        //            $composerFile = $subDir . DIRECTORY_SEPARATOR . 'composer.json';
        //            $composer = json_decode(file_get_contents($composerFile), true);
        //            if (isset($composer['extra']['laravel'])) {
        //                $this->line("<info>Custom Discovered Package:</info> {$composer['name']}");
        //                $discoverPackages[$composer['name']] = $composer['extra']['laravel'];
        //            }
        //        }
        //    }
        //
        //    $manifest = include "{$manifestPackages}";
        //    $manifest = array_merge($manifest, $discoverPackages);
        //    file_put_contents($manifestPackages, '<?php return ' . var_export($manifest, true) . ';');

        $discoverPackages = [];
        foreach (Apiato::getAllContainerPaths() as $containerPath) {
            $composerFile = $containerPath . DIRECTORY_SEPARATOR . 'composer.json';
            $composer = json_decode(file_get_contents($composerFile), true);
            if (isset($composer['extra']['laravel'])) {
                $this->line("<info>Custom Discovered Package:</info> {$composer['name']}");
                $discoverPackages[$composer['name']] = $composer['extra']['laravel'];
            }
        }
        //    dump($discoverPackages);
        //    dump($manifestPackages);
        $manifest = include "{$manifestPackages}";
        //    dump($manifest);
        $manifest = array_merge($manifest, $discoverPackages);
        collect($manifest)
            ->keys()
            ->each(fn ($description) => $this->components->task($description))
            ->whenNotEmpty(fn () => $this->newLine());
        //    dump($manifest);
        file_put_contents($manifestPackages, '<?php return ' . var_export($manifest, true) . ';');
        //    dump($manifestPackages);
    }
}
