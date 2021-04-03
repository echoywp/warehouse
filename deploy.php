<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'warehouse');

// Project repository
set('repository', 'https://github.com/echoywp/warehouse.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);
//set('ssh_multiplexing', false);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// 保存最近五次部署，这样的话回滚最多也只能回滚到前 5 个版本
set('keep_releases', 5);
// 实践证明，这样能减少一些不必要的麻烦,如出现权限相关的问题，也可将此项设置为 true 后尝试
set('writable_use_sudo', false);

// Hosts

host('42.192.89.236')
    ->stage('production')
    ->user('git')
    ->port(23)
    ->set('branch', 'master') // 最新的主分支部署到生产机
    ->set('deploy_path', '/data/wwwroot/warehouse')
    ->identityFile('C:\Users\csdd7\.ssh')
    ->forwardAgent(true)
    ->multiplexing(true)
    ->set('http_user', 'www') // 这个与 nginx 里的配置一致
    ->addSshOption('UserKnownHostsFile', '/dev/null')
    ->addSshOption('StrictHostKeyChecking', 'no');

// Tasks

// 自定义任务：重置 opcache 缓存
task('opcache_reset', function () {
    run('{{bin/php}} -r \'opcache_reset();\'');
});

// 自定义任务：重启 php-fpm 服务
task('php-fpm:restart', function () {
    run('systemctl restart php-fpm.service');
});

// 自定义任务：supervisor reload
task('supervisor:reload', function () {
    run('sudo supervisorctl reload');
});

// 自定义任务：部署成功了用 bearychat 发消息给大佬和自己
task('send_message', function () {
    run('{{bin/php}} {{release_path}}/artisan deployed');
});

// 自定义任务：缓存路由，recipe/laravel.php 默认的流程里没有这个，所以加上，息看需要
after('artisan:config:cache', 'artisan:route:cache');

// 执行自定义任务，注意时间点是 current 已经成功链向新部署的目录之后
after('deploy:symlink', 'php-fpm:restart');
after('deploy:symlink', 'supervisor:reload');

// 部署成功后重置 opcache 缓存
after('deploy:symlink', 'opcache_reset');

// 部署成功后调用 laravel 命令行发送通知
after('success', 'send_message');

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

