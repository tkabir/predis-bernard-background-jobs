# predis-bernard-background-jobs
A simple PHP job handler using Redis queues and PHP Bernard library

### Installation

1. Run `composer install --prefer-dist`
2. Run `vendor/bin/crunz publish:config` and set preferred timezone for running tasks
3. On terminal-1, run the consumer loop: `php bin\JobConsumer.php`
4. On terminal-2, run process to send message to queues: `php -S localhost:8500 bin\JobHandler.php`
5. [Optional] Setup a cron job running every 1 minute to run the following command, which should run the hourly job: `vendor/bin/crunz schedule:run`