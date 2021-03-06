﻿<?php
header("Content-Type: text/html;charset=utf-8");

ini_set("display_errors", "On");
error_reporting(E_ALL|E_STRICT);

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="http://cdn.aodianyun.com/static/jquery/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/player/swfobject.js"></script>
</head>
<body style="overflow:hidden;padding:0px;margin:0px;background-color:white;">
    <div id="playerView"></div>
    <script type="text/javascript">
    function getQueryStr(str) {
        var LocString = String(window.document.location.href);
        var rs = new RegExp("(^|)" + str + "=([^&]*)(&|$)", "gi").exec(LocString), tmp;
        if (tmp = rs) {
            return tmp[2];
        }
        return "";
    }
    var init_ok = false;
    var lssAddr = decodeURIComponent(getQueryStr("addr"));
    var lssApp = getQueryStr("app");
    var lssStream = getQueryStr("stream");
    var mode = getQueryStr("mode");
    var volume = parseInt(getQueryStr("volume"));
    console.log("playing:", location.href);
    var width = 276;
    var height = 190;
    var swfVersionStr = "11.0.0";
    var xiSwfUrlStr = "js/player/playerProductInstall.swf";
    var flashvars = {
        url: lssAddr + "/" + lssApp,
        stream: lssStream,
        mode: mode,
        bStart: true,
        volume: volume/100.0,      /* 0 - 1 */
        notifyId: "micPlayer",
        onInit: function (notifyId) {
            init_ok = true;
        }/*,
        onRtmpEvent: function (e, notifyId) {
            //console.log(e, notifyId);
        },
        onClickEvent: function (notifyId) {
            //console.log("onClickEvent...", notifyId);
        }*/
    };
    if (mode == "publish") {
        flashvars.camIndex = -1;           //摄像头索引
        flashvars.micIndex = -1;           //麦克风索引
        flashvars.camWidth = 320;          //摄像头宽
        flashvars.camHeight = 180;         //摄像头高
        flashvars.camFps = 10;             //摄像头采集帧率
        flashvars.keyFrameInterval = 10;    //关键帧间隔
        flashvars.videoByteRate = 20480;    //视频码率，单位字节每秒
        flashvars.videoQuality = 80;        //视频质量 1-100
        flashvars.audioSampleRate = 44;     //音频采样率，单位KHz  可以为5,8,11,22,44
        flashvars.noVideo = true; //没有视频
    }
    var params = {};
    params.quality = "high";
    params.bgcolor = "#000000";
    params.allowscriptaccess = "always";
    params.allowfullscreen = "true";
    params.wmode = "Opaque";
    var attributes = {};
    attributes.id = "player";
    attributes.name = "player";
    attributes.align = "middle";
    swfobject.embedSWF(
        "js/player/player.swf", "playerView",
        width, height,
        swfVersionStr, xiSwfUrlStr,
        flashvars, params, attributes);
    swfobject.createCSS("#playerView", "display:block;text-align:left;");
    function setVolume(volume) {
        var player = document.getElementById('player');
        if (init_ok) {
            player.SetVolume(volume/100.0);
        }
    }
    </script>
</body>
</html>