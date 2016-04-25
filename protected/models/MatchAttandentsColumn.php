<?php

class MatchAttandentsColumn extends CDataColumn
{

	protected function renderDataCellContent($row, $data)
	{
		$attendants = $data->attendants[$this->name];
		if (is_array($attendants)) {
			foreach ($attendants as $attendant) {
				printf('<img src="%s" class="match-avatars-img-small %s" title="%s" />',
					$attendant->avatarUrl, $data->winner == $this->name ? '' : 'gray',
					$attendant->steamName);
			}
		}
	}

}

/** vim: set noet fdm=indent : */

