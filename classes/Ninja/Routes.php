<?php
namespace Ninja;

interface Routes {
	public function getRoutes(): array;
	public function getAuthentication(): \Ninja\Authentication;
	public function checkPermission($permission): bool;
}