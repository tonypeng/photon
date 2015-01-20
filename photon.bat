@echo off

if "%1" == "build" goto build
if "%1" == "compile" goto compile

echo No command received.  Enter `photon help` for a list of commands.  Good bye!

goto end

:build
php scripts/build.php
goto end

:compile
if "%2" == "" (
    echo No file to compile.  `photon compile` requires a file argument.
    goto end
)

php scripts/compile.php %2
goto end

:end