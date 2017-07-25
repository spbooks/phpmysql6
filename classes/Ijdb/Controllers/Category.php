<?php
namespace Ijdb\Controllers;

class Category {
	private $categoriesTable;

	public function __construct(\Ninja\DatabaseTable $categoriesTable) {
		$this->categoriesTable = $categoriesTable;
	}
}