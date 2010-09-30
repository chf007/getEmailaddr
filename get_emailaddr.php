<?php
/**
 * 用来获取页面上的E-amil地址
 * version: 1.0.1
 * author: Scarecrow chf007server@gmail.com 2010/3/1 15:18
 */

$time_start = getmicrotime();

function getmicrotime(){
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}

$url = $_GET['url'];
$separator = $_GET['separator'];
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//在需要用户检测的网页里需要增加下面两行
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//curl_setopt($ch, CURLOPT_USERPWD, US_NAME.":".US_PWD);
$contents = curl_exec($ch);
curl_close($ch);
//$regex[email] = "([a-z0-9_\-]+)@([a-z0-9_\-]+\.[a-z0-9\-\._\-]+)";
preg_match_all('/[\w.%-]+@[\w.-]+\.[a-z]{2,4}/i', $contents, $emailaddr);
//echo phpinfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="网页邮箱地址收集 邀请码分享工具" />
    <meta name="description" content="这是一个用来收集网页上有用的电子邮件地址的小工具，基于PHP+Curl开发，最初用来为豆瓣用户分享邀请码所用，现在已经成为网络上收集在线邮件地址最常用的小工具" />
    <meta name="robots" content="all" />
    <meta name="author" content="Scarecrow" />
    <meta name="Copyright" content="Copyright szns.org All Rights Reserved." />
    <title>在线邮件地址收集器 Get E-mail Address</title>
    <link href="/styles/reset.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/styles/grid.css" rel="stylesheet" type="text/css" media="all" />
    <style type="text/css">
    @charset "utf-8";

    /* 公用样式 */
    body { background:#fff; background-attachment:fixed; color:#000; font-family: Arial, Tahoma, sans-serif; font-size: 12px; letter-spacing: 1px; /* font-weight: 300; */ font-style: normal; min-width: 960px;}
    a { text-decoration:none;}
    a:hover, a:focus { }
    h1 { font-size: 30px;}
    h2 { font-size: 24px;}
    h3 { font-size: 22px;}
    h4 { font-size: 18px;}
    h5 { font-size: 16px;}
    h6 { font-size: 14px;}

    /* 针对不持JavaScript脚本和使用IE6的提示信息样式 */
    #upgrade_ie { height:30px; background-color:#fff298; text-align:center; color:#e62424; border:#ecd852 1px solid; margin:5px;;}
    #upgrade_ie p { padding-top:5px; margin:0; color:#e62424;}
    #upgrade_ie p a { color:#553e00;}
    #upgrade_ie p strong { color:#e62424;}

    /* 主体样式 */
    #wrapper { margin:0; padding:0;}
    #header { margin-top:10px;}
    #navbar ul { float:left; display:inline;}
    #navbar ul li { float:left; padding:5px;}

    .nav_show { display:none; padding-left:20px;}
    .nav_change { display:block;}
    input, textarea { border: 1px solid #666; margin:5px 0;}
    .submit { border-color:#b0b0b0; background:#3d3d3d; color:#fff; font:12px Arial,Tahoma;}

    #url { width:550px;}
    #separator { width:15px;}
    #emailaddr { width:100%}

    #footer { text-align:left;}
    .google_ad { text-align:center;}

    </style>
</head>
<body>
    <!--
    用来获取页面上的E-amil地址
    version: 1.0.1
    author: Scarecrow chf007server@gmail.com 2010/3/1 15:18
    -->
    <noscript>
    <div id="noscript">系统检测到您的浏览器不支持 JavaScript 脚本语言。本系统有部分功能需要您启用浏览器的 JavaScript 功能，以使您获得良好的网站访问体验。谢谢您的支持！<a href="error.php?error_id=9005" title="JavaScript启用方法">JavaScript启用方法</a></div>
    </noscript>
    <!--[if lte IE 6]>
    <div id="upgrade_ie">
        <p><strong>WARNING: You are using Internet Explorer 6.</strong> Please upgrade to the newer, safer <a href="http://www.microsoft.com/windows/internet-explorer/">Internet Explorer 8</a> or <a href="http://www.firefox.com/">Mozilla Firefox 3.5</a> for the best experience.</p>
        <p><strong>警告: 系统检测到您正在使用 Internet Explorer 6 浏览器访问本站.</strong> 为使您在访问本站时获得更良好的体验，建议您将浏览器升级到更新、更安全的版本： <a href="http://www.microsoft.com/windows/internet-explorer/">Internet Explorer 8</a> 或者使用 <a href="http://www.firefox.com/">Mozilla Firefox 3.5</a>。</p>
    </div>
    <![endif]-->
    <!-- 针对不支持JavaScript脚本和使用该死的微软IE6以下版本的浏览器的提示语 Scarecrow 2009/12/25 -->
    <div id="wrapper">
        <div id="header" class="container_12 clearfix">
            <h2>在线邮件地址收集器 Get E-mail Address v1.0.1 最后更改 2010/4/24</h2>
        </div>
        <div id="navbar" class="container_12 clearfix">
            <ul>
                <li><a id="usage" href="#" title="使用方法">使用方法</a></li>
                <li><a id="update" href="#" title="更新日志">更新日志</a></li>
            </ul>
        </div>
        <div id ="nav_usage" class="container_12 clearfix nav_show">
            <ul>
                <li>在 页面地址 栏里输入想要获取E-mail地址列表的页面URL地址</li>
                <li>在 分隔符 栏里输入分隔符以分隔多个邮件地址，如分号、逗号等。为空时，一个邮箱地址一行</li>
                <li>点击 GO 按钮，获取页面上的邮箱地址</li>
            </ul>
        </div>
        <div id="nav_update" class="container_12 clearfix nav_show">
            <ul>
                <li>2010-7-29 发布1.0.2版本 增加了一些SEO的功能</li>
                <li>2010-4-24 发布1.0.1版本 增加了一些提高用户体验的功能，如提示等 感谢cookie的JavaScript支持</li>
                <li>2010-3-1 发布1.0.0版本 实现了抓取页面邮箱地址的基本功能</li>
            </ul>
        </div>
        <div id="content" class="container_12 clearfix">
            <div class="container_12 clearfix">
                <form action="" method="get">
                    <label for="url">页面地址:</label>
                    <input id="url" name="url" value="" type="text" />
                    <label for="separator">分隔符:</label>
                    <input id="separator" name="separator" value="" type="text" />
                    <input class="submit" value="GO" type="submit" />
                </form>
                <a href="<?php echo $url;?>"><?php echo $url;?></a> 页面的邮件地址，你可以粘贴下列邮件地址并发送邮件
            </div>
            <div class="grid_9 alpha">
                <textarea rows="30" id="emailaddr"><?php
                    if(empty($separator)) {
                        $separator = "\n";
                    }
                    foreach($emailaddr as $emailaddr_arr) {
                        foreach($emailaddr_arr as $key) {
                            echo $key.$separator;
                        }
                    }
                ?></textarea>
            </div>
            <div class="grid_3 omega">
                <!-- Google AdSense begin -->
                <script type="text/javascript">
                    google_ad_client = "pub-5929309569506960";
                    /* 120x240, 创建于 10-7-25 */
                    google_ad_slot = "1932290176";
                    google_ad_width = 120;
                    google_ad_height = 240;
                </script>
                <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                </div>
        </div>
        <div id="footer" class="container_12 clearfix">
            <?php $time_end = getmicrotime();?>
            Copyright &copy; 2010 <a href="http://www.szns.org/" title="访问Scarecrow的网站">Scarecrow</a> All Rights Reserved. <script type="text/javascript" src="http://js.tongji.linezing.com/1504476/tongji.js"></script><noscript><a href="http://www.linezing.com"><img src="http://img.tongji.linezing.com/1504476/tongji.gif"/></a></noscript> <?php printf ("Processed in: %.5f second(s)",($time_end - $time_start));?>
        </div>
    </div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			$("#usage").click(function(){
				$("#nav_update").hide();
				$("#nav_usage").slideToggle("slow");

			});
			$("#update").click(function(){
				$("#nav_usage").hide();
				$("#nav_update").slideToggle("slow");

			});
		});
//        $(function(){
//            var clicked = 0;
//            $(document).click(function(e){
//                //e.preventDefault();
//                var el = e.target;
//                $id = $(el).attr("id");
//                if($id == "usage"){
//                    if(clicked == $id){
//                        $("#nav_"+$id).hide();
//                        clicked = 0;
//                    }else{
//                        $(".nav_show").hide();
//                        $("#nav_"+$id).show();
//                        clicked = $id;
//                    }
//                }else if($id == "update"){
//                    if(clicked == $id){
//                        $("#nav_"+$id).hide();
//                        clicked = 0;
//                    }else{
//                        $(".nav_show").hide();
//                        $("#nav_"+$id).show();
//                        clicked = $id;
//                    }
//                }else{
//                    $(".nav_show").hide();
//                    clicked = 0;
//                }
//                //alert($(e.target).attr("id"));
//            });
//            var defaultValue = "请输入一个含有E-mail地址的网址，例如 http://www.douban.com/group/topic/10094846/";
//
//            $("#url").val(defaultValue);
//
//            $("#url").focus(function(){
//               if($(this).val() != defaultValue){
//                 return;
//               }
//               $(this).val("");
//            });
//
//            $("#url").blur(function(){
//                if($(this).val() != "" && $(this).val() != defaultValue){
//                    return;
//                }
//                $(this).val(defaultValue);
//            });
//
//        })

    </script>
    <!-- Google统计 begin -->
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17821497-1']);
      _gaq.push(['_setDomainName', '.szns.org']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
    <!-- Google统计 end -->
</body>
</html>