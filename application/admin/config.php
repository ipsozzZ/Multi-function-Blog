<?php
//配置文件
return [
    'view_replace_str'   =>[
        // 因为网站的本地服务器根目录是指向public，“/static/admin”就是指public下的static下的admin目录
        '__ADMIN__'=>'/static/admin',
    ],
];