<?php

try {
    $pdo = new PDO('mysql:host=mysql80.zogo.sakura.ne.jp;dbname=zogo_kadai1;charset=utf8', 'zogo_kadai1', 'gs_sorapin');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}
