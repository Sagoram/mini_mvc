<?php

declare(strict_types=1);

// Démarre la session
session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    ['GET', '/auth/register', [Mini\Controllers\AuthController::class, 'register']],
    ['POST', '/auth/register', [Mini\Controllers\AuthController::class, 'registerPost']],
    ['GET', '/auth/login', [Mini\Controllers\AuthController::class, 'login']],
    ['POST', '/auth/login', [Mini\Controllers\AuthController::class, 'loginPost']],
    ['GET', '/auth/logout', [Mini\Controllers\AuthController::class, 'logout']],
    ['GET', '/product', [Mini\Controllers\ProductController::class, 'index']],
    ['GET', '/product/{id}', [Mini\Controllers\ProductController::class, 'show']],
    ['GET', '/product/category/{id}', [Mini\Controllers\ProductController::class, 'byCategory']],
    ['GET', '/cart', [Mini\Controllers\CartController::class, 'view']],
    ['POST', '/cart/add/{id}', [Mini\Controllers\CartController::class, 'add']],
    ['GET', '/cart/remove/{id}', [Mini\Controllers\CartController::class, 'remove']],
    ['GET', '/cart/clear', [Mini\Controllers\CartController::class, 'clear']],
    ['GET', '/checkout', [Mini\Controllers\CheckoutController::class, 'view']],
    ['POST', '/checkout/process', [Mini\Controllers\CheckoutController::class, 'process']],
    ['GET', '/order/history', [Mini\Controllers\OrderController::class, 'history']],
    ['GET', '/order/{id}', [Mini\Controllers\OrderController::class, 'show']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


