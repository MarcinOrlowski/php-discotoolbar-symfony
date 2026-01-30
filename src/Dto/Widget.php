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

namespace MarcinOrlowski\DiscoToolbar\Dto;

class Widget
{
    public function __construct(
        public readonly string $icon,
        public readonly string $text,
        public readonly string $url,
        public readonly string $target,
        public readonly string $title,
        public readonly bool $expand,
        public readonly IconType $iconType = IconType::FONT_AWESOME,
        public readonly string $type = 'link'
    ) {
    }

    /**
     * Create Widget from array configuration
     *
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $icon = $data['icon'] ?? '';
        $text = $data['text'] ?? '';
        $url = $data['url'] ?? '';
        $target = $data['target'] ?? '';
        $title = $data['title'] ?? '';
        $expand = $data['expand'] ?? false;
        $iconType = $data['icon_type'] ?? 'fa';
        $type = $data['type'] ?? 'link';

        return new self(
            icon:     \is_string($icon) ? $icon : '',
            text:     \is_string($text) ? $text : '',
            url:      \is_string($url) ? $url : '',
            target:   \is_string($target) ? $target : '',
            title:    \is_string($title) ? $title : '',
            expand:   \is_bool($expand) ? $expand : false,
            iconType: IconType::tryFrom(\is_string($iconType) ? $iconType : 'fa') ?? IconType::FONT_AWESOME,
            type:     \is_string($type) ? $type : 'link'
        );
    }
}
