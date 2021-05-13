<?php
define("JIEQI_MODULE_NAME", "system");
require_once("global.php");

                 {?if $jieqi_userid ==0?} 
                 <span class="right fr">
						$wgUser=1;
				 	{?else?}
      					$wgUser=0;
                  {?/if?}    


if($wgUser->getId()==0){
    $return=array(
    'code'=>1,
    'reload_page'=>0
    );
}else{
    $mwuser->logout();
    $return=array(
    'code'=>1,
    'reload_page'=>1
    );
}

?>