<?php

class BUT
{
	private int   $num;
	private array $semestreImpair;
	private array $semestrePair;

	private int $numPair;
	private int $numImpair;

	function __construct(int $num, ?array $semestreImpair = array(), ?array $semestrePair = array())
	{
		$this->num          = $num;
		$this->semestre     = $semestreImpair;
		$this->semestrePair = $semestrePair;
		$this->numPair      = 1;
		$this->numImpair    = 1;
	}

	public function getNum                  (): int   { return $this->num;            }
	public function getSemestreImpair       (): array { return $this->semestreImpair; }
	public function getSemestrePair         (): array { return $this->semestrePair;   }
	public function getNumSemestrePair      (): int   { return $this->numPair;        }
	public function getNumSemestreImpair    (): int   { return $this->numImpair;      }
	
	public function setSemestrePair         ($semestrePair  ) {$this->semestrePair   = $semestrePair;   }
	public function setNum                  ($num           ) {$this->num            = $num;            }
	public function setSemestreImpair       ($semestreImpair) {$this->semestreImpair = $semestreImpair; }
	public function setNumSemestrePair      ($num           ) { $this->numPair       = $num;            }
	public function setNumSemestreImpair    ($num           ) { $this->numImpair     = $num;            }

	public function getAnnee()
	{
		$tabCursus = array_values($this->semestreImpair);

		return $tabCursus[0]->getAnnee();
	}
	

	public function estComplet() 
	{
		return (empty( $this->semestreImpair ) && empty( $this->semestrePair ));
	}

	public function getSemestreByNum($num) 
	{
		if( $num == $this->getNumSemestrePair()) return $this->semestrePair;
		else                                     return $this->semestreImpair;
	}
}

?>