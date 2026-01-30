<?php

declare(strict_types=1);

/* #############################################################################
 *
 *   █▀▀▄  ▀                     █▀▀▄           █▀▀▄
 *   █  █ ▀█  ▄▀▀▄ ▄▀▀▄ ▄▀▀▄     █  █ ▄▀▀▄ █  █ █▀▀▄ ▄▀▀▄ █▄▀
 *   █  █  █   ▀▄  █    █  █     █  █ █▀▀  █  █ █  █  ▄▄█ █
 *   █▄▄▀ ▄█▄ ▀▄▄▀ ▀▄▄▀ ▀▄▄▀     █▄▄▀ ▀▄▄▀ ▀▄▀  █▄▄▀ ▀▄▄▀ █
 *
 *     Customizable developer toolbar for Symfony projects
 *
 * @author    Marcin Orlowski <mail (#) marcinOrlowski (.) com>
 * @copyright 2025 Marcin Orlowski
 * @license   https://opensource.org/license/mit MIT
 * @link      https://github.com/MarcinOrlowski/php-discotoolbar-symfony
 *
 * ########################################################################## */

namespace MarcinOrlowski\DiscoToolbar\Dto;

class DiscoToolbarData
{
    /**
     * @param array<Widget> $left
     * @param array<Widget> $right
     * @param bool          $leftExpand          Whether left container should expand
     * @param bool          $rightExpand         Whether right container should expand
     * @param bool          $hasError            Whether to show error/alternative view
     * @param string        $errorMessage        Error message to display (when hasError is true)
     * @param string|null   $version             Bundle version (null shows as N/A)
     * @param bool          $fontAwesomeEnabled  Whether to auto-include Font Awesome
     * @param string        $fontAwesomeVersion  Font Awesome version to use
     * @param string        $bgColorLight        Light stripe color for background gradient
     * @param string        $bgColorDark         Dark stripe color for background gradient
     */
    public function __construct(
        public readonly array $left,
        public readonly array $right,
        public readonly bool $leftExpand,
        public readonly bool $rightExpand,
        public readonly bool $hasError = false,
        public readonly string $errorMessage = '',
        public readonly ?string $version = null,
        public readonly bool $fontAwesomeEnabled = false,
        public readonly string $fontAwesomeVersion = '6.5.1',
        public readonly string $bgColorLight = '#b71c1c',
        public readonly string $bgColorDark = '#8e0000'
    ) {
    }
}
