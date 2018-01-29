 var yyxkey=true
function yyxcomfirm (callback,Body,Header) {
	 if(yyxkey){
	 	   yyxkey=false
		Body?Body=Body:Body="您确定删除该条纪录？"
		Header?Header=Header:Header="删除提醒"
		var html='<div id="yyxcomfirm" class="modal in " style="top:-175px;opacity:0">'+
			'	<div class="modal-header">'+
			'	<button type="button" class="close close_comfirm"></button>'+
			'	<h3 id="myModalLabel3">'+Header+'</h3>'+
			'	</div>'+
			'<div class="modal-body">'+
			'	<p>'+Body+'</p>'+
			'</div>'+
			'<div class="modal-footer">'+
			'<button class="btn close_comfirm" >取消</button>'+
			'	<button class="btn blue ok_confirm">确定</button>'+
			'</div>'+
			'</div>'+
			'<div class="modal-backdrop fade in Drak" ></div>'
	$("body").append(html);
	$("#yyxcomfirm").animate({
		top:"20%",
		opacity:1
	})

	$(".close_comfirm").click(function(){
		$("#yyxcomfirm").animate({
			top:"-175px",
			opacity:0
		},function(){
			$("#yyxcomfirm").remove();
		})
		$(".Drak").animate({
			opacity:0
		},function(){
			$(".Drak").remove();
		})
		yyxkey=true
	})

	$(".ok_confirm").click(function(){
		$("#yyxcomfirm").animate({
			top:"-175px",
			opacity:0
		},function(){
			$("#yyxcomfirm").remove();
		})
		$(".Drak").animate({
			opacity:0
		},function(){
			$(".Drak").remove();
		})
		yyxkey=true
		if(callback){
			callback();
		}
	})
	}

}


function yyxalert(Body,time,Header) {
	 if(yyxkey){
	 	   yyxkey=false
		time?time=time:time=2000
		// Body?Body=Body:Body="修改成功！"
		Header?Header=Header:Header="提示"
		var html='<div id="yyxcomfirm" class="modal in " style="top:-175px;opacity:0">'+
			'	<div class="modal-header">'+
			'	<button type="button" class="close close_comfirm"></button>'+
			'	<h3 id="myModalLabel3">'+Header+'</h3>'+
			'	</div>'+
			'<div class="modal-body">'+
			'	<p>'+Body+'</p>'+
			'</div>'+
			'<div class="modal-footer">'+
			'<button class="btn close_comfirm" >确定</button>'+
			
			'</div>'+
			'</div>'+
			'<div class="modal-backdrop fade in Drak" ></div>'
	$("body").append(html);
	$("#yyxcomfirm").animate({
		top:"20%",
		opacity:1
	})

	$(".close_comfirm").click(function(){
		$("#yyxcomfirm").animate({
			top:"-175px",
			opacity:0
		},function(){
			$("#yyxcomfirm").remove();
		})
		$(".Drak").animate({
			opacity:0
		},function(){
			$(".Drak").remove();
		})
	})
	setTimeout(function(){
		$("#yyxcomfirm").animate({
			top:"-175px",
			opacity:0
		},function(){
			$("#yyxcomfirm").remove();
		})
		$(".Drak").animate({
			opacity:0
		},function(){
			$(".Drak").remove();
		})
		  yyxkey=true
	},time);
	}
}


function yyxajax(url,data,callBack,type) {
        type=type||'POST';
        if(yyxkey){
            yyxkey=false;
            $.ajax({
            type:type,
            url: url,
            data:data,
            success:  function(islist){
                yyxkey=true
                callBack(islist);
                },error:function(dd){
                  yyxkey=true
                  callBack(dd);
                }
            });
        }
}