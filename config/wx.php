<?php


return [
    //  +---------------------------------
    //  微信相关配置
    //  +---------------------------------

    // 小程序app_id
//    'app_id' => 'wx34329b1a0c0ad709',
    'app_id' => 'wx1baca12ea227af36',
    // 小程序app_secret
//    'app_secret' => '10a28b1b4f80607ac9a3dec3501d2686',
    'app_secret' => '4fe1b0a4d346fd439b44a8dce129b662',

    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
//    'login_url' => "https://api.weixin.qq.com/sns/oauth2/access_token?" .
//        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    // 微信获取access_token的url地址
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s",

    'token_expire_in' => 120
];
