Baidu Netdisk Direct Link 20131109
===================================
获取百度网盘直链，基于 MIT 协议发布。

index.php 使用说明
-----------------------------------
获取直链模块，部署到服务器端后通过以下地址访问（如果需要静态化地址，请自行配制 Rewrite，可参考 URL Config.txt）

### 新版地址
http://pan.baidu.com/s/1n81ky 对应为 index.php?file=1n81ky

### 旧版地址
http://pan.baidu.com/share/link?shareid=498673&uk=3145124 对应为 index.php?shareid=498673&uk=3145124

info.php 使用说明
-----------------------------------
获取文件的信息，目前支持文件名，返回 Json 数组

### 新版地址
http://pan.baidu.com/s/1n81ky 对应为 info.php?file=1n81ky

### 旧版地址
http://pan.baidu.com/share/link?shareid=498673&uk=3145124 对应为 info.php?shareid=498673&uk=3145124