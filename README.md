# Symfony Website Checklist 📑


__This project lists all the mandatory steps I recommend to build a website using:__
- __HTTPS + HTML output,__
- __A local, PHP-integrated server first, Docker as a "maybe" later on.__
- __Symfony,__
- __Twig,__
- __Doctrine.__

This project assumes you start **from zero**.  

This project README will remain in one file to ease searching from a browser


<table>
  <thead>
    <tr>
      <th>The idea behind this is as follows:</th>
    </tr>
  </thead>
    <tbody>
    <tr>
      <td>The exhaustive version of a HowTo would be the official <a href="https://symfony.com/doc/current/index.html" title="View official documentation">documentation</a>.</td>
  </tr>
  <tr>
    <td>The slightly slower version of this would be to watch tutorials and use cases from <a href="https://symfonycasts.com/" title="Go to the SymfonyCasts website">SymfonyCasts</a>.</td>
  </tr>
  <tr>
    <td>The faster way would be to read <a href="https://symfony.com/doc/current/the-fast-track/en/index.html" title="Read The Fast Track">The Fast Track</a>, precisely written by <a href="https://twitter.com/fabpot" title="Follow Fabien on Twitter!">Fabien Potencier</a>.</td>
  </tr>
  <tr>
    <td>The fastest way to me, trading possibilities for opinions, should be this repository.</td>
  </tr>
  </tbody>
</table>

All contributions and suggestions are welcome. 😇  
  
  
***
  
   
## Set up your environment

1. Set up PHP/latest.  
   On Linux, use your package manager (like Aptitude or Yum). `sudo su && apt-get update && apt-get install php8` at least.  
   On MacOS, use [Brew](https://brew.sh/) through `brew install php`.  
   On Windows, download it from [windows.php.net](https://windows.php.net/download/) (take the **latest version, VS16 x64 Thread Safe, with OpenSSL**) and unzip it to `C:\php[VERSION DIGITS]`, then change your `PATH` system variable (`Windows + R`, type `PATH`, hit `Enter`, click on `Environment Variables`, then your user variables, edit the `PATH` entry and append the previously unzipped directory path to it).
1. Copy `php.ini-development` to `php.ini` in your 
1. Configure your PHP locally for your `dev` environment.
   - Set `memory_limit` to `8M`  
   - Set `max_ececution_time` to `200`
   - Set `upload_max_filesize` to `200M` 
   - Uncomment the `extension_dir` directive. Careful: it's different on Windows vs the rest of the world.
   - Uncomment to enable the following extensions: `bz2, curl, gd, intl, mbstring, mysqli, openssl, pdo_mysql, sodium`.
   - Define the `date.timezone` directive to your local timezone. Mine is `"Europe/Paris"`, for instance. The complete list is [here](https://www.php.net/manual/en/timezones.php).
1. On Windows, download and install [Composer Setup](https://getcomposer.org/Composer-Setup.exe) and [Symfony Setup](https://get.symfony.com/cli/setup.exe).
1. Check that you got everything OK using `symfony check:requirements` in any directory. Ignore the *"Enable or install a PHP accelerator"* advice.
1. Start from an empty directory, use `symfony new [your_project_directory_name]`.

## Set up a new Symfony project 

1. Install PHP-Stan as a dev dependency (`composer require --dev phpstan/phpstan`). 
   - You can do this in a separate directory outside your project as a better practice.
   - Create your configuration file for PHP-Stan if you know what you're doing. If you don't, just use the one in this repository (`phpstan.neon`).
   - Let it at the root of your project for now.
1. Install PHP-CS-Fixer as a dev dependency (`composer require --dev friendsofphp/php-cs-fixer`). 
   - You can do this in a separate directory outside your project as a better practice.
   - Create your configuration file for PHP-CS-Fixer if you know what you're doing. If you don't, just use the one in this repository (`.php-cs-fixer.dist.php`).
   - Let it at the root of your project for now.
1. Install Psalm as a dev dependency (`composer require --dev vimeo/psalm`). 
   - You can do this in a separate directory outside your project as a better practice.
   - Create your configuration file for Psalm if you know what you're doing. If you don't, just use the one in this repository (`psalm.xml`).
   - Let it at the root of your project for now.
1. Create a shell command to start them, at the root of your directory (you can safely copy the ones in this repository).
   - Give them short names so you don't lose time calling them manually.
   - Don't start their names with "php", they all share this and slows down your CLI calls. Call them `csfixer`, `stan` and `psalm`, with appropriate shell extensions (`.bat` or `.sh`).

## Produce your models

1. List all your entities, think about them until you can't find new fields/properties to add.
1. Add Doctrine DBAL + ORM (`composer require orm`).
1. If you want to use migrations, add Doctrine Migrations (`composer require migrations`). 
   - If you have no idea what to do and work alone on your project, don't use them (`composer remove doctrine/migrations`, same for dependencies).
   - If you end up using them, create a `/migrations` directory at the root directory of your project.
1. Install the MakerBundle (`composer require --dev maker`).
1. Use the MakerBundle to generate their CRUDL. For each entity, run `php bin/console make:crud`.
1. Create a `Model` directory under `/src` to store all models that are not entities.


## Set up translations (even if you only use one language)

1. Install the Translation component: `composer require symfony/translation`.
1. Set up your default language in `config/packages/translation.yaml`.
   Mine looks like this (for non-geographic English as the default language):
```yaml
framework:
    default_locale: en
    translator:
        default_path: '%kernel.project_dir%/translations'
        fallbacks:
            - en
```
1. Set up your languages logic in `config/services.yaml`.
   Mine looks like this:
```yaml
parameters:
    # ...
    app.supported_locales:
        - en
        - fr
```
1. Create a `messages.[yourdefaultlanguage].yaml` in the `translations` folder.
1. Create a `validators.[yourdefaultlanguage].yaml` in the `translations` folder.
1. Repeat last two steps for each additional language you'll need.


## Set up your basic application logic

1. Identify your application domains. If you have no idea what this means, or which to use, simply go with `Admin` and `Front`, plus one for each of your application "modules".
1. Create a subdirectory for each of these domains, at least for `Admin` and `Front` (that's already enough):
   - In `src/Controller`.
   - In `src/Form`.
   - In `src/Model`.
1. Do the same in the Twig `/templates` diretory: create `/admin` and `/front` subdirectories in it.
1. Move your CRUDL controllers to `src/Controller/Admin`, and their templates to `templates/admin`. 
1. Update the namespaces, templates namereferences in the controllers and templates according to last point.


## Set up your Twig templates

1. Install Twig and the extensions you're going to use.
   - `composer require twig`
1. 

## Dockerize your project

- 


***

*Image taken from free image stock [UnSplash / Guillaume Jaillet](https://unsplash.com/photos/Nl-GCtizDHg).*
