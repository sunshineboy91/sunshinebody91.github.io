<?php
// GitHub Webhook Secret.
// 修改地方1 GitHub项目 Settings/Webhooks 中的 Secret
$secret = "lihuiyu";

// Path to your respostory on your server.
// e.g. "/var/www/respostory"
// 修改地方2 项目地址
$path = "/www/wwwroot/git.lihuiyu.top";

// Headers deliveried from GitHub
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

if ($signature) {
  $hash = "sha1=" . hash_hmac('sha1', file_get_contents("php://input"), $secret);
  if (strcmp($signature, $hash) == 0) {
    echo shell_exec("cd {$path} && /usr/local/git/bin/git reset --hard origin/master && /usr/local/git/bin/git clean -f && /usr/local/git/bin/git pull 2>&1");
    exit();
  }
}

http_response_code(404);
