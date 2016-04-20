php=/usr/local/domob/current/php/bin/php
script=/home/${USER}/htdocs/mis/rtb/protected/commands/shell/campaignStatsPoller.php
log=~/logs/dsp_stats.log

pid=`ps aux | grep ${script} | grep -v grep | awk '{print $2}'`

if [ -z $pid ]
then
	echo "not running"
else
	echo "killing $pid"
	kill -9 $pid
fi

nohup ${php} ${script} >>${log} 2>&1 &

exit 0
