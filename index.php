<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Create new session
session_start();

//include all your model files here
require_once 'Model/config.php';
require_once 'Model/DatabaseManager.php';
require_once 'Model/Article.php';
//include all your controllers here
require_once 'Controller/HomepageController.php';
require_once 'Controller/ArticleController.php';

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();

// Get the current page to load
// If nothing is specified, it will remain empty (home should be loaded)
$page = $_GET['page'] ?? null;

// Load the controller
// It will *control* the rest of the work to load the page
switch ($page) {
	case 'articles-index':
		// This is shorthand for:
		// $articleController = new ArticleController;
		// $articleController->index();
		(new ArticleController($databaseManager))->index();
		break;
	case 'articles-show':
		// Add detail page
		(new ArticleController($databaseManager))->show();
		break;
	case 'home':
	default:
		(new HomepageController())->index();
		break;
}