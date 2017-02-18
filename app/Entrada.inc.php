<?php

class Entrada {
	
	private $id;
	private $autorID;
	private $titulo;
	private $url;
	private $texto;
	private $fecha;
	private $activa;


	function __construct($id, $autorID, $url, $titulo, $texto, $fecha, $activa)
	{
		$this -> id = $id;
		$this -> autorID = $autorID;
		$this -> url = $url;
		$this -> titulo = $titulo;
		$this -> texto = $texto;
		$this -> fecha = $fecha;
		$this -> activa = $activa;
	}
	 
	public function setID($id)
	{
	    $this->id = $id;
	    return $this;
	}

	public function getID()
	{
	    return $this->id;
	}

	public function getAutorID()
	{
	    return $this->autorID;
	}
	 
	public function getTitulo()
	{
	    return $this->titulo;
	}
	 
	public function setTitulo($titulo)
	{
	    $this->titulo = $titulo;
	    return $this;
	}

	public function getURL()
	{
	    return $this->url;
	}

	public function setURL($url)
	{
	    $this->url = $url;
	    return $this;
	}

	public function getTexto()
	{
	    return $this->texto;
	}
	 
	public function setTexto($texto)
	{
	    $this->texto = $texto;
	    return $this;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function getActiva()
	{
	    return $this->activa;
	}
	 
	public function setActiva($activa)
	{
	    $this->activa = $activa;
	    return $this;
	}
}