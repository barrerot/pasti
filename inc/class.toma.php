<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `toma` (
	`tomaid` int(11) NOT NULL auto_increment,
	`timestamp` VARCHAR(255) NOT NULL,
	`pastillaid` int(11) NOT NULL, INDEX(`pastillaid`), PRIMARY KEY  (`tomaid`)) ENGINE=MyISAM;
*/

/**
* <b>toma</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=toma&attributeList=array+%28%0A++0+%3D%3E+%27timestamp%27%2C%0A++1+%3D%3E+%27pastilla%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27VARCHAR%28255%29%27%2C%0A++1+%3D%3E+%27BELONGSTO%27%2C%0A%29
*/
include_once('class.pog_base.php');
class toma extends POG_Base
{
	public $tomaId = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $timestamp;
	
	/**
	 * @var INT(11)
	 */
	public $pastillaId;
	
	public $pog_attribute_type = array(
		"tomaId" => array('db_attributes' => array("NUMERIC", "INT")),
		"timestamp" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"pastilla" => array('db_attributes' => array("OBJECT", "BELONGSTO")),
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
	
	function toma($timestamp='')
	{
		$this->timestamp = $timestamp;
	}
	
	
	/**
	* Gets object from database
	* @param integer $tomaId 
	* @return object $toma
	*/
	function Get($tomaId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `toma` where `tomaid`='".intval($tomaId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->tomaId = $row['tomaid'];
			$this->timestamp = $this->Unescape($row['timestamp']);
			$this->pastillaId = $row['pastillaid'];
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $tomaList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `toma` ";
		$tomaList = Array();
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
			$sortBy = "tomaid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$toma = new $thisObjectName();
			$toma->tomaId = $row['tomaid'];
			$toma->timestamp = $this->Unescape($row['timestamp']);
			$toma->pastillaId = $row['pastillaid'];
			$tomaList[] = $toma;
		}
		return $tomaList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $tomaId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$rows = 0;
		if ($this->tomaId!=''){
			$this->pog_query = "select `tomaid` from `toma` where `tomaid`='".$this->tomaId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `toma` set 
			`timestamp`='".$this->Escape($this->timestamp)."', 
			`pastillaid`='".$this->pastillaId."' where `tomaid`='".$this->tomaId."'";
		}
		else
		{
			$this->pog_query = "insert into `toma` (`timestamp`, `pastillaid` ) values (
			'".$this->Escape($this->timestamp)."', 
			'".$this->pastillaId."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->tomaId == "")
		{
			$this->tomaId = $insertId;
		}
		return $this->tomaId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $tomaId
	*/
	function SaveNew()
	{
		$this->tomaId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `toma` where `tomaid`='".$this->tomaId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `toma` where ";
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
	
	
	/**
	* Associates the pastilla object to this one
	* @return boolean
	*/
	function GetPastilla()
	{
		$pastilla = new pastilla();
		return $pastilla->Get($this->pastillaId);
	}
	
	
	/**
	* Associates the pastilla object to this one
	* @return 
	*/
	function SetPastilla(&$pastilla)
	{
		$this->pastillaId = $pastilla->pastillaId;
	}
}
?>