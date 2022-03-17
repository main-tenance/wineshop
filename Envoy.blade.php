@setup
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$deployPath = env('DEPLOY_PATH');
$deployRepo = env('DEPLOY_REPO');
$deployBranch = env('DEPLOY_BRANCH');
$deployServer = env('DEPLOY_SERVER');
$slackUrl = env('LOG_SLACK_WEBHOOK_URL');
$slackChannel = env('SLACK_CHANNEL');
@endsetup

@servers(['production' => $deployServer])

@story('deploy')
git-pull
composer-install
npm-install
migrate
queue-restart
cache
@endstory

@task('git-pull')
cd {{ $deployPath }}
git pull {{ $deployRepo }} {{ $deployBranch }}
@endtask

@task('composer-install')
cd {{ $deployPath }}
composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader
@endtask

@task('npm-install')
cd {{ $deployPath }}
npm install --production
@endtask

@task('migrate')
cd {{ $deployPath }}
php artisan migrate --force
@endtask

@task('queue-restart')
cd {{ $deployPath }}
php artisan queue:restart
@endtask

@task('cache')
cd {{ $deployPath }}
php artisan cache:clear
php artisan cache:prepare
php artisan route:cache
php artisan config:cache
php artisan view:cache
@endtask

@success
@slack($slackUrl, $slackChannel, 'deploy success')
@endsuccess

@finished
@slack($slackUrl, $slackChannel, $exitCode)
@endfinished
