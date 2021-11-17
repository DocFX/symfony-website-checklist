[![](readme-sources/symfony-website-checklist.jpg)]()

# Symfony Website Checklist 📑

## Summary
- [Elevator pitch](#elevator-pitch) 


### Elevator pitch

>__This project lists all the mandatory steps I recommend to build a website using:__
>
>- __HTTPS + HTML output,__
>- __A local, PHP-integrated server first, Docker as a "maybe" later on,__
>- __Symfony,__
>- __Twig,__
>- __Doctrine.__

This project assumes you start **from zero**.

This project README will remain in *one* file to ease searching from a browser.

All the files referenced in this document can be found in the `/files-you-will-need` directory of this repository.

### Philosophy

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

## 1. Set up your environment

1. Set up PHP/latest.  
   On Linux, use your package manager (like Aptitude or Yum). `sudo su && apt-get update && apt-get install php8` at
   least.  
   On MacOS, use [Brew](https://brew.sh/) through `brew install php`.  
   On Windows:
    - Download it from [windows.php.net](https://windows.php.net/download/) (take the **latest version, VS16 x64 Thread
      Safe, with OpenSSL**)
    - Unzip it to `C:\php[VERSION DIGITS]`.
    - Then change your `PATH` system variable (`Windows + R`, type `PATH`, hit `Enter`, click on `Environment Variables`
      , then your user variables, edit the `PATH` entry and append the previously unzipped directory path to it).
2. Copy `php.ini-development` to `php.ini` in your
3. Configure your PHP locally for your `dev` environment.
    - Set `memory_limit` to `8M`
    - Set `max_ececution_time` to `200`
    - Set `upload_max_filesize` to `200M`
    - Uncomment the `extension_dir` directive. Careful: it's different on Windows vs the rest of the world.
    - Uncomment to enable the following extensions: `bz2, curl, gd, intl, mbstring, mysqli, openssl, pdo_mysql, sodium`.
    - Define the `date.timezone` directive to your local timezone.
        - Mine is `"Europe/Paris"`, for instance.
        - The complete list is [here](https://www.php.net/manual/en/timezones.php).
4. On Windows, download and install [Composer Setup](https://getcomposer.org/Composer-Setup.exe)
   and [Symfony Setup](https://get.symfony.com/cli/setup.exe).
5. Check that you got everything OK using `symfony check:requirements` in any directory. Ignore the *"Enable or install
   a PHP accelerator"* advice.
6. Start from an empty directory, use `symfony new [your_project_directory_name]`.
7. Create a `README.md` file inside the root directory and put everything you can document inside, at least those sections:
   - The **title** of the project.
   - The **purpose** of the project.
   - How to **set it up**.
   - How to **run** basic commands it requires to work (including Docker).
   - **Contribution** / modification instructions.
   - Architectures / coding / technology **choices**.
8. Add a `readme-sources` directory at the root of your project. Anything that is included in MarkDown documentation goes there.

## 2. Set up a new Symfony project

1. Install PHP-Stan as a dev dependency (`composer require --dev phpstan/phpstan`).
    - You can do this in a separate directory outside your project as a better practice.
    - Create your configuration file for PHP-Stan if you know what you're doing. If you don't, just use the one in this
      repository (`phpstan.neon`).
    - Let it at the root of your project for now.
    - Also install additional Symfony and Doctrine plugins:
        - `composer require --dev phpstan/extension-installer`,
        - `composer require --dev phpstan/phpstan-symfony`,
        - `composer require --dev phpstan/phpstan-doctrine`.
    - Make sure PHP-Stan also checks the `config` directory, and goes to the maximum level. Mine looks like this:

```yaml
parameters:
    level: 9
    paths:
        - config
        - src
        - tests
    checkGenericClassInNonGenericObjectType: false
    ignoreErrors:
        - '#Property .* is never written, only read\.#'
    symfony:
        container_xml_path: var/cache/dev/App_KernelDevDebugContainer.xml
```

2. Install PHP-CS-Fixer as a dev dependency (`composer require --dev friendsofphp/php-cs-fixer`).
    - You can do this in a separate directory outside your project as a better practice.
    - Create your configuration file for PHP-CS-Fixer if you know what you're doing. If you don't, just use the one in
      this repository (`.php-cs-fixer.dist.php`).
    - Let it at the root of your project for now.
3. Install Psalm as a dev dependency (`composer require --dev vimeo/psalm`).
    - You can do this in a separate directory outside your project as a better practice.
    - Create your configuration file for Psalm if you know what you're doing (`php vendor/bin/psalm --init`). If you
      don't, just use the one in this repository (`psalm.xml`).
    - Let it at the root of your project for now.
    - Also install additional Symfony and Doctrine plugins: `composer require --dev psalm/plugin-symfony`
      and `composer require --dev weirdan/doctrine-psalm-plugin`.
4. Create a shell command to start them, at the root of your directory (you can safely copy the ones in this repository).
    - Give them short names so you don't lose time calling them manually.
    - Don't start their names with "`php`", they all share this and slows down your CLI calls.
    - Call them `csfixer`, `stan` and `psalm`, with appropriate shell extensions (`.bat` or `.sh`).
5. Add a `.editorconfig` file at the root directory of your project to ensure your IDE settings don't get messed up.
    - At least set it up so you use UTF-8, `LF` characters for newlines and 4 spaces as tabulations.
    - If you don't, just use the one in this repository (`.editorconfig`).

## 3. Set up your Twig templates

1. Install Twig and the extensions you're going to use.
    - `composer require twig`
    - `composer require twig/extra-bundle`
2. 

## 4. Produce your models

1. List all your entities, think about them until you can't find new fields/properties to add.
2. Add Doctrine DBAL + ORM (`composer require orm`).
3. If you want to use migrations, add Doctrine Migrations (`composer require migrations`).
    - If you have no idea what to do and work alone on your project, don't use
      them (`composer remove doctrine/migrations`, same for dependencies).
    - If you end up using them, create a `/migrations` directory at the root directory of your project.
4. Install the MakerBundle (`composer require --dev maker`).
5. Use the MakerBundle to generate their CRUDL. For each entity, run `php bin/console make:crud`.
6. Create a `Model` directory under `/src` to store all models that are not entities.

## 5. Set up translations (even if you only use one language)

1. Install the Translation component: `composer require symfony/translation`.
2. Set up your default language in `config/packages/translation.yaml`. Mine looks like this (for non-geographic English
   as the default language):

```yaml
framework:
    # ...
    default_locale: en
    translator:
        default_path: '%kernel.project_dir%/translations'
        fallbacks:
            - en
    # ...
```

3. Set up your languages logic in `config/services.yaml`. Mine looks like this:

```yaml
parameters:
    # ...
    app.supported_locales:
        - en
        - fr
    # ...
```

4. Create a `messages.[yourdefaultlanguage].yaml` in the `translations` folder. Don't use ICU unless you know why.
5. Create a `validators.[yourdefaultlanguage].yaml` in the `translations` folder. Don't use ICU unless you know why.
6. Repeat last two steps for each additional language you'll need.

## 6. Set up your basic application logic

1. Identify your application domains. If you have no idea what this means, or which to use, simply go with `Admin`
   and `Front`, plus one for each of your application "modules".
2. Create a subdirectory for each of these domains, at least for `Admin` and `Front` (that's already enough):
    - In `src/Controller`.
    - In `src/Form`.
    - In `src/Model`.
3. Do the same in the Twig `/templates` directory: create `/admin` and `/front` subdirectories in it.
4. Move your CRUDL controllers to `src/Controller/Admin`, and their templates to `templates/admin`.
5. Update the namespaces, templates name references in the controllers and templates according to last point.
6. Inside each `messages.[language].yaml` translations file, start root keys with your domains, all snake case. At least
   they should look like this:

```yaml
front:

admin:
```

7. Add constraint validation to the **maximum** properties you can set to in your entity files. 
   - Run `composer require symfony/validator doctrine/annotations`.
   - This supposes, at least:
      - That ALL your fields have a `@Assert`
8. Make sure all your entities are historizable, which means they should have creation and last modification dates attached:
   - To achieve that, use a PHP trait in all your entities.
   - If you have no idea what this means, simply use the file `HistoryTrackableEntity.php` in this repository.
   - Put the trait in your `src/Entities` directory.
   - Add an `@ORM\HasLifecycleCallbacks` annotation to all your entities.
   - Add `use HistoryTrackableEntity;` after each Entity class opening bracket (first line, before constants and properties).
   - Update the database (`php bin/console doctrine:schema:update` or use migrations if you chose to use them).

## 7. Secure your app

1. Define your roles in


## 8. Use TailwindCSS for styles and RWI

1. Update `config/twig.yaml` and set this:
```yaml
twig:
    # ...
    form_themes: ['tailwind_2_layout.html.twig']
    # ...
```
2. Add Webpack Encore, with PurgeCSS and PostCSS:
   - Install Node (pick the latest LTS version):
     - On Windows and MacOS, just use the [installer](https://nodejs.org/en/download/) and restart your shell.
     - On Linux, use your package manager (like Aptitude or Yum). `sudo su && apt-get update && apt-get install nodejs npm` at
       least.
   - Run `composer require encore` and `npm install`.
   - Run `npm install -D tailwindcss postcss-loader purgecss-webpack-plugin glob-all path autoprefixer`.
   - Setup Webpack, PostCSS and Tailwind.
     - If you don't know what this means, simply copy the following files from this repository to your project root directory:
       - ``
   - Run `npm run build`.

## 9. Pre-flight checks

1. Run `symfony check:security` to validate that your project has no known vulnerabilities from its dependencies.
2. Create a deployment script for your non-dev environments.
    - If you don't know what you're doing, use the one I provided (`production-deployment.sh.dist`) for a start.
    - On your non-dev environments, copy the `production-deployment.sh.dist` to `[environment]-deployment.sh`.
    - Check that they're in the `.gitignore` and only on destination servers filesystems. Don't version the final ones.
3. Make sure your application only uses HTTPS. Your `config/services.yaml` should contain this:

```yaml
parameters:
    # ...
    router.request_context.scheme: 'https'
    asset.request_context.secure: true
    router:
        request_context:
        scheme: 'https'
    asset:
        request_context:
            secure: true
    # ...
```

## 10. Dockerize your project

-

***

*Image taken from free image stock [UnSplash / Guillaume Jaillet](https://unsplash.com/photos/Nl-GCtizDHg).*
