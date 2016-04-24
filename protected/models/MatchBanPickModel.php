<?php

class MatchBanPickModel extends MatchBanPickRecord
{

	public function relations()
	{
		return array(
			'hero' => array(self::BELONGS_TO, 'HeroModel', 'hero_id'),
		);
	}

}

/** vim: set noet fdm=indent */

