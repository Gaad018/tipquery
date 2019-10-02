<?php 

if (!empty($_POST) && isset($_POST['tip'])) {
    $url = "https://www.google.ru/complete/search?sclient=psy-ab&newwindow=1&safe=off&biw=840&bih=589&q=" . $_POST['tip'] . "&oq=&gs_l=&pbx=1&bav=on.2,or.r_cp.&bvm=bv.150120842,d.bGs&fp=340975d5227619b6&pf=p&gs_rn=64&gs_ri=psy-ab&gs_mss=%D0%BF%D0%B0h&tok=0mPi7H_lGIpBh7dz7hlFyQ&cp=5&gs_id=24&xhr=t&tch=1&ech=15&psi=uGDSWO_2CMb-6ASvx7PoDg.1490182331198.1";
    $path = 'file/lastquery.txt';
    $fp = fopen($path, 'w');

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    $data = curl_exec($ch);
    curl_close($ch);
    
    if($site_charset!="UTF-8") echo iconv($site_charset,"UTF-8",$out);

    fclose($fp);
    $text = file_get_contents($path);
    $text = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
    preg_match_all('#\\\\"(\w*)\\\\\\\\u003cb\\\\\\\\u003e([\w|\s]*)#mu', $text, $match);
    foreach ($match[2] as $key => $value) {
        $texts .= $_POST['tip'] . '-' . $value . '<br>';
    }
    echo $texts;
} else {
    echo 'Ошибка!';
}