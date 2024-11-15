# Silverstripe Tracking Scripts

A module to easy manage your site's tracking scripts from your admin settings.
Options currently include Google Analytics 4 (GA4), Google Tag Manager and Meta Pixel.


## Requirements

- Silverstripe ^4.0 || ^5.0

The module will also install `symbiote/silverstripe-gridfieldextensions` if you do not already have it.


## Installation

```shell
composer require springtimesoft/silverstripe-tracking-scripts
```
You will need to run `dev/build` after installation.


## Adding the code to your `Page.ss`

Just after the opening `<body>` tag in your `Page.ss` template, add `$TrackingScripts`.
The module will automatically inject JavaScript into your HTML head.


## Configuration

In your site settings, add your tracking IDs within the `Tracking Scripts` tab.
