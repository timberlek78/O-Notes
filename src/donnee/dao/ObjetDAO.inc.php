<?php
abstract class ObjetDAO
{
	public abstract function getEqClesPrimaires( ) : array;
	public abstract function getEqAttributs() : array;

	public function __toString(): string
	{
		$str = "";
		foreach( $this->getEqAttributs() as $cle => $valeur )
		{
			$str .= $cle . " = " . $valeur . ", ";
		}
		return $str;
	}

	public function equals( ObjetDAO $objet ) : bool
	{
		$tabCles = $this->getEqClesPrimaires();
		foreach( $tabCles as $cle => $valeur )
		{
			if( $this->$cle != $objet->$cle )
			{
				return false;
			}
		}
		return true;
	}
}