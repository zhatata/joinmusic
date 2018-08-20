<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,viewport-fit=cover">
    <title>音乐分享平台</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/amazeui/2.3.0/css/amazeui.min.css">
    <link rel="stylesheet" href="static/css/style.css?v<?php echo MC_VERSION; ?>">
</head>
<body>
    <div class="am-g about">
        <div class="am-container am-margin-vertical-xl">
            <header class="am-padding-vertical">
                <h2 class="about-title about-color">站外音乐搜索</h2>
                <p class="am-text-center">qq音乐、网易云音乐、虾米音乐</p>
                <p class="am-text-center">三站联合搜索</p>
            </header>
            <div class="am-u-lg-12 am-padding-vertical">
                <form id="j-validator" class="am-form am-margin-bottom-lg" method="post">
                    <div class="am-u-md-12 am-u-sm-centered">
                        <div class="am-form-group">
                            <input id="j-input" data-filter="name" class="am-form-field am-input-lg am-text-center am-radius" placeholder="搜索音乐">
                        </div>
                        <div id="j-type" class="am-form-group am-text-center music-type">
                        <?php foreach ($music_type_list as $key => $val) { ?>
                            <label class="am-radio-inline">
                                <input type="radio" name="music_type" value="<?php echo $key; ?>" data-am-ucheck<?php if ($key === 'netease') echo ' checked'; ?>>
                                <?php echo $val; ?>
                            </label>
                        <?php } ?>
                        </div>
                        <button id="j-submit" type="submit" class="am-btn am-btn-primary am-btn-lg am-btn-block am-radius">搜索</button>
                    </div>
                    
                    <p class="am-info-warning">接口调用加载时间较长，请稍候或切换其他源</p>
                </form>
                <form id="j-main" class="am-form am-u-md-12 am-u-sm-centered music-main">
                    <a type="button" id="j-back" class="am-btn am-btn-primary am-btn-lg am-btn-block am-radius am-margin-bottom-lg">返回</a>
                   
                        <!--源址-->
                        <div class="am-u-lg-6">
                            <div class="am-input-group am-input-group-sm am-margin-bottom-sm">
                                <span class="am-input-group-label"><i class="am-icon-link am-icon-fw"></i></span>
                                <input id="j-link" class="am-form-field" readonly>
                                <span class="am-input-group-btn">
                                    <a id="j-link-btn" class="am-btn am-btn-default" target="_blank">
                                        <i class="am-icon-external-link"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <!--链接-->
                        <div class="am-u-lg-6">
                            <div class="am-input-group am-input-group-sm am-margin-bottom-sm">
                                <span class="am-input-group-label"><i class="am-icon-music am-icon-fw"></i></span>
                                <input id="j-src" class="am-form-field" readonly>
                                <span class="am-input-group-btn">
                                    <a id="j-src-btn" class="am-btn am-btn-default" target="_blank">
                                        <i id="j-src-btn-icon" class="am-icon-external-link"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <!--歌词-->
                        <div class="am-u-lg-6">
                            <div class="am-input-group am-input-group-sm am-margin-bottom-sm">
                                <span class="am-input-group-label"><i class="am-icon-file-text-o am-icon-fw"></i></span>
                                <input id="j-lrc" class="am-form-field" readonly>
                                <span class="am-input-group-btn">
                                    <a id="j-lrc-btn" class="am-btn am-btn-default" target="_blank">
                                        <i id="j-lrc-btn-icon" class="am-icon-external-link"></i>
                                    </a>
                                </span>
                            </div>
                        </div> 
                    <!--名称-->
                        <div class="am-u-lg-6">
                            <div class="am-input-group am-input-group-sm am-margin-bottom-sm">
                                <span class="am-input-group-label"><i class="am-icon-tag am-icon-fw"></i></span>
                                <input id="j-name" class="am-form-field" readonly>
                            </div>
                        </div>
                        <!--歌手-->
                        <div class="am-u-lg-6">
                            <div class="am-input-group am-input-group-sm am-margin-bottom-sm">
                                <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                                <input id="j-author" class="am-form-field" readonly>
                            </div>
                        </div>

                    <div id="j-show" class="am-margin-vertical">
                        <div id="j-player" class="aplayer"></div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/amazeui/2.3.0/js/amazeui.min.js"></script>
    <script src="//cdn.bootcss.com/aplayer/1.6.0/APlayer.min.js"></script>
    <script src="//cdn.bootcss.com/Base64/1.0.1/base64.min.js"></script>
    <script src="static/js/music.js?v<?php echo MC_VERSION; ?>"></script>
</body>
</html>
