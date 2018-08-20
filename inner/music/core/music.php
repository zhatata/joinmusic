<?php

if (!defined('IN_TG')) {
    header("Location: /");
    exit();
}

// 显示 PHP 错误报告
error_reporting(MC_DEBUG);

// 引入 Curl
require CORE_DIR . '/vendor/autoload.php';

// 使用 Curl
use \Curl\Curl;

// Curl 内容获取
function mc_curl($args = [])
{
    $default = [
        'method'     => 'GET',
        'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.50 Safari/537.36',
        'url'        => null,
        'referer'    => 'https://www.google.co.uk',
        'headers'    => null,
        'body'       => null,
        'proxy'      => false
    ];
    $args         = array_merge($default, $args);
    $method       = mb_strtolower($args['method']);
    $method_allow = ['get', 'post'];
    if (null === $args['url'] || !in_array($method, $method_allow, true)) {
        return;
    }
    $curl = new Curl();
    $curl->setUserAgent($args['user-agent']);
    $curl->setReferrer($args['referer']);
    $curl->setTimeout(15);
    $curl->setHeader('X-Requested-With', 'XMLHttpRequest');
    $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
    if ($args['proxy'] && MC_PROXY) {
        $curl->setOpt(CURLOPT_HTTPPROXYTUNNEL, 1);
        $curl->setOpt(CURLOPT_PROXY, MC_PROXY);
        $curl->setOpt(CURLOPT_PROXYUSERPWD, MC_PROXYUSERPWD);
    }
    if (!empty($args['headers'])) {
        $curl->setHeaders($args['headers']);
    }
    $curl->$method($args['url'], $args['body']);
    $curl->close();
    if (!$curl->error) {
        return $curl->rawResponse;
    }
}

// 判断地址是否有误
function mc_is_error($url) {
    $curl = new Curl();
    $curl->setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.50 Safari/537.36');
    $curl->head($url);
    $curl->close();
    return $curl->errorCode;
}

// 音频数据接口地址
function mc_song_urls($value, $type = 'query', $site = 'netease', $page = 1)
{
    if (!$value) {
        return;
    }
    $query             = ('query' === $type) ? $value : '';
    $songid            = ('songid' === $type || 'lrc' === $type) ? $value : '';
    $radio_search_urls = [
        'netease'            => [
            'method'         => 'POST',
            'url'            => 'http://music.163.com/api/linux/forward',
            'referer'        => 'http://music.163.com/',
            'proxy'          => false,
            'body'           => encode_netease_data([
                'method'     => 'POST',
                'url'        => 'http://music.163.com/api/cloudsearch/pc',
                'params'     => [
                    's'      => $query,
                    'type'   => 1,
                    'offset' => $page * 10 - 10,
                    'limit'  => 10
                ]
            ])
        ],
        'qq'                 => [
            'method'         => 'GET',
            'url'            => 'http://c.y.qq.com/soso/fcgi-bin/search_for_qq_cp',
            'referer'        => 'http://m.y.qq.com',
            'proxy'          => false,
            'body'           => [
                'w'          => $query,
                'p'          => $page,
                'n'          => 10,
                'format'     => 'json'
            ],
            'user-agent'     => 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1'
        ],
        'xiami'              => [
            'method'         => 'GET',
            'url'            => 'http://api.xiami.com/web',
            'referer'        => 'http://m.xiami.com',
            'proxy'          => false,
            'body'           => [
                'key'        => $query,
                'v'          => '2.0',
                'app_key'    => '1',
                'r'          => 'search/songs',
                'page'       => $page,
                'limit'      => 10
            ],
            'user-agent'     => 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1'
        ]
    ];
    $radio_song_urls = [
        'netease'           => [
            'method'        => 'POST',
            'url'           => 'http://music.163.com/api/linux/forward',
            'referer'       => 'http://music.163.com/',
            'proxy'         => false,
            'body'          => encode_netease_data([
                'method'    => 'GET',
                'url'       => 'http://music.163.com/api/song/detail',
                'params'    => [
                  'id'      => $songid,
                  'ids'     => '[' . $songid . ']'
                ]
            ])
        ],
        'qq'                => [
            'method'        => 'GET',
            'url'           => 'http://c.y.qq.com/v8/fcg-bin/fcg_play_single_song.fcg',
            'referer'       => 'http://m.y.qq.com',
            'proxy'         => false,
            'body'          => [
                'songmid'   => $songid,
                'format'    => 'json'
            ],
            'user-agent'    => 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1'
        ],
        'xiami'             => [
            'method'        => 'GET',
            'url'           => 'http://www.xiami.com/song/playlist/id/' . $songid . '/type/0/cat/json',
            'referer'       => 'http://www.xiami.com',
            'proxy'         => false
        ]
    ];
    $radio_lrc_urls = [
        'netease'           => [
            'method'        => 'POST',
            'url'           => 'http://music.163.com/api/linux/forward',
            'referer'       => 'http://music.163.com/',
            'proxy'         => false,
            'body'          => encode_netease_data([
                'method'    => 'GET',
                'url'       => 'http://music.163.com/api/song/lyric',
                'params'    => [
                  'id' => $songid,
                  'lv' => 1
                ]
            ])
        ],
        'qq'                => [
            'method'        => 'GET',
            'url'           => 'http://c.y.qq.com/lyric/fcgi-bin/fcg_query_lyric.fcg',
            'referer'       => 'http://m.y.qq.com',
            'proxy'         => false,
            'body'          => [
                'songmid'   => $songid,
                'format'    => 'json',
                'nobase64'  => 1,
                'songtype'  => 0,
                'callback'  => 'c'
            ],
            'user-agent'    => 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1'
        ],
        'xiami'             => [
            'method'        => 'GET',
            'url'           => $songid,
            'referer'       => 'http://www.xiami.com',
            'proxy'         => false
        ]
    ];
    if ('query' === $type) {
        return $radio_search_urls[$site];
    }
    if ('songid' === $type) {
        return $radio_song_urls[$site];
    }
    if ('lrc' === $type) {
        return $radio_lrc_urls[$site];
    }
    return;
}

// 获取音频信息 - 关键词搜索
function mc_get_song_by_name($query, $site = 'netease', $page = 1)
{
    if (!$query) {
        return;
    }
    $radio_search_url = mc_song_urls($query, 'query', $site, $page);
    if (empty($query) || empty($radio_search_url)) {
        return;
    }
    $radio_result = mc_curl($radio_search_url);
    if (empty($radio_result)) {
        return;
    }
    $radio_songid = [];
    switch ($site) {
        case 'qq':
            $radio_data = json_decode($radio_result, true);
            if (empty($radio_data['data']) || empty($radio_data['data']['song']) || empty($radio_data['data']['song']['list'])) {
                return;
            }
            foreach ($radio_data['data']['song']['list'] as $val) {
                $radio_songid[] = $val['songmid'];
            }
            break;
        case 'xiami':
            $radio_data = json_decode($radio_result, true);
            if (empty($radio_data['data']) || empty($radio_data['data']['songs'])) {
                return;
            }
            foreach ($radio_data['data']['songs'] as $val) {
                $radio_songid[] = $val['song_id'];
            }
            break;
        case 'netease':
        default:
            $radio_data = json_decode($radio_result, true);
            if (empty($radio_data['result']) || empty($radio_data['result']['songs'])) {
                return;
            }
            foreach ($radio_data['result']['songs'] as $val) {
                $radio_songid[] = $val['id'];
            }
            break;
    }
    return mc_get_song_by_id($radio_songid, $site, true);
}

// 获取音频信息 - 歌曲ID
function mc_get_song_by_id($songid, $site = 'netease', $multi = false)
{
    if (empty($songid) || empty($site)) {
        return;
    }
    $radio_song_urls = [];
    $site_allow_multiple = [
        'netease',
        'qq',
        'xiami'
    ];
    if ($multi) {
        if (!is_array($songid)) {
            return;
        }
        if (in_array($site, $site_allow_multiple, true)) {
            $radio_song_urls[] = mc_song_urls(implode(',', $songid), 'songid', $site);
        } else {
            foreach ($songid as $key => $val) {
                $radio_song_urls[] = mc_song_urls($val, 'songid', $site);
            }
        }
    } else {
        $radio_song_urls[] = mc_song_urls($songid, 'songid', $site);
    }
    if (empty($radio_song_urls) || !array_key_exists(0, $radio_song_urls)) {
        return;
    }
    $radio_result = [];
    foreach ($radio_song_urls as $key => $val) {
        $radio_result[] = mc_curl($val);
    }
    if (empty($radio_result) || !array_key_exists(0, $radio_result)) {
        return;
    }
    $radio_songs = [];
    switch ($site) {
        case 'qq':
            $radio_vkey = json_decode(mc_curl([
                'method'     => 'GET',
                'url'        => 'http://base.music.qq.com/fcgi-bin/fcg_musicexpress.fcg',
                'referer'    => 'http://y.qq.com',
                'proxy'      => false,
                'body'       => [
                    'json'   => 3,
                    'guid'   => 5150825362,
                    'format' => 'json'
                ]
            ]), true);
            foreach ($radio_result as $val) {
                $radio_json                  = json_decode($val, true);
                $radio_data                  = $radio_json['data'];
                $radio_url                   = $radio_json['url'];
                if (!empty($radio_data) && !empty($radio_url)) {
                    foreach ($radio_data as $value) {
                        $radio_song_id       = $value['mid'];
                        $radio_authors       = [];
                        foreach ($value['singer'] as $singer) {
                            $radio_authors[] = $singer['title'];
                        }
                        $radio_author        = implode(',', $radio_authors);
                        $radio_lrc_urls      = mc_song_urls($radio_song_id, 'lrc', $site);
                        if ($radio_lrc_urls) {
                            $radio_lrc       = jsonp2json(mc_curl($radio_lrc_urls));
                        }
                        if (!empty($radio_vkey['key'])) {
                            $radio_music     = generate_qqmusic_url($radio_song_id, $radio_vkey['key']);
                        } else {
                            $radio_music     = 'http://' . str_replace('ws', 'dl', $radio_url[$value['id']]);
                        }
                        $radio_album_id      = $value['album']['mid'];
                        $radio_songs[]       = [
                            'type'   => 'qq',
                            'link'   => 'http://y.qq.com/n/yqq/song/' . $radio_song_id . '.html',
                            'songid' => $radio_song_id,
                            'title'  => $value['title'],
                            'author' => $radio_author,
                            'lrc'    => str_decode($radio_lrc['lyric']),
                            'url'    => $radio_music,
                            'pic'    => 'http://y.gtimg.cn/music/photo_new/T002R300x300M000' . $radio_album_id . '.jpg'
                        ];
                    }
                }
            }
            break;
        case 'xiami':
            foreach ($radio_result as $val) {
                $radio_json                 = json_decode($val, true);
                $radio_data                 = $radio_json['data']['trackList'];
                if (!empty($radio_data)) {
                    foreach ($radio_data as $value) {
                        $radio_lrc          = '';
                        $radio_song_id      = $value['songId'];
                        if ($value['lyric']) {
                            $radio_lrc_urls = mc_song_urls($value['lyric'], 'lrc', $site);
                            if ($radio_lrc_urls) {
                                $radio_lrc  = mc_curl($radio_lrc_urls);
                            }
                        }
                        $radio_songs[]      = [
                            'type'   => 'xiami',
                            'link'   => 'http://www.xiami.com/song/' . $radio_song_id,
                            'songid' => $radio_song_id,
                            'title'  => $value['songName'],
                            'author' => $value['singers'],
                            'lrc'    => $radio_lrc,
                            'url'    => decode_xiami_location($value['location']),
                            'pic'    => $value['album_pic']
                        ];
                    }
                } else {
                    if ($radio_json['message']) {
                        $radio_songs        = [
                            'error' => $radio_json['message'],
                            'code' => 403
                        ];
                        break;
                    }
                }
            }
            break;
        case 'netease':
        default:
            foreach ($radio_result as $val) {
                $radio_json                  = json_decode($val, true);
                $radio_data                  = $radio_json['songs'];
                if (!empty($radio_data)) {
                    foreach ($radio_data as $value) {
                        $radio_song_id       = $value['id'];
                        $radio_authors       = [];
                        foreach ($value['artists'] as $key => $val) {
                            $radio_authors[] = $val['name'];
                        }
                        $radio_author        = implode(',', $radio_authors);
                        $radio_lrc_urls      = mc_song_urls($radio_song_id, 'lrc', $site);
                        if ($radio_lrc_urls) {
                            $radio_lrc       = json_decode(mc_curl($radio_lrc_urls), true);
                        }
                        $radio_songs[]       = [
                            'type'   => 'netease',
                            'link'   => 'http://music.163.com/#/song?id=' . $radio_song_id,
                            'songid' => $radio_song_id,
                            'title'  => $value['name'],
                            'author' => $radio_author,
                            'lrc'    => !empty($radio_lrc['lrc']) ? $radio_lrc['lrc']['lyric'] : '',
                            'url'    => 'http://music.163.com/song/media/outer/url?id=' . $radio_song_id . '.mp3',
                            'pic'    => $value['album']['picUrl'] . '?param=300x300'
                        ];
                    }
                }
            }
            break;
    }
    return !empty($radio_songs) ? $radio_songs : '';
}

// 获取音频信息 - url
function mc_get_song_by_url($url)
{
    preg_match('/music\.163\.com\/(#(\/m)?|m)\/song(\?id=|\/)(\d+)/i', $url, $match_netease);
    preg_match('/(y\.qq\.com\/n\/yqq\/song\/|data\.music\.qq\.com\/playsong\.html\?songmid=)([a-zA-Z0-9]+)/i', $url, $match_qq);
    preg_match('/(www|m)\.xiami\.com\/song\/([a-zA-Z0-9]+)/i', $url, $match_xiami);

    if (!empty($match_netease)) {
        $songid   = $match_netease[4];
        $songtype = 'netease';
    } elseif (!empty($match_qq)) {
        $songid   = $match_qq[2];
        $songtype = 'qq';
    } elseif (!empty($match_xiami)) {
        $songid   = $match_xiami[2];
        $songtype = 'xiami';
    } else {
        return;
    }
    return mc_get_song_by_id($songid, $songtype);
}

// 解密虾米 location
function decode_xiami_location($location)
{
    $location     = trim($location);
    $result       = [];
    $line         = intval($location[0]);
    $locLen       = strlen($location);
    $rows         = intval(($locLen - 1) / $line);
    $extra        = ($locLen - 1) % $line;
    $location     = substr($location, 1);
    for ($i       = 0; $i < $extra; ++$i) {
        $start    = ($rows + 1) * $i;
        $end      = ($rows + 1) * ($i + 1);
        $result[] = substr($location, $start, $end - $start);
    }
    for ($i       = 0; $i < $line - $extra; ++$i) {
        $start    = ($rows + 1) * $extra + ($rows * $i);
        $end      = ($rows + 1) * $extra + ($rows * $i) + $rows;
        $result[] = substr($location, $start, $end - $start);
    }
    $url          = '';
    for ($i       = 0; $i < $rows + 1; ++$i) {
        for ($j   = 0; $j < $line; ++$j) {
            if ($j >= count($result) || $i >= strlen($result[$j])) {
                continue;
            }
            $url .= $result[$j][$i];
        }
    }
    $url          = urldecode($url);
    $url          = str_replace('^', '0', $url);
    return $url;
}

// 加密网易云音乐 api 参数
function encode_netease_data($data)
{
    $_key     = '7246674226682325323F5E6544673A51';
    $data     = json_encode($data);
    if (function_exists('openssl_encrypt')) {
        $data = openssl_encrypt($data, 'aes-128-ecb', pack('H*', $_key));
    } else {
        $_pad = 16 - (strlen($data) % 16);
        $data = base64_encode(mcrypt_encrypt(
            MCRYPT_RIJNDAEL_128,
            hex2bin($_key),
            $data.str_repeat(chr($_pad), $_pad),
            MCRYPT_MODE_ECB
        ));
    }
    $data     = strtoupper(bin2hex(base64_decode($data)));
    return ['eparams' => $data];
}

// 分割 songid 并获取
function split_songid($songid, $index = 0, $delimiter = '|') {
    if (mb_strpos($songid, $delimiter, 0, 'UTF-8') > 0) {
        $array = explode($delimiter, $songid);
        if (count($array) > 1) {
            return $array[$index];
        }
    }
    return;
}

// 生成 QQ 音乐各品质链接
function generate_qqmusic_url($songmid, $key) {
    $quality = array('M800', 'M500', 'C400');
    foreach ($quality as $value) {
        $url = 'http://dl.stream.qqmusic.qq.com/' . $value . $songmid . '.mp3?vkey=' . $key . '&guid=5150825362&fromtag=1';
        if (!mc_is_error($url)) {
            return $url;
        }
    }
}

// 生成酷我音乐歌词
/*function generate_kuwo_lrc($lrclist) {
    if (!empty($lrclist)) {
        $lrc = '';
        foreach ($lrclist as $val) {
            if ($val['time'] > 60) {
                $time_exp = explode('.', round($val['time'] / 60, 4));
                $minute = $time_exp[0] < 10 ? '0' . $time_exp[0] : $time_exp[0];
                $sec = substr($time_exp[1], 0, 2) . '.' . substr($time_exp[1], 2, 2);
                $time = '[' . $minute . ':' . $sec . ']';
            } else {
                $time = '[00:' . $val['time'] . ']';
            }
            $lrc .= $time . $val['lineLyric'] . "\n";
        }
        return $lrc;
    }
}*/

// jsonp 转 json
function jsonp2json($jsonp) {
    if ($jsonp[0] !== '[' && $jsonp[0] !== '{') {
        $jsonp = mb_substr($jsonp, mb_strpos($jsonp, '('));
    }
    $json = trim($jsonp, "();");
    if ($json) {
        return json_decode($json, true);
    }
}

// 去除字符串转义
function str_decode($str) {
    $str = str_replace(['&#13;', '&#10;'], ['', "\n"], $str);
    $str = html_entity_decode($str, ENT_QUOTES, 'UTF-8');
    return $str;
}

// Server
function server($key)
{
    return isset($_SERVER[$key]) ? $_SERVER[$key] : null;
}

// Post
function post($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : null;
}

// Response
function response($data, $code = 200, $error = '')
{
    header('Content-type:text/json; charset=utf-8');
    echo json_encode(array(
        'data'  => $data,
        'code'  => $code,
        'error' => $error
    ));
    exit();
}
