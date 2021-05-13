<?php

define('JIEQI_MODULE_NAME', 'pay');
require_once '../../../global.php';
jieqi_getconfigs('pay', 'power');
jieqi_getconfigs('system', 'power');
if (!jieqi_checkpower($jieqiPower['system']['adminpaylog'], $jieqiUsersStatus, $jieqiUsersGroup, true, true) && !jieqi_checkpower($jieqiPower['pay']['adminpaylog'], $jieqiUsersStatus, $jieqiUsersGroup, true, true)) {
	jieqi_printfail(LANG_NO_PERMISSION);
}

jieqi_loadlang('pay', JIEQI_MODULE_NAME);
include_once jieqi_path_inc('class/paylog.php', "pay");
$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
if (!empty($_POST['act'])) {
	jieqi_checkpost();

	switch ($_POST['act']) {
	case 'confirm':
		$_POST['id'] = intval($_POST['id']);
		$tmplog = $paylog_handler->get($_POST['id']);

		if (is_object($tmplog) && ($tmplog->getVar('payflag') == 0)) {
			$paytype = $tmplog->getVar('paytype', 'n');
			define('JIEQI_PAY_TYPE', $paytype);
			jieqi_loadlang('pay', JIEQI_MODULE_NAME);
			jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');
			include jieqi_path_inc('include/funpay.php', "pay");
			$payinfo = array('orderid' => intval($tmplog->getVar('payid', 'n')), 'retserialno' => '', 'retaccount' => '', 'retinfo' => '', 'return' => true, 'manual' => true);
			jieqi_pay_return($payinfo);
		}

		jieqi_jumppage($jieqiModules['pay']['url'] . '/admin/paylog.php', '', '', true);
		break;

	case 'del':
		$_POST['id'] = intval($_POST['id']);
		$criteria = new CriteriaCompo(new Criteria('payid', $_POST['id'], '='));
		$criteria->add(new Criteria('payflag', 0));
		$paylog_handler->delete($criteria);
		unset($criteria);
		jieqi_jumppage($jieqiModules['pay']['url'] . '/admin/paylog.php', '', '', true);
		break;

	case 'clean':
		if (empty($_POST['days']) || (intval($_POST['days']) < 1)) {
			jieqi_printfail(LANG_ERROR_PARAMETER);
		}

		$_POST['days'] = intval($_POST['days']);
		$btime = time() - (3600 * 24 * $_POST['days']);
		$criteria = new CriteriaCompo(new Criteria('buytime', $btime, '<'));
		$criteria->add(new Criteria('payflag', 0));
		$paylog_handler->delete($criteria);
		unset($criteria);
		jieqi_jumppage($jieqiModules['pay']['url'] . '/admin/paylog.php', LANG_DO_SUCCESS, $jieqiLang['pay']['paylog_clean_success']);
	}
}

jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$jieqiTset['jieqi_contents_template'] = jieqi_path_template('admin/paylog.html', "pay");
include_once jieqi_path_common('admin/header.php');
$jieqiPset = jieqi_get_pageset();
jieqi_getconfigs(JIEQI_MODULE_NAME, 'paytype');
$criteria = new CriteriaCompo();
if (!empty($_REQUEST['keyword'])) {
	switch ($_REQUEST['keytype']) {
	case 'payid':
		$criteria->add(new Criteria('payid', intval($_REQUEST['keyword']), '='));
		break;

	case 'payflag':
		switch ($_REQUEST['keyword']) {
		case $jieqiLang['pay']['state_unconfirm']:
			$payflag = 0;
			break;

		case $jieqiLang['pay']['state_paysuccess']:
			$payflag = 1;
			break;

		case $jieqiLang['pay']['state_handconfirm']:
			$payflag = 2;
			break;

		default:
			$payflag = -1;
			break;
		}

		if (0 <= $payflag) {
			$criteria->add(new Criteria('payflag', $payflag, '='));
		}

		break;

	case 'paytype':
		$paytype = $_REQUEST['keyword'];

		foreach ($jieqiPaytype as $k => $v) {
			if (($_REQUEST['keyword'] == $v['name']) || ($_REQUEST['keyword'] == $v['shortname'])) {
				$paytype = $k;
				break;
			}
		}

		if (!empty($paytype)) {
			$criteria->add(new Criteria('paytype', $paytype, '='));
		}

		break;

	case 'buyid':
		$criteria->add(new Criteria('buyid', intval($_REQUEST['keyword']), '='));
		break;

	case 'buyname':
	default:
		$criteria->add(new Criteria('buyname', $_REQUEST['keyword'], '='));
		break;

	case 'channel':
		$criteria->add(new Criteria('channel', intval($_REQUEST['keyword']), '='));
		break;
	}
}

switch ($_REQUEST['payflag']) {
case 'success':
	$criteria->add(new Criteria('payflag', 0, '>'));
	break;

case 'failure':
	$criteria->add(new Criteria('payflag', 0, '='));
}

if (!empty($_REQUEST['datestart'])) {
	$tmpvar = @(strtotime($_REQUEST['datestart']));

	if (0 < $tmpvar) {
		$criteria->add(new Criteria('buytime', $tmpvar, '>='));
	}
}

if (!empty($_REQUEST['dateend'])) {
	$_REQUEST['dateend'] = trim($_REQUEST['dateend']);
	$tmpvar = @(strtotime($_REQUEST['dateend']));

	if (strpos($_REQUEST['dateend'], ' ') === false) {
		$tmpvar += (3600 * 24) - 1;
	}

	if (0 < $tmpvar) {
		$criteria->add(new Criteria('buytime', $tmpvar, '<='));
	}
}

$criteria->setSort('payid');
$criteria->setOrder('DESC');
if (!empty($_REQUEST['isexport'])) {
	jieqi_getconfigs('pay', 'export');
	header('Accept-Ranges: bytes');

	if ($_REQUEST['exportformat'] == 'exceltext') {
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=paylog.txt');
	}
	else {
		header('Content-type: text/plain');
		header('Content-Disposition: attachment; filename=paylog.xls');
	}

	foreach ($jieqiExport['pay'] as $v) {
		echo $v['caption'] . "\t";
	}

	echo "\n";
	$paylog_handler->queryObjects($criteria);

	while ($v = $paylog_handler->getObject()) {
		$row = jieqi_query_rowvars($v);

		if (isset($jieqiPaytype[$v->getVar('paytype', 'n')])) {
			$row['paytype'] = $jieqiPaytype[$v->getVar('paytype', 'n')]['shortname'];
		}

		$row['buytime'] = date('Y-m-d H:i:s', $row['buytime']);
		$row['rettime'] = date('Y-m-d H:i:s', $row['rettime']);

		foreach ($jieqiExport['pay'] as $k => $v) {
			if (isset($row[$k])) {
				echo $row[$k];
			}

			echo "\t";
		}

		echo "\n";
	}

	exit();
}

$criteria->setLimit($jieqiPset['rows']);
$criteria->setStart($jieqiPset['start']);
$paylog_handler->queryObjects($criteria);
$paylogrows = array();
$k = 0;
while ($v = $paylog_handler->getObject()) {
	$paylogrows[$k] = jieqi_query_rowvars($v);

	if (isset($jieqiPaytype[$v->getVar('paytype', 'n')])) {
		$paylogrows[$k]['paytype'] = $jieqiPaytype[$v->getVar('paytype', 'n')]['shortname'];
	}

	$k++;
}

$jieqiTpl->assign_by_ref('paylogrows', $paylogrows);
$jieqiTpl->assign('_request', jieqi_funtoarray('jieqi_htmlstr', $_REQUEST));
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
$sql = 'SELECT count(*) as cot, sum(egold) as sumegold, sum(money) as summoney FROM ' . jieqi_dbprefix('pay_paylog') . ' ' . $criteria->renderWhere();
$query->execute($sql);
$paylogstat = $query->getRow();
$paylogstat = jieqi_funtoarray('jieqi_htmlstr', $paylogstat);
$jieqiTpl->assign_by_ref('paylogstat', $paylogstat);
include_once jieqi_path_lib('html/page.php');
$jieqiPset['count'] = $paylog_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jumppage->setlink('', true, true);
$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once jieqi_path_common('admin/footer.php');
?>
