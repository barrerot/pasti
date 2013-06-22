<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `pastilla` (
	`pastillaid` int(11) NOT NULL auto_increment,
	`nombre` VARCHAR(255) NOT NULL,
	`tipoid` int(11) NOT NULL,
	`enabled` INT NOT NULL,
	`usuarioid` int(11) NOT NULL, INDEX(`tipoid`,`usuarioid`), PRIMARY KEY  (`pastillaid`)) ENGINE=MyISAM;
*/

/**
* <b>pastilla</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=pastilla&attributeList=array+%28%0A++0+%3D%3E+%27nombre%27%2C%0A++1+%3D%3E+%27tipo%27%2C%0A++2+%3D%3E+%27toma%27%2C%0A++3+%3D%3E+%27enabled%27%2C%0A++4+%3D%3E+%27usuario%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27BELONGSTO%27%2C%0A++2+%3D%3E+%27HASMANY%27%2C%0A++3+%3D%3E+%27INT%27%2C%0A++4+%3D%3E+%27BELONGSTO%27%2C%0A%29
*/
include_once('class.pog_base.php');
class pastilla extends POG_Base
{
	public $pastillaId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $nombre;
	
	/**
	 * @var INT(11)
	 */
	public $tipoId;
	
	/**
	 * @var private array of toma objects
	 */
	private $_tomaList = array();
	
	/**
	 * @var INT
	 */
	public $enabled;
	
	/**
	 * @var INT(11)
	 */
	public $usuarioId;
	
	public $pog_attribute_type = array(
		"pastillaId" => array('db_attributes' => array("NUMERIC", "INT")),
		"nombre" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"tipo" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		"toma" => array('db_attributes' => array("OBJECT", "HASMANY")),
		"enabled" => array('db_attributes' => array("NUMERIC", "INT")),
		"usuario" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function pastilla($nombre='', $enabled='')
	{
		$this->nombre = $nombre;
		$this->_tomaList = array();
		$this->enabled = $enabled;
	}
	
	
	/**
	* Gets object from database
	* @param integer $pastillaId 
	* @return object $pastilla
	*/
	function Get($pastillaId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `pastilla` where `pastillaid`='".intval($pastillaId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->pastillaId = $row['pastillaid'];
			$this->nombre = $this->Unescape($row['nombre']);
			$this->tipoId = $row['tipoid'];
			$this->enabled = $this->Unescape($row['enabled']);
			$this->usuarioId = $row['usuarioid'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $pastillaList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `pastilla` ";
		$pastillaList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "pastillaid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$pastilla = new $thisObjectName();
			$pastilla->pastillaId = $row['pastillaid'];
			$pastilla->nombre = $this->Unescape($row['nombre']);
			$pastilla->tipoId = $row['tipoid'];
			$pastilla->enabled = $this->Unescape($row['enabled']);
			$pastilla->usuarioId = $row['usuarioid'];
			$pastillaList[] = $pastilla;
		}
		return $pastillaList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $pastillaId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->pastillaId!=''){
			$this->pog_query = "select `pastillaid` from `pastilla` where `pastillaid`='".$this->pastillaId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `pastilla` set 
			`nombre`='".$this->Escape($this->nombre)."', 
			`tipoid`='".$this->tipoId."', 
			`enabled`='".$this->Escape($this->enabled)."', 
			`usuarioid`='".$this->usuarioId."' where `pastillaid`='".$this->pastillaId."'";
		}
		else
		{
			$this->pog_query = "insert into `pastilla` (`nombre`, `tipoid`, `enabled`, `usuarioid` ) values (
			'".$this->Escape($this->nombre)."', 
			'".$this->tipoId."', 
			'".$this->Escape($this->enabled)."', 
			'".$this->usuarioId."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->pastillaId == "")
		{
			$this->pastillaId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_tomaList as $toma)
			{
				$toma->pastillaId = $this->pastillaId;
				$toma->Save($deep);
			}
		}
		return $this->pastillaId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $pastillaId
	*/
	function SaveNew($deep = false)
	{
		$this->pastillaId = '';
		return $this->Save($deep);
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete($deep = false, $across = false)
	{
		if ($deep)
		{
			$tomaList = $this->GetTomaList();
			foreach ($tomaList as $toma)
			{
				$toma->Delete($deep, $across);
			}
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `pastilla` where `pastillaid`='".$this->pastillaId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array, $deep = false, $across = false)
	{
		if (sizeof($fcv_array) > 0)
		{
			if ($deep || $across)
			{
				$objectList = $this->GetList($fcv_array);
				foreach ($objectList as $object)
				{
					$object->Delete($deep, $across);
				}
			}
			else
			{
				$connection = Database::Connect();
				$pog_query = "delete from `pastilla` where ";
				for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
				{
					if (sizeof($fcv_array[$i]) == 1)
					{
						$pog_query .= " ".$fcv_array[$i][0]." ";
						continue;
					}
					else
					{
						if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
						{
							$pog_query .= " AND ";
						}
						if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
						{
							$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
						}
						else
						{
							$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
						}
					}
				}
				return Database::NonQuery($pog_query, $connection);
			}
		}
	}
	
	
	/**
	* Associates the tipo object to this one
	* @return boolean
	*/
	function GetTipo()
	{
		$tipo = new tipo();
		return $tipo->Get($this->tipoId);
	}
	
	
	/**
	* Associates the tipo object to this one
	* @return 
	*/
	function SetTipo(&$tipo)
	{
		$this->tipoId = $tipo->tipoId;
	}
	
	
	/**
	* Gets a list of toma objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of toma objects
	*/
	function GetTomaList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$toma = new toma();
		$fcv_array[] = array("pastillaId", "=", $this->pastillaId);
		$dbObjects = $toma->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all toma objects in the toma List array. Any existing toma will become orphan(s)
	* @return null
	*/
	function SetTomaList(&$list)
	{
		$this->_tomaList = array();
		$existingTomaList = $this->GetTomaList();
		foreach ($existingTomaList as $toma)
		{
			$toma->pastillaId = '';
			$toma->Save(false);
		}
		$this->_tomaList = $list;
	}
	
	
	/**
	* Associates the toma object to this one
	* @return 
	*/
	function AddToma(&$toma)
	{
		$toma->pastillaId = $this->pastillaId;
		$found = false;
		foreach($this->_tomaList as $toma2)
		{
			if ($toma->tomaId > 0 && $toma->tomaId == $toma2->tomaId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_tomaList[] = $toma;
		}
	}
	
	
	/**
	* Associates the usuario object to this one
	* @return boolean
	*/
	function GetUsuario()
	{
		$usuario = new usuario();
		return $usuario->Get($this->usuarioId);
	}
	
	
	/**
	* Associates the usuario object to this one
	* @return 
	*/
	function SetUsuario(&$usuario)
	{
		$this->usuarioId = $usuario->usuarioId;
	}
}
?>