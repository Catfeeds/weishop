function my_timealert(data,callBack,time){
    var json={
        "content":data?data:"警告",
        "time":time?time:1200
    }
    // $.extend(json,data)
    $("body").append('<div class="mydark my_confirm"></div><div class="mydive_1 my_confirm"><div class="mytime"><div class="mycircle "><i class="fa fa-exclamation"></i></div><div class="mycontent0">'+json.content+'</div></div></div>');
    setTimeout(function() {
        my_close();
        if(callBack){
           callBack();
        }
    }, json.time);
}
function my_close(){
    $(".my_confirm").remove()
}
function my_confirm(data,callBack){
    var json={
        "content":"提示",
        "bn1":"取消",
        "bn2":"确定"
    }
    $.extend(json,data)
    $("body").append('<div class="mydark my_confirm"></div><div class="mydive_1 my_confirm"><div class="mytangchuang"><div class="mycircle "><i class="fa fa-exclamation"></i></div><div class="mycontent2">'+json.content+'</div><div class="bn1" onclick="my_close()">'+json.bn1+'</div><div class="bn2" onclick="my_close(),'+callBack+'">'+json.bn2+'</div></div></div>');

}

function strtotime(p_time){
  var a = p_time*1000;
  var a=new Date(a);
  var c;
  var date=a.getDate();
  var month=a.getMonth()+1;
  var Hour=a.getHours();
  var Minutes=a.getMinutes();
  var Seconds=a.getSeconds();
  Hour=add_0(Hour);
  Minutes=add_0(Minutes);
  Seconds=add_0(Seconds);
  month=add_0(month);
  date=add_0(date);
  c=a.getFullYear()+"-"+month+"-"+date+"    "+Hour+":"+Minutes+":"+Seconds;
  return c;
}
//时间加零
function add_0(num){
    if(num<10){
      return "0"+num
    }else{
      return num
    }
}

function cutstr(str,len)
{
    var str_length = 0;
    var str_len = 0;
    var str_cut = '';
    str_len = str.length;
    for(var i = 0;i<str_len;i++)
    {
        a = str.charAt(i);
        str_length++;
        if(escape(a).length > 4)
        {
        //中文字符的长度经编码之后大于4
            str_length++;
        }
        str_cut = str_cut.concat(a);
        if(str_length>=len)
        {
            str_cut = str_cut.concat("...");
            return str_cut;
        }
    }
    //如果给定字符串小于指定长度，则返回源字符串；
    if(str_length<len){
        return  str;
    }
}



// 微信配置
