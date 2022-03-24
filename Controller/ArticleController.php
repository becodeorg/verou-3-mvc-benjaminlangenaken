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

	public function show()
	{
		$articles = $this->getArticle();
		require 'View/articles/show.php';
	}

	private function getArticle()
	{
		$id = $_GET['id'] ?? null;

		if (!$id) {
			header('Location: index.php');
			exit;
		}

		// Fetch all articles as $rawArticles (as a simple array)
		$sqlQuery = 'SELECT * FROM articles WHERE id = :id';
		$statement = $this->databaseManager->connection->prepare($sqlQuery);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$rawArticle = $statement->fetch(PDO::FETCH_ASSOC);

		return new Article($rawArticle['id'], $rawArticle['title'], $rawArticle['description'],
			$rawArticle['publish_date']);
	}

	public function firstId()
	{
		$sqlQuery = 'SELECT MIN(id) FROM articles';
		$statement = $this->databaseManager->connection->prepare($sqlQuery);
		$statement->execute();
		$firstId = $statement->fetch(PDO::FETCH_ASSOC);

		return $firstId["MIN(id)"];
	}

	public function lastId()
	{
		$sqlQuery = 'SELECT MAX(id) FROM articles';
		$statement = $this->databaseManager->connection->prepare($sqlQuery);
		$statement->execute();
		$lastId = $statement->fetch(PDO::FETCH_ASSOC);

		return $lastId["MAX(id)"];
	}

	public function previousId($id)
	{
		$sqlQuery = 'SELECT id FROM articles WHERE id < :id ORDER BY id DESC LIMIT 1';
		$statement = $this->databaseManager->connection->prepare($sqlQuery);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$previousId = $statement->fetch(PDO::FETCH_ASSOC);

		return $previousId;
	}

	public function nextId($id)
	{
		$sqlQuery = 'SELECT id FROM articles WHERE id > :id LIMIT 1';
		$statement = $this->databaseManager->connection->prepare($sqlQuery);
		$statement->bindValue(':id', $id);
		$statement->execute();
		$nextId = $statement->fetch(PDO::FETCH_ASSOC);

		return $nextId;
	}
}