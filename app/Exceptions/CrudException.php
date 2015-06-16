<?php namespace App\Exceptions;

use Exception;

class CrudException extends Exception {

	public function errorMessage() {
		return 'CRUD gagal coy, controllernya ' . $this->getMessage();
	}

}