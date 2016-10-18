<?php
/**
 * @name Define.php
 * @desc 
 * @author huangpeng
 * @date 2016/8/18 13:56
 */

class Ald_Const_Define {
    const LOGIN_URL = 'http://10.0.1.209:8020/user/pass/login?referer='; //未登陆则跳到此登陆页
    const LOGIN_CHECK = 'http://10.0.1.209:8020/user/api/checklogin'; //pass提供的检查登陆状态页
    
    //平台定义
    const PLATFORM_USER = 1; //用户
    const PLATFORM_TASK = 2; //5A任务
    const PLATFORM_BANG = 3; //5A帮
    const PATTFORM_ZHAOPIN = 4; //5A招聘

    //账户操作类型
    const ACCOUNT_OPERATE_CHARGE = 1; //充值
    const ACCOUNT_OPERATE_WITHDRAW = 2; //提现
    const ACCOUNT_OPERATE_INCOME = 3; //收入
    const ACCOUNT_OPERATE_COST = 4; //支出
    const ACCOUNT_OPERATE_TRANSIN = 5; //转入
    const ACCOUNT_OPERATE_TRANSOUT = 6; //转出

    public static $constellations = array(
        '水瓶座',
        '双鱼座',
        '白羊座',
        '金牛座',
        '双子座',
        '巨蟹座',
        '狮子座',
        '处女座',
        '天秤座',
        '天蝎座',
        '射手座',
        '摩羯座'
    );

    public static $blood_types = array(
        'A',
        'B,',
        'O',
        'AB'
    );

} 
