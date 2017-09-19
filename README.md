# Spruce Lee plugin for Craft CMS

Scan and purge unused assets

![Screenshot](resources/screenshots/plugin_logo.png)

## Installation

To install Spruce Lee, follow these steps:

1. Download & unzip the file and place the `sprucelee` directory into your `craft/plugins` directory
2.  -OR- do a `git clone ???` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require /sprucelee`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `sprucelee` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

Spruce Lee works on Craft 2.4.x and Craft 2.5.x.

## Spruce Lee Overview

Spruce Lee is a plugin for clearing out unused assets from a Craft build.
It does this by looping through assets that do not have relationships and storing a record of these.
It then `destroy`s identified records through the Craft Asset API.

## Using Spruce Lee

-Insert text here-

## Spruce Lee Roadmap

- clean out empty folders
- clean out empty/unusued asset sources

* Release it

Brought to you by [@cole007](http://ournameismud.co.uk/)
Project icon from [Hamish](https://thenounproject.com/search/?q=bruce%20lee&i=636958)
