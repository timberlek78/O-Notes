<?php

function genererTableauHtml( $tableau ) : string
{
	$tableauHtml = "<table>";
	$tableauHtml .= genererEnteteHtml( $tableau );
	$tableauHtml .= genererValeursTableauHtml( $tableau );
	$tableauHtml .= "</table>";

	return $tableauHtml;
}

function genererEnteteHtml( $tableau ) : string
{
	$enteteHtml = "<tr>";

	foreach( $tableau[0] as $header )
	{
		$enteteHtml .= "<th>$header</th>";
	}

	$enteteHtml .= "</tr>";
	return $enteteHtml;
}

function genererValeursTableauHtml( $tableau ) : string
{
	$premiereLigne = 1;
	$LignesHtml = "";

	for( $cpt = $premiereLigne; $cpt < count($tableau); $cpt++ )
	{
		$LignesHtml .= "<tr>";
		foreach( $tableau[$cpt] as $cellule )
		{
			$LignesHtml .= "<td>$cellule</td>";
		}
		$LignesHtml .= "</tr>";
	}

	return $LignesHtml;
}

?>