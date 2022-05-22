<?php
	function connex_object()
	{

		define ("MYHOST","sql7.freemysqlhosting.net");
		define ("MYBD","sql7293279");
		define ("MYUSER","sql7293279");
		define ("MYPASS","QX54SJvNzw");
		try
		{
			$idcom=new PDO('mysql:host='.MYHOST.';dbname='.MYBD, MYUSER, MYPASS);
			return $idcom;
		}
			catch(Exception $e)
			{
				echo 'Erreur: '.$e->getMessage().'<br>';
				return NULL;
			}
	}
?>
