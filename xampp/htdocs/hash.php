<?php
function get_hashed_password($password)
    {
        // コストパラメーター
        // 04 から 31 までの範囲 大きくなれば堅牢になりますが、システムに負荷がかかります。
        $cost = 10;

        // ランダムな文字列を生成します。
        $salt = strtr(base64_encode(random_bytes(16)), '+', '.');

        // ソルトを生成します。
        $salt = sprintf("$2y$%02d$", $cost) . $salt;

        $hash = crypt($password, $salt);

        return $hash;
    }
$password = "password";
$hash = get_hashed_password($password);
echo $hash;
