<?php

namespace App\Ship\Commands;

use App\Ship\Parents\Commands\ConsoleCommand;
use Illuminate\Filesystem\Filesystem;

/**
 * Class NamespaceRenaming
 *
 * @author  Nasrul Hazim  <nasrulhazim.m@gmail.com>
 */
class NamespaceRenaming extends ConsoleCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'apiato:name {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set apiato namespace';

    /**
     * @var  \Illuminate\Filesystem\Filesystem
     */
    private $files;

    /**
     * Current root application namespace.
     *
     * @var string
     */
    protected $currentRoot;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $this->currentRoot = trim($this->laravel->getNamespace(), '\\');
        $this->info('Change namespace from ' . $this->currentRoot . ' to ' . $this->argument('name'));
        $this->setApiatoNamespaces();
    }

    /**
     * Set the Apiato namespaces.
     *
     * @return void
     */
    protected function setApiatoNamespaces()
    {
        $this->call('app:name', [
            'name' => $this->argument('name'),
        ]);
        $this->setBootstrapNamespaces();
        $this->setAppConfigNamespaces();
    }

    /**
     * Set the bootstrap namespaces.
     *
     * @return void
     */
    protected function setBootstrapNamespaces()
    {
        $search = [
            $this->currentRoot . '\\Ship\\Engine\\Kernels',
            $this->currentRoot . '\\Ship\\Engine\\Exceptions',
        ];

        $replace = [
            $this->argument('name') . '\\Ship\\Engine\\Kernels',
            $this->argument('name') . '\\Ship\\Engine\\Exceptions',
        ];

        $this->replaceIn($this->getBootstrapPath(), $search, $replace);
    }

    /**
     * Set the application provider namespaces.
     *
     * @return void
     */
    protected function setAppConfigNamespaces()
    {
        $search = [
            $this->currentRoot . '\\Ship\\Engine\\Providers',
        ];

        $replace = [
            $this->argument('name') . '\\Ship\\Engine\\Providers',
        ];

        $this->replaceIn($this->getConfigPath('app'), $search, $replace);
    }

    /**
     * Get the path to the bootstrap/app.php file.
     *
     * @return string
     */
    protected function getBootstrapPath()
    {
        return $this->laravel->bootstrapPath() . '/app.php';
    }

    /**
     * Get the path to the given configuration file.
     *
     * @param  string  $name
     * @return string
     */
    protected function getConfigPath($name)
    {
        return $this->laravel['path.config'] . '/' . $name . '.php';
    }

    /**
     * Replace the given string in the given file.
     *
     * @param  string  $path
     * @param  string|array  $search
     * @param  string|array  $replace
     * @return void
     */
    protected function replaceIn($path, $search, $replace)
    {
        if ($this->files->exists($path)) {
            $this->files->put($path, str_replace($search, $replace, $this->files->get($path)));
        }
    }
}
