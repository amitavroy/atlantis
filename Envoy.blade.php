@setup
    require __DIR__.'/vendor/autoload.php';
    (new \Dotenv\Dotenv(__DIR__, '.env'))->load();

    $repository = getenv('DEPLOY_REPO');
    $app_dir = getenv('DEPLOY_DIR');
    $releases_dir = $app_dir . '/releases';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@servers(['web' => [$ssh]])

@story('deploy')
    clone_repository
    run_composer
    update_symlinks
    code_changes
    optimization
    remove_unwanted_folders
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir -p {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('code_changes')
    echo 'Making code changes and running migration'
    cd {{$new_release_dir}}
    php artisan migrate --force
@endtask

@task('optimization')
    echo 'Making the optimisations for performance'
    cd {{$new_release_dir}}
    pwd
    php artisan config:clear
    php artisan cache:clear
    php artisan config:cache
    php artisan view:clear
@endtask

@task('remove_unwanted_folders')
    echo "🚾 Cleaning up old releases"
    cd {{$releases_dir}}
    rm -rf $(ls -t1 . | tail -n +4)
@endtask

