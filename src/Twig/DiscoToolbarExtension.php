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
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFunction;

/**
 * Twig extension that provides access to DiscoToolbar data
 */
class DiscoToolbarExtension extends AbstractExtension
{
    public function __construct(
        private readonly DiscoToolbarService $discoToolbarService,
        private readonly Environment $twig
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
            new TwigFunction('disco_ux_icon', [
                $this,
                'renderUxIcon',
            ], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Returns DiscoToolbar data for template rendering
     */
    public function getDiscoToolbarData(): \MarcinOrlowski\DiscoToolbar\Dto\DiscoToolbarData
    {
        return $this->discoToolbarService->getDiscoToolbarData();
    }

    /**
     * Renders a UX Icon if symfony/ux-icons is installed, otherwise returns fallback
     */
    public function renderUxIcon(string $icon): Markup|string
    {
        try {
            if ($this->twig->getFunction('ux_icon') !== null) {
                $template = $this->twig->createTemplate('{{ ux_icon(icon) }}');
                return new Markup($template->render(['icon' => $icon]), 'UTF-8');
            }
        } catch (\Exception) {
            // ux_icon function not available
        }

        return \sprintf('[%s]', \htmlspecialchars($icon, \ENT_QUOTES, 'UTF-8'));
    }
}
