#!/usr/bin/env bash
vendor/bin/phpunit --testdox && npm run test && vendor/bin/phpcs --standard=PSR2 app/
