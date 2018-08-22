@servers(['web' => 'root@51.38.36.161'])

@setup
    $dir = "/home/gkgaming";
    $releases = 3;

    $shared = $dir . '/shared';
    $current = $dir . '/current';
    $repo = $dir . '/repo';
    $release = $dir . '/releases/' . date('YmdHis');
@endsetup

@macro('deploy')
    createrelease
    composer
@endmacro

@task('prepare')
    mkdir -p {{ $repo }};
    mkdir -p {{ $shared }};
    cd {{ $repo }};
    git init --bare;
@endtask


@task('createrelease')
    mkdir -p {{ $release }};
    cd {{ $repo }};
    git archive master |tar -x -C {{ $release }};
    echo "Création de {{ $release }}";
@endtask

@task('composer')
    mkdir -p {{ $shared }}/vendor;
    ln -s {{ $shared }}/vendor {{ $release }}/vendor;
    cd {{ $release }};
    composer update --no-dev --no-progress;
@endtask