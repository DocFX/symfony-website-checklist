#!/bin/bash
cd your_repo_directory/public
php -S localhost:8000 -t .
npm run watch
