#!/usr/bin/env bash
php ../vendor/propel/propel/bin/propel.php reverse --output-dir ../db --config-dir ../
php ../vendor/propel/propel/bin/propel.php build --schema-dir ../db --output-dir ../db --config-dir ../