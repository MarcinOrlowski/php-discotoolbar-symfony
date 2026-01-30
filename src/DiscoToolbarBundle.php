<?php

declare(strict_types=1);

/* **********************************************************************
 * 
 *     █▀▀▄  ▀                     ▀▀█▀▀           ▀█  █
 *     █  █ ▀█  ▄▀▀▄ ▄▀▀▄ ▄▀▀▄       █   ▄▀▀▄ ▄▀▀▄  █  █▀▀▄ ▄▀▀▄ █▄▀
 *     █  █  █   ▀▄  █    █  █       █   █  █ █  █  █  █  █  ▄▄█ █
 *     █▄▄▀ ▄█▄ ▀▄▄▀ ▀▄▄▀ ▀▄▄▀       █   ▀▄▄▀ ▀▄▄▀ ▄█▄ █▄▄▀ ▀▄▄▀ █
 *
 * *******  Customizable developer toolbar for Symfony projects  ********
 *
 * @author    Marcin Orlowski <mail (#) marcinOrlowski (.) com>
 * @copyright 2025-2026 Marcin Orlowski
 * @license   https://opensource.org/license/mit MIT
 * @link      https://github.com/MarcinOrlowski/php-discobar-symfony
 *
 * ******************************************************************* */

namespace MarcinOrlowski\DiscoToolbar;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * DiscoToolbar Bundle
 *
 * Provides customizable toolbar for Symfony projects
 */
class DiscoToolbarBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
