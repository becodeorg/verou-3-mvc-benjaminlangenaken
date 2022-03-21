<?php

declare(strict_types = 1);

class ArticleController
{
	private DatabaseManager $databaseManager;

	public function __construct(DatabaseManager $databaseManager)
	{
		$this->databaseManager = $databaseManager;
	}

	public function index()
	{
		// Load all required data
		$articles = $this->getArticles();

		// Load the view
		require 'View/articles/index.php';
	}

	// Note: this function can also be used in a repository - the choice is yours
	private function getArticles(): array
	{
		// Fetch all articles as $rawArticles (as a simple array)
		$sqlQuery = 'SELECT * FROM articles';
		$statement = $this->databaseManager->connection->prepare($sqlQuery);
		$statement->execute();
		$rawArticles = $statement->fetchAll(PDO::FETCH_ASSOC);

		$articles = [];
		foreach ($rawArticles as $rawArticle) {
			// We are converting an article from a "dumb" array to a much more flexible class
			$articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'],
				$rawArticle['publish_date']);
		}

		return $articles;
	}

	public function show(): array
	{
		$articles = $this->getArticles();
		// This can be used for a detail page
		require 'View/articles/show.php';
		// Fetch one article as $rawArticle (as a simple array)
		$sqlQuery = 'SELECT * FROM articles';
		$statement = $this->databaseManager->connection->prepare($sqlQuery);
		$statement->execute();
		$rawArticles = $statement->fetchAll(PDO::FETCH_ASSOC);

		$articles = [];
		foreach ($rawArticles as $rawArticle) {
			// We are converting an article from a "dumb" array to a much more flexible class
			$articles[] = new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'],
				$rawArticle['publish_date']);}

		return $articles;
	}
}