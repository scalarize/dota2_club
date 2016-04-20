<?php

class ConsoleErrorHandler extends CErrorHandler
{
	public function handleError($event)
	{
		// var_dump($event);

		echo $event->message . " at file " . $event->file . ":" . $event->line . ", code: " . $event->code . "\n";
	}

	public function handleException($exception)
	{
		var_dump($exception);

		echo $exception->getMessage() . "\n";
	}

}
