@servers(['web' => 'nolimit@staging.api.v3.nolimitid.com'])

@task('cleanup', ['on' => 'web'])
    cd /data/www/bankaccount/main
    ls -als storage/framework/sessions
    rm -rf storage/framework/sessions/*
    ls -als storage/logs
    rm -rf storage/logs/*
@endtask