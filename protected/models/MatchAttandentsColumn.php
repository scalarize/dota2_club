<?php

class MatchAttandentsColumn extends CDataColumn
{

	public $highlight;

	protected function renderDataCellContent($row, $data)
	{
		$attendants = $data->attendants[$this->name];
		if (is_array($attendants)) {
			foreach ($attendants as $attendant) {
				if ($attendant->id == $this->highlight) {
					printf('<a href="/player/%d"><img src="%s" class="player-avatars-img %s" title="%s" /></a>',
						$attendant->id,
						$attendant->avatarUrl, $data->winner == $this->name ? '' : 'gray',
						$attendant->steamName);
				} else {
					printf('<a href="/player/%d"><img src="%s" class="player-avatars-img-small %s" title="%s" /></a>',
						$attendant->id,
						$attendant->avatarUrl, $data->winner == $this->name ? '' : 'gray',
						$attendant->steamName);
				}
			}
		}
	}

}

/** vim: set noet fdm=indent : */

