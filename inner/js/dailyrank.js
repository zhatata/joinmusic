$(function(){
	var ulhtml = '<div class="song-header"></div>';

	let url = 'https://c.y.qq.com/v8/fcg-bin/fcg_v8_toplist_cp.fcg?g_tk=5381&uin=0&format=json&inCharset=utf-8&outCharset=utf-8&notice=0&platform=h5&needNewCode=1&tpl=3&page=detail&type=top&topid=27&_=1519963122923';
    $.ajax({
        url:url,
        type:"get",
        dataType:'jsonp',
        jsonp: "jsonpCallback",
        scriptCharset: 'GBK',//解决中文乱码
        success: function(data){
        	$(data.songlist).each(function(index, ele)
        	{
        		if (index < 20) 
        		{
        			var rank = index + 1;
        			var songmid = this.data.songmid;
        			var songname = this.data.songname;
        			var singer= this.data.singer[0].name;
        			var albumname = this.data.albumname;
        			var link = '"https://y.qq.com/n/yqq/song/'+songmid+'.html#stat=y_new.index.new_song.songname"';
        			var lihtml = '<div class="rankitem"><a href='+link+' class="rankitem-link"><div class="ranklevel"><span>'+rank+'</span><span>'+songname+'</span></div><div class="rank-songinfo"><span>'+singer+'</span><span>'+albumname+'</span></div></a></div>';
        			ulhtml = ulhtml + lihtml;
        			console.log(index,albumname,singer,songmid,link);
        		}

        		$("body").html(ulhtml);
        	});

        },
        error:function (e) {
        console.log('error');
        }
    });
})