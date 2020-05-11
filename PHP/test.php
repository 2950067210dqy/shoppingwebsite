<?php
include_once '../lib/BmobObject.class.php';
include_once '../lib/BmobUser.class.php';
include_once '../lib/BmobBatch.class.php';
include_once '../lib/BmobFile.class.php';
include_once '../lib/BmobImage.class.php';
include_once '../lib/BmobRole.class.php';
include_once '../lib/BmobPush.class.php';
include_once '../lib/BmobPay.class.php';
include_once '../lib/BmobSms.class.php';
include_once '../lib/BmobApp.class.php';
include_once '../lib/BmobSchemas.class.php';
include_once '../lib/BmobTimestamp.class.php';
include_once '../lib/BmobCloudCode.class.php';
include_once '../lib/BmobBql.class.php';


    /*
     *  bmobObject 的例子
     */
    $bmobObj = new BmobObject("user");
    $res=$bmobObj->create(array("username"=>"game","password"=>"1234567890")); //添加对象
?>
