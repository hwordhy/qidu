<?php

if (!isset($_GET["process_type"])) {
	exit();
}

include ("../public/api_header.php");
header("Content-type: text/html; charset=utf8");
$process_type = $_GET["process_type"];
$load_recommend_rids = "";

if ($process_type == "update") {
	$rids = $_GET["rids"];
	$rids_array = explode(",", $rids);
	$clean_sql = "update jieqi_article_reviews set  is_recommend = '0'";
	$clean_result = mysql_query($clean_sql, $con);

	foreach ($rids_array as $key => $value ) {
		$recommend_sql = "update jieqi_article_reviews set is_recommend = '1' where topicid = '" . $value . "'";
		mysql_query($recommend_sql, $con);
	}

	$recommend_query_count = mysql_affected_rows();

	if ($recommend_query_count) {
		$load_recommend_sql = "select topicid from jieqi_article_reviews where is_recommend = 1";
		$load_recommend_sql_result = mysql_query($load_recommend_sql, $con);

		while ($row = mysql_fetch_array($load_recommend_sql_result)) {
			$load_recommend_rids = $load_recommend_rids . $row["topicid"] . ",";
		}

		$load_recommend_rids = substr($load_recommend_rids, 0, -1);
		api_json($load_recommend_rids, "true");
	}
}
else {
	$load_recommend_sql = "select topicid from jieqi_article_reviews where is_recommend = 1";
	$load_recommend_sql_result = mysql_query($load_recommend_sql, $con);
	echo "褰揿墠鎺ㄨ崘镄勫皬璇磇d锛?/br></br>";

	while ($row = mysql_fetch_array($load_recommend_sql_result)) {
		echo $row["topicid"] . "</br>";
	}
}

include ("../public/api_footer.php");

?>
