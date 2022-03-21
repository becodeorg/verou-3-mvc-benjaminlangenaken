<?php

declare(strict_types=1);

class Article
{
	public string $id;
	public string $title;
	public ?string $description;
	public ?string $publishDate;

	public function __construct(string $id, string $title, ?string $description, ?string $publishDate)
	{
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
		$this->publishDate = $publishDate;
	}

	public function formatPublishDate($format = 'd-m-Y')
	{
		// Return the date in the required format
		return date($format, strtotime($this->publishDate));
	}
}