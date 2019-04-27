<?php

namespace app\core;


class Request
{

	protected $post;
	protected $get;
	protected $method;


	public function __construct()
	{
		if(isset($_POST)){
			$this->post = $_POST;
		}

		if(isset($_GET)){
			$this->get = $_GET;
		}

		$this->server_method = $_SERVER["REQUEST_METHOD"];

	}


	public function post()
	{	
		return $this->post;
	}


	public function get()
	{
		return $this->get;
	}


	public function method()
	{	
		$this->method = $_SERVER["REQUEST_METHOD"];
		return $this->method;
	}






}