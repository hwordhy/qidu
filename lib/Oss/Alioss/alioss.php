<?php
USE OSS\OssClient;
USE OSS\Core\OssException;

require "autoload.php";
include_once jieqi_path_config('configs', 'system');
jieqi_loadlang("configs", "system");

Class AliUpload{

    public function __construct(){
        global $jieqiConfigs;

        $this->init();
        if ($jieqiConfigs['system']['oss']){
            try {
                $this->auth = new OssClient($this->Access_Key,$this->Secret_Key,$this->endpoint);
            } catch (OssException $e) {
                print $e->getMessage();
                return;
            }
        }
    }

    public function init(){
        global $jieqiConfigs;

        $this->Access_Key = $jieqiConfigs['system']['accesskeyid'];
        $this->Secret_Key = $jieqiConfigs['system']['accesskeysecret'];
        $this->bucket = $jieqiConfigs['system']['bucketname'];
        $this->endpoint = $jieqiConfigs['system']['endpoint'];
        $this->OssTimeout = $jieqiConfigs['system']['osstimeout'];

    }

    /**
     * 上传图片、文件接口
     * @Author
     * @DateTime  2017-03-08
     * @param string $bucket bucket name
     * @param string $object object name
     * @param string $file local file path
     * @param array $options
     * @throws OssException  [文件类型]
     * @$type 1 = 字符串 0 = 文件、图片
     */
    public function upload($dst,$src,$type = 0){
        try {
            //上传图片
            //$result  = $auth->putObject($this->bucket, $dst, $src); //上传字符串
            //$result  = $auth->uploadFile($this->bucket,$dst,$src); //上传图片、文件
            $result  = empty($type) ? $this->auth->uploadFile($this->bucket,$dst,$src) : $this->auth->putObject($this->bucket, $dst, $src);
            return $result['info']['url'];

        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
    }

    //获取文件地址
    public function ReadFile($dst){
        try {
            $signedUrl = $this->auth->signUrl($this->bucket, $dst, $this->OssTimeout);
            return $signedUrl;
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
    }

    //删除文件
    public function DelFile($dst){
        try {
            $result  = $this->auth->deleteObject($this->bucket,$dst);
            return $result;
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
    }

    //判断文件是否存在
    public function IsExist($dst){
        try {
            $result  = $this->auth->doesObjectExist($this->bucket,$dst);
            return $result;
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
    }

    //获取文件地址
    public function download($dst,$file){
        $options = array(
            OssClient::OSS_FILE_DOWNLOAD => $file
        );

        try {
            return $this->auth->getObject($this->bucket, $dst, $options);
        } catch (OssException $e) {
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
    }

}