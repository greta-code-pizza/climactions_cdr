<?php

namespace Climactions\Controllers;

class Controller {
 
	public function viewFrontend($view)	{
		return 'app/Views/frontend/' . $view . '.php';
	}

	public function viewErrors($view) {
		return 'app/Views/errors/' . $view . '.php';
	}

	public function viewAdmin($view) {
		return 'app/Views/admin/' . $view . '.php';

	}
	
}