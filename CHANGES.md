![img](img/banner.webp)

# Changelog

## 2.1.0 (TBD)

- [#054] Fixed version displayed as `2.0.0.0` instead of `2.0.0` when config file is missing

## 2.0.0 (2026-01-30)

- [#044] Renamed package to `marcin-orlowski/disco-toolbar-symfony`
- [#047] Rebranded from DiscoDevBar to DiscoToolbar
- [#041] Added Symfony 8 support
- [#042] Added project logo!
- [#035] Added customizable background colors for breathing stripes
- [#033] Added close widget type to dismiss toolbar

## 1.5.2 (2025-12-12)

- [#033] Added close widget type to dismiss devbar
- [#027] Devbar template now includes its own CSS for self-contained styling
- [#029] Normalized uses CSS styles in both views

## 1.5.1 (2025-12-12)

- [#024] Breathing effect is now applied only to background layer (stripes), not the whole bar

## 1.5.0 (2025-12-12)

- [#020] DiscoDevBar is now also added to unhandled exception error screens

## 1.4.0 (2025-12-12)

- [#011] Added breathing animation effect to devbar stripes
- [#008] Always include Font Awesome for standalone injection scenarios
- [#010] Added a few GHAs to the project

## 1.3.0 (2025-11-07)

- Added error view mode to display issues (like missing config file) with distinct red/orange styling
- Added optional Font Awesome auto-include from CDN via bundle configuration

## v1.2.0 (2025-11-07)

- Added `icon_type` parameter for widgets: `fa` (Font Awesome, default) or `text` (for emoji/plain text)

## v1.1.0 (2025-11-07)

- Added support for multiple config filenames: `.disco-devbar.yaml`, `.disco-devbar.yml`

## v1.0.0 (2025-11-05)

- Initial public release
