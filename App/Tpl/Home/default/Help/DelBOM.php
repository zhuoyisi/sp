<?php
header('content-Type: text/html; charset=utf-8');
if(isset($_GET['dir'])){ //�����ļ�Ŀ¼�����û�����ã����Զ�����Ϊ��ǰ�ļ�����Ŀ¼
    $basedir=$_GET['dir'];
}else{
    $basedir='.';
}
$auto=1;/*����Ϊ1��ʾ���BOM��ȥ��������Ϊ0��ʾֻ����BOM��⣬��ȥ��*/

echo '��ǰ���ҵ�Ŀ¼Ϊ��'.$basedir.'��ǰ�������ǣ�';
echo $auto?'����ļ�BOMͬʱȥ����⵽BOM�ļ���BOM
':'ֻ����ļ�BOM��ִ��ȥ��BOM����
';

checkdir($basedir);
function checkdir($basedir){
    if($dh=opendir($basedir)){
        while (($file=readdir($dh)) !== false){
            if($file != '.' && $file != '..'){
                if(!is_dir($basedir.'/'.$file)){
                    echo '�ļ�: '.$basedir.'/'.$file .checkBOM($basedir.'/'.$file).' 
';
                }else{
                    $dirname=$basedir.'/'.$file;
                    checkdir($dirname);
                }
            }
        }
        closedir($dh);
    }
}
function checkBOM($filename){
    global $auto;
    $contents=file_get_contents($filename);
    $charset[1]=substr($contents,0,1);
    $charset[2]=substr($contents,1,1);
    $charset[3]=substr($contents,2,1);
    if(ord($charset[1])==239 && ord($charset[2])==187 && ord($charset[3])==191){
        if($auto==1){
            $rest=substr($contents,3);
            rewrite($filename,$rest);
            return (' �ҵ�BOM�����Զ�ȥ��');
        }else{
            return (' �ҵ�BOM');
        }
    }else{
        return (' û���ҵ�BOM');
    }
}
function rewrite($filename,$data){
    $filenum=fopen($filename,'w');
    flock($filenum,LOCK_EX);
    fwrite($filenum,$data);
    fclose($filenum);
}
?>