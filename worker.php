<?php

$worker = new GearmanWorker();
$worker->addServer();
$worker->addFunction("say", function(GearmanJob $job) {
	$workload = $job->workload();
	echo "receive data:" . $workload . PHP_EOL;
	return strrev($workload);
});

while ($worker->work()) {
	if ($worker->returnCode() !== GEARMAN_SUCCESS) {
		echo "error" . PHP_EOL;
	}
}

?>
