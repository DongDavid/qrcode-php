
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>二维码生成</title>

<!-- 新 Bootstrap 核心 CSS 文件 -->
<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

<!-- 可选的Bootstrap主题文件（一般不使用） -->
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap-theme.min.css"></script>

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
<div class="container">
<div class="jumbotron" style="border-radius: 0px;">
	<img src="./codeimg/2017010416485248275562.jpg" alt="" class="img-rounded pull-left" style="max-height: 80px;">
	<h2>你想要生成二维码吗？那就来点我吧！！！</h2>
</div>
 <div class="row">
 	<div class="col-md-5">
 		<div class="form-group" >
			<label for="name">请输入二维码内容</label>
			<input type="text" class="form-control" id="data" name="data" placeholder="请输入二维码内容">
		</div>
		<div class="checkbox">
		    <label>
		      <input type="checkbox" value="1" id="addlogo">请打勾
		    </label>
		</div>
		<div class="form-group">
			<label for="inputfile">选择图片</label>
			<input type="file" id="logo">
			<input type="hidden" class="logo" name="logo">
			<p class="help-block">如果需要logo，则上传图片</p>
		</div>
		<div class="form-group">
			<img src="" id="logo_img" class="img-rounded">
		</div>

 	</div>
 	<div class="col-md-2">
 		<button class="btn btn-primary" id="createQR">生成二维码</button>
 	</div>
 	<div class="col-md-5">
 		<img src="" alt="" id="qrcode" class="img-rounded">
 	</div>
 </div>
 </div>
<script>

	$('#createQR').click(function(event) {
		var data = $('#data').val();
		var logo_img = $('.logo').val();
		var islogo = $('#addlogo:checked').val();
		if (!data || data=='') {
			alert('请输入二维码内容！');
			return false;
		}
		if (islogo && logo_img=='') {
			alert('请选择图片！');
			return false;
		}
		var req = {data:data,logo_img:logo_img}
		$.post('create.php', req, function(data, textStatus, xhr) {
			data = JSON.parse(data);
			if (data.s == 1) {
				$('#qrcode').attr("src",data.uri);
			}else{
				alert('出错了啊！');
			}
		});
	});
	$('#logo').change(function(event) {

		var logo = base64_encode('logo','logo_img');
//console.log(logo);


	});

    var base64_encode = function(input_id,img_id){
    	if (document.getElementById(input_id).files.length === 0) { return; }
        var oFile = document.getElementById(input_id).files[0];
            //显示图片
        var oFReader = new FileReader(), rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
        oFReader.onload = function (oFREvent) {
        	//异步操作，在这里执行获取base64数据后的操作
        	//$('#'+img_id).css("background-image","url("+oFREvent.target.result+")");
        	document.getElementById(img_id).src = oFREvent.target.result;
        	$('.'+input_id).val(oFREvent.target.result);

        };
        if (!rFilter.test(oFile.type)) {
            Alert("请选择正确的照片类型！");
            return;
        }
        oFReader.readAsDataURL(oFile);

    }

</script>
 </body>
 </html>




