@echo off

if "%1" == "build" goto build

echo No command received.  Enter `photon help` for a list of commands.  Good bye!

goto end

:build
php scripts/build.php
goto end

:end