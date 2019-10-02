<?Php 
$url = 'http://teast.info/sticker/sticker.php';

$ch = curl_init($url);
$post = [
    'login' => 'Gaad',
    'password' => '123'
];

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_COOKIEFILE, str_replace("\\", "/", getcwd()).'/gearbest.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Возвращаем, но не выводим на экран результат

$response['html'] = curl_exec($ch);

$info = curl_getinfo($ch);
if($info['http_code'] != 200 && $info['http_code'] != 404) {
    $error_page[] = array(1, $page_url, $info['http_code']);
    if($retry) {
        sleep($pause_time);
        $response['html'] = curl_exec($ch);
        $info = curl_getinfo($ch);
        if($info['http_code'] != 200 && $info['http_code'] != 404)
            $error_page[] = array(2, $page_url, $info['http_code']);
    }
}
$response['code'] = $info['http_code'];
$response['errors'] = $error_page;
curl_close($ch);

var_dump($response);
var_dump('http://localhost/tipquery/cookie.txt/');

