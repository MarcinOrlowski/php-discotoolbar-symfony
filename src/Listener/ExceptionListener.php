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

namespace MarcinOrlowski\DiscoToolbar\Listener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

/**
 * Injects DiscoToolbar into Symfony's exception debug pages in dev environment.
 *
 * The exception debug pages are standalone HTML pages that don't use Twig templates,
 * so we need to inject the toolbar via response modification.
 */
#[AsEventListener(event: KernelEvents::RESPONSE, priority: -100)]
class ExceptionListener
{
    public function __construct(
        private readonly Environment $twig,
        private readonly KernelInterface $kernel,
    ) {
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        // Only inject in dev environment
        if ($this->kernel->getEnvironment() !== 'dev') {
            return;
        }

        // Only process main requests
        if (!$event->isMainRequest()) {
            return;
        }

        $response = $event->getResponse();
        $content = $response->getContent();

        // Only process HTML responses
        if ($content === false || !str_contains($response->headers->get('Content-Type', ''), 'text/html')) {
            return;
        }

        // Check if this is Symfony's exception debug page
        // The exception page contains "Symfony Exception" and the specific CSS class "exception-message-wrapper"
        if (!str_contains($content, 'Symfony Exception') || !str_contains($content, 'exception-message-wrapper')) {
            return;
        }

        // Don't inject if toolbar is already present (shouldn't happen, but be safe)
        if (str_contains($content, 'disco-toolbar')) {
            return;
        }

        try {
            $toolbarHtml = $this->twig->render('@DiscoToolbar/toolbar.html.twig');
        } catch (\Throwable) {
            // If rendering fails, don't break the exception page
            return;
        }

        // Extract <link> tags and inject them into <head>
        preg_match_all('/<link[^>]*>/i', $toolbarHtml, $linkMatches);
        $links = implode("\n", $linkMatches[0]);
        $toolbarDiv = preg_replace('/<link[^>]*>\s*/i', '', $toolbarHtml);

        // Inject links and extra styling into <head>
        $extraStyle = '<style>.sf-error-header { margin-top: 40px; }</style>';
        $content = str_replace('</head>', $links . $extraStyle . '</head>', $content);

        // Inject toolbar div after <body> tag
        $content = preg_replace(
            '/(<body[^>]*>)/i',
            '$1' . $toolbarDiv,
            $content,
            1
        );

        if ($content === null) {
            return;
        }

        $response->setContent($content);
    }
}
