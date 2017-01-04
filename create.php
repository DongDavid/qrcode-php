<?php

if (!empty($_POST)) {
	require_once 'Qrcode.class.php';
	$data = $_POST['data'];
	$logo = $_POST['logo_img'];
	//echo $logo;
	$Qrcode = new Qrcode();
	$QrCodeImg = './codeimg/' . time() . '.png';
	$Qrcode->png($data, $QrCodeImg, 'L', 16, 2); //生成二维码

	$updir = "./codeimg/"; //logo图片保存路径
	if (!empty($logo)) {
		$logo = base64($logo, $updir);
		$Qrcode->png_with_logo($QrCodeImg, $logo);
	}
	//printf($logo);

	echo json_encode(['s' => "1", 'uri' => $QrCodeImg]);
} else {
	echo JSON_UNESCAPED_SLASHES; //64
	echo "<br>";
	echo JSON_UNESCAPED_UNICODE; //256
}

function base64($data, $path = './', $filename = '') {
	$s = explode(',', $data);
	if ($data && count($s) > 1) {
		if ($s[0] == "data:image/jpeg;base64") {
			$type = "jpg";
		} else {
			$type = "png";
		}
		$url = $filename ? $filename : date('YmdHis') . mt_rand(1000, 9999) . mt_rand(1000, 9999);
		$path = $path . $url;
		$imgurl = '';
		if (!empty($s[1]) && !empty($type)) {
			$imgurl = $path . '.' . $type;
			if (file_put_contents($imgurl, base64_decode($s[1]))) {
				return $imgurl;
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}

?>






