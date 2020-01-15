<?php

namespace Apiato\Core\Abstracts\Commands;

use Illuminate\Console\Command as LaravelCommand;

/**
 * Class ConsoleCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class ConsoleCommand extends LaravelCommand
{
    /**
     * The type of this controller. This will be accessible mirrored in the Actions.
     * Giving each Action the ability to modify it's internal business logic based on the UI type that called it.
     *
     * @var  string
     */
    public $ui = 'cli';

}
