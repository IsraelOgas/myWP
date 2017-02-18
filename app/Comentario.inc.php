<?php

class Comentario
{
	private $id;
	private $autorID;
	private $entradaID;
	private $titulo;
	private $texto;
	private $fecha;

	function __construct($id, $autorID, $entradaID, $titulo, $texto, $fecha)
	{
		$this -> id = $id;
		$this -> autorID = $autorID;
		$this -> entradaID = $entradaID;
		$this -> titulo = $titulo;
		$this -> texto = $texto;
		$this -> fecha = $fecha;
	}

	public function getID()
	{
	    return $this->id;
	}

	public function getAutorID()
	{
	    return $this->autorID;
	}
	 
	public function getEntradaID()
	{
	    return $this->entradaID;
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
}