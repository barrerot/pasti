<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `tipo` (
	`tipoid` int(11) NOT NULL auto_increment,
	`tipo` VARCHAR(255) NOT NULL, PRIMARY KEY  (`tipoid`)) ENGINE=MyISAM;
*/

/**
* <b>tipo</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=tipo&attributeList=array+%28%0A++0+%3D%3E+%27tipo%27%2C%0A++1+%3D%3E+%27pastilla%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27HASMANY%27%2C%0A%29
*/
include_once('class.pog_base.php');
class tipo extends POG_Base
{
	public $tipoId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $tipo;
	
	/**
	 * @var private array of pastilla objects
	 */
	private $_pastillaList = array();
	
	public $pog_attribute_type = array(
		"tipoId" => array('db_attributes' => array("NUMERIC", "INT")),
		"tipo" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"pastilla" => array('db_attributes' => array("OBJECT", "HASMANY")),
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
	
	function tipo($tipo='')
	{
		$this->tipo = $tipo;
		$this->_pastillaList = array();
	}
	
	
	/**
	* Gets object from database
	* @param integer $tipoId 
	* @return object $tipo
	*/
	function Get($tipoId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `tipo` where `tipoid`='".intval($tipoId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->tipoId = $row['tipoid'];
			$this->tipo = $this->Unescape($row['tipo']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $tipoList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `tipo` ";
		$tipoList = Array();
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
			$sortBy = "tipoid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$tipo = new $thisObjectName();
			$tipo->tipoId = $row['tipoid'];
			$tipo->tipo = $this->Unescape($row['tipo']);
			$tipoList[] = $tipo;
		}
		return $tipoList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $tipoId
	*/
	function Save($deep = true)
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->tipoId!=''){
			$this->pog_query = "select `tipoid` from `tipo` where `tipoid`='".$this->tipoId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `tipo` set 
			`tipo`='".$this->Escape($this->tipo)."'where `tipoid`='".$this->tipoId."'";
		}
		else
		{
			$this->pog_query = "insert into `tipo` (`tipo`) values (
			'".$this->Escape($this->tipo)."')";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->tipoId == "")
		{
			$this->tipoId = $insertId;
		}
		if ($deep)
		{
			foreach ($this->_pastillaList as $pastilla)
			{
				$pastilla->tipoId = $this->tipoId;
				$pastilla->Save($deep);
			}
		}
		return $this->tipoId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $tipoId
	*/
	function SaveNew($deep = false)
	{
		$this->tipoId = '';
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
			$pastillaList = $this->GetPastillaList();
			foreach ($pastillaList as $pastilla)
			{
				$pastilla->Delete($deep, $across);
			}
		}
		$connection = Database::Connect();
		$this->pog_query = "delete from `tipo` where `tipoid`='".$this->tipoId."'";
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
				$pog_query = "delete from `tipo` where ";
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
	* Gets a list of pastilla objects associated to this one
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array of pastilla objects
	*/
	function GetPastillaList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$pastilla = new pastilla();
		$fcv_array[] = array("tipoId", "=", $this->tipoId);
		$dbObjects = $pastilla->GetList($fcv_array, $sortBy, $ascending, $limit);
		return $dbObjects;
	}
	
	
	/**
	* Makes this the parent of all pastilla objects in the pastilla List array. Any existing pastilla will become orphan(s)
	* @return null
	*/
	function SetPastillaList(&$list)
	{
		$this->_pastillaList = array();
		$existingPastillaList = $this->GetPastillaList();
		foreach ($existingPastillaList as $pastilla)
		{
			$pastilla->tipoId = '';
			$pastilla->Save(false);
		}
		$this->_pastillaList = $list;
	}
	
	
	/**
	* Associates the pastilla object to this one
	* @return 
	*/
	function AddPastilla(&$pastilla)
	{
		$pastilla->tipoId = $this->tipoId;
		$found = false;
		foreach($this->_pastillaList as $pastilla2)
		{
			if ($pastilla->pastillaId > 0 && $pastilla->pastillaId == $pastilla2->pastillaId)
			{
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			$this->_pastillaList[] = $pastilla;
		}
	}
}
?>