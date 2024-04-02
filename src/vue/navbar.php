<?php
function genererNavbar ( $nomUtilisateur )
{
	$navbar = '<div class="conteneur">' .
				'<div class="navbar">' .
					'<div class="logo">' .
						'<img src="./ressources/logo.png" alt="Logo Menu"/>' .
					'</div>' .
					'<div class="menu">' .
						'<ul>' .
							'<li>' .
								'<a href="./importer/importer.html">Importation</a>' .
							'</li>' .
							'<li>' .
								'<a href="./visualiser/visualiser.html">Visualisation</a>' .
							'</li>' .
							'<li>' .
								'<a href="./exporter/exporter.html">Exportation</a>' .
							'</li>' .
						'</ul>' .
					'</div>' .
					'<div class="contient-button">' .
						'<div class="button">' .
							'<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">' .
										'<g clip-path="url(#clip0_168_56)">' .
											'<circle cx="9.70603" cy="4.79451" r="4.79451" fill="white"/>' .
											'<path fill-rule="evenodd" clip-rule="evenodd" d="M19.178 19.9998C19.178 14.7039 14.8849 9.35498 9.58901 9.35498C4.29315 9.35498 0 14.7039 0 19.9998H9.58901H19.178Z" fill="white"/>' .
										'</g>' .
										'<defs>' .
											'<clipPath id="clip0_168_56">' .
												'<rect width="20" height="20" fill="white"/>' .
											'</clipPath>' .
										'</defs>' .
									'</svg>' .
							'<a href="#" class="connecter">' .
								$nomUtilisateur .
							'</a>' .
						'</div>' .
					'</div>' .
				'</div>' .
			'</div>';
	
	return $navbar;
}
echo genererNavbar("Nom utilisateur");
?>
