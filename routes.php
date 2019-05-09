<?php
    $controllers = array(
        'pages' => ['home','error'],
        'users' => ['index','findById','render_updateInformation','updateInformation'],
        'account' => ['index','registerAccount','render_login','loginAccount','logout','render_changePassword','changePassword'],
        'words' => ['index','render_addWord','addWord','makeTest','getDetail','render_updateWord','updateWord','deleteWord','learn','getQuestion']
    ); //list of controllers

    if(!array_key_exists($controller,$controllers) || 
    !in_array($action,$controllers[$controller])){
        $controller = 'pages';
    }
    /*
    Hàm in_array() trong php dùng để kiểm tra giá trị nào đó 
    có tồn tại trong mảng hay không. Nếu như tồn tại thì nó sẽ trả về
    TRUE và ngược lại sẽ trả về FALSE.
    */

    include_once('controllers/' . $controller . '_controller.php');
    
    $klass = str_replace('_','',ucwords($controller,'_')) . 'Controller';
    
    $controller = new $klass;
    $controller->$action();
?>