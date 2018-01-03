<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Provider\UserProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;

const BASE_URL = '/';

$app = new Silex\Application();
$app['debug'] = isset($_GET['debug']);

$app->register(new SessionServiceProvider(), [
  'session.storage.handler' => null
]);
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new DoctrineServiceProvider(), array(
    'db.options' => [
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../database/app.db'
    ]
));
$app->register(new DoctrineOrmServiceProvider(), array(
    "orm.proxies_dir" =>  __DIR__.'/database/proxies',
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type" => "annotation",
                "namespace" => "App\Model",
                "path" => __DIR__."/../src/Model",
            )
        )
    )
));
$app->register(new SecurityServiceProvider(), [
    'security.firewalls' => [
        'login' => [
            'pattern' => '^/login$',
        ],
        'secured' => [
            'pattern' => '^.*$',
            'form' => [
                'login_path' => '/login',
                'check_path' => '/login_check'
            ],
            'logout' => [
                'logout_path' => '/logout',
                'invalidate_session' => true
            ],
            'users' => function() use ($app) {
                return new UserProvider($app['orm.em']);
            }
        ]
    ]
]);

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', [
        'baseUrl' => BASE_URL
    ]);
});

$app->get('/login', function (Request $request) use ($app) {
    return $app['twig']->render('login.twig', [
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username')
    ]);
});

$app->run();
