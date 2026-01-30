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
 * @link      https://github.com/MarcinOrlowski/php-discotoolbar-symfony
 *
 * ******************************************************************* */

namespace MarcinOrlowski\DiscoToolbar\Twig;

use MarcinOrlowski\DiscoToolbar\Service\DiscoToolbarService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extension that provides access to DiscoToolbar data
 */
class DiscoToolbarExtension extends AbstractExtension
{
    public function __construct(
        private readonly DiscoToolbarService $discoToolbarService
    ) {
    }

    /**
     * Returns list of functions provided by this extension.
     *
     * @return array<TwigFunction> List of functions
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('disco_toolbar_data', [
                $this,
                'getDiscoToolbarData',
            ]),
        ];
    }

    /**
     * Returns DiscoToolbar data for template rendering
     */
    public function getDiscoToolbarData(): \MarcinOrlowski\DiscoToolbar\Dto\DiscoToolbarData
    {
        return $this->discoToolbarService->getDiscoToolbarData();
    }
}
