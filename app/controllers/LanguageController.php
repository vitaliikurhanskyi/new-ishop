<?php

namespace app\controllers;

class LanguageController extends AppController
{

	public function changeAction()
	{
		$lang = $_GET['lang'] ? $_GET['lang'] : NULL;

		if($lang) {

		}

		redirect();

	}

}