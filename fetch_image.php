<?php
// 获取图片的编号（从查询参数中获取）
$imageNumber = isset($_GET['image']) ? (int)$_GET['image'] : 1;

// 设置要访问的接口 URL，并附加图片编号参数
$apiUrl = 'http://mt.xqia.net/shu.php?image=' . $imageNumber;

// 初始化 cURL 会话
$ch = curl_init();

// 设置 cURL 选项
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 返回请求结果
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 不验证证书（不推荐用于生产环境）
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 不验证证书中的主机名
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // 跟随重定向

// 执行请求并获取响应
$response = curl_exec($ch);

// 检查请求是否成功
if ($response === FALSE) {
    // 请求失败时输出错误信息
    header('Content-Type: text/plain');
    echo "请求失败: " . curl_error($ch);
} else {
    // 获取响应的 Content-Type 头信息
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    
    // 设置正确的 Content-Type 头信息以返回图片
    header('Content-Type: ' . $contentType);
    echo $response;
}

// 关闭 cURL 会话
curl_close($ch);
?>
