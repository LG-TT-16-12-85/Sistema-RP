<?php
	class Error extends Application
	{
		/* Constructor de la clase Error */
		function __construct(){}
		
		function no_existe()
		{
			$this->loadView('view_no_existe', $data);
		}
	}
?>