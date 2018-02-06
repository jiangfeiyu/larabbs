<?php
/**
 * Copyright (C) 2018 Baidu, Inc. All Rights Reserved.
 */
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/6
 * Time: 17:40
 */

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
