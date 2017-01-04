# 二维码生成-Qrcode库  

## 前端页面index.php
## 后台脚本create.php
## 引用类库Qrcode.class.php  
Qrcode.class.php 中新增了png_with_logo方法用于生成带logo的二维码  

类库只能生成不带图片的二维码，但是可以通过提高二维码容错率，在二维码中间插入图片的方式来生成二维码logo。  



# 通过js生成二维码
## 前段页面index.html
## 引用类库 Qrcode.js  
此方式目前无法正确生成中文内容的二维码。