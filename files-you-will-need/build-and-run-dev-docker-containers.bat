:: ##########################################################################################
:: # Symfony Website Checklist - Windows - Docker-compose - Start DEV containers            #
:: ##########################################################################################

:: Shut down Windows current command echoing
@ECHO OFF

:: Change the title of the window, for pimpin' reasons :)
:: JK: this helps finding it among all open windows
TITLE Symfony Website Checklist Containers - Rebuild the DEV container set.

:: Ask for confirmation first, for this takes a long time and can be called by mistake
ECHO ---------------------------------------------------
ECHO - Symfony Website Checklist Containers                      -
ECHO - (you need to have Docker installed to proceed)  -
ECHO ---------------------------------------------------

:: If command line argument is "-y", then just go on, don't ask.
IF /I "%~1"=="-y" (GOTO :start)

:: If command line argument is --help, then just go on, don't ask.
IF /I "%~1"=="--help" (GOTO :explain) ELSE (GOTO :ask)
:explain
ECHO.
ECHO Usage: build-and-run-dev-docker-containers.bat [OPTION]
ECHO Builds and runs DEV containers for this project.
ECHO.
ECHO -y                 force without confirmation
ECHO --help             display this help screen
GOTO :end

:: Ask people if they really want to proceed
:ask
ECHO.
SET /P confirm="Are you SURE you want to rebuild and run DEV containers? (Y/y/N/n) "
ECHO.

:: Use that variable prompted from user to go further or not
:: Note that Windows shell scripts don't really like multiple commands and nesting
:: So we just use ugly loops for now. :(
IF /I "%confirm%"=="y" (GOTO :start) ELSE (GOTO :bypass)

:: Start the production containers
:start

:: Start the dev containers
ECHO.
ECHO ---------------------------------------------------
ECHO (Re)generating / (re)starting DEV (dev) containers
ECHO Tagging them with dev prefix, forced recreation.
ECHO ---------------------------------------------------
docker-compose -f docker-sources/global-docker-compose.yml -f docker-sources/dev-docker-compose.yml -p dev up -d --force-recreate --build
ECHO ---------------------------------------------------

:: Confirm what has been done
ECHO.
ECHO -----------------------------------------------------
ECHO DEV Project Template containers successfully started.
ECHO -----------------------------------------------------

:: Echo current containers
ECHO.
ECHO ---------------------------------------------------
ECHO Those are your currently active containers.
docker ps -a

:: Echo current networks
ECHO.
ECHO Those are your currently active networks.
docker network ls
ECHO ---------------------------------------------------
ECHO.

:: Just stop here and go to the end!
GOTO end

:: If the user answered "n"
:bypass
ECHO OK, then. See you around! :)
ECHO ---------------------------------------------------

:: The end!
:end
