<?php

class PlayerHeroModel extends HeroModel
{

	public $hero;
	public $matches = array();

	public function __construct($hero)
	{
		$this->hero = $hero;
	}

	public function getId()
	{
		return $this->hero->id;
	}

	public function append($match)
	{
		$this->matches []= $match;
	}

	public function getMatches($season = '2016s2')
	{
		// season bug here FIXME
		return $this->matches;
	}

}

/** vim: set fdm=indent : */

