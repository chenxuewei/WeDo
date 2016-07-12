function local_mkdirs($path) {
if(!is_dir($path)) {
$this->local_mkdirs(dirname($path));
mkdir($path);
}
return is_dir($path);
}

function local_run($sql) {
global $link, $db;

if(!isset($sql) || empty($sql)) return;

$sql = str_replace("\r", "\n", str_replace(' ims_', ' '.$db['prefix'], $sql));
$sql = str_replace("\r", "\n", str_replace(' `ims_', ' `'.$db['prefix'], $sql));
$ret = array();
$num = 0;
foreach(explode(";\n", trim($sql)) as $query) {
$ret[$num] = '';
$queries = explode("\n", trim($query));
foreach($queries as $query) {
$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
}
$num++;
}
unset($sql);
foreach($ret as $query) {
$query = trim($query);
if($query) {
if(!mysql_query($query, $link)) {
echo mysql_errno() . ": " . mysql_error() . "<br />";
exit($query);
}
}
}
}

function local_create_sql($schema) {
$pieces = explode('_', $schema['charset']);
$charset = $pieces[0];
$engine = $schema['engine'];
$sql = "CREATE TABLE IF NOT EXISTS `{$schema['tablename']}` (\n";
foreach ($schema['fields'] as $value) {
if(!empty($value['length'])) {
$length = "({$value['length']})";
} else {
$length = '';
}

$signed  = empty($value['signed']) ? ' unsigned' : '';
if(empty($value['null'])) {
$null = ' NOT NULL';
} else {
$null = '';
}
if(isset($value['default'])) {
$default = " DEFAULT '" . $value['default'] . "'";
} else {
$default = '';
}
if($value['increment']) {
$increment = ' AUTO_INCREMENT';
} else {
$increment = '';
}

$sql .= "`{$value['name']}` {$value['type']}{$length}{$signed}{$null}{$default}{$increment},\n";
}
foreach ($schema['indexes'] as $value) {
$fields = implode('`,`', $value['fields']);
if($value['type'] == 'index') {
$sql .= "KEY `{$value['name']}` (`{$fields}`),\n";
}
if($value['type'] == 'unique') {
$sql .= "UNIQUE KEY `{$value['name']}` (`{$fields}`),\n";
}
if($value['type'] == 'primary') {
$sql .= "PRIMARY KEY (`{$fields}`),\n";
}
}
$sql = rtrim($sql);
$sql = rtrim($sql, ',');

$sql .= "\n) ENGINE=$engine DEFAULT CHARSET=$charset;\n\n";
return $sql;
}

function remote_install() {
global $family;
$token = '';
$pars = array();
$pars['host'] = $_SERVER['HTTP_HOST'];
$pars['version'] = '0.7';
$pars['release'] = '';
$pars['type'] = 'install';
$pars['product'] = '';
$url = 'http://v2.addons.we7.cc/gateway.php';
$urlset = parse_url($url);
$cloudip = gethostbyname($urlset['host']);
$headers[] = "Host: {$urlset['host']}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlset['scheme'] . '://' . $cloudip . $urlset['path']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $pars);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADERFUNCTION, '__remote_install_headers');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$content = curl_exec($ch);
curl_close($ch);
$sign = __remote_install_headers();
$ret = array();
if(empty($content)) {
return showerror(-1, '获取安装信息失败，可能是由于网络不稳定，请重试。');
}
$ret = unserialize($content);
if($sign != md5($ret['data'] . $token)) {
return showerror(-1, '发生错误: 数据校验失败，可能是传输过程中网络不稳定导致，请重试。');
}
$ret['data'] = unserialize($ret['data']);
return $ret['data'];
}

function local_salt($length = 8) {
$result = '';
while(strlen($result) < $length) {
$result .= sha1(uniqid('', true));
}
return substr($result, 0, $length);
}

function local_config() {
$cfg = <<<EOF
<?php
defined('IN_IA') or exit('Access Denied');

\$config = array();

\$config['db']['master']['host'] = '{db-server}';
\$config['db']['master']['username'] = '{db-username}';
\$config['db']['master']['password'] = '{db-password}';
\$config['db']['master']['port'] = '{db-port}';
\$config['db']['master']['database'] = '{db-name}';
\$config['db']['master']['charset'] = 'utf8';
\$config['db']['master']['pconnect'] = 0;
\$config['db']['master']['tablepre'] = '{db-tablepre}';

\$config['db']['slave_status'] = false;
\$config['db']['slave']['1']['host'] = '';
\$config['db']['slave']['1']['username'] = '';
\$config['db']['slave']['1']['password'] = '';
\$config['db']['slave']['1']['port'] = '3307';
\$config['db']['slave']['1']['database'] = '';
\$config['db']['slave']['1']['charset'] = 'utf8';
\$config['db']['slave']['1']['pconnect'] = 0;
\$config['db']['slave']['1']['tablepre'] = 'ims_';
\$config['db']['slave']['1']['weight'] = 0;

\$config['db']['common']['slave_except_table'] = array('core_sessions');

// --------------------------  CONFIG COOKIE  --------------------------- //
\$config['cookie']['pre'] = '{cookiepre}';
\$config['cookie']['domain'] = '';
\$config['cookie']['path'] = '/';

// --------------------------  CONFIG SETTING  --------------------------- //
\$config['setting']['charset'] = 'utf-8';
\$config['setting']['cache'] = 'mysql';
\$config['setting']['timezone'] = 'Asia/Shanghai';
\$config['setting']['memory_limit'] = '256M';
\$config['setting']['filemode'] = 0644;
\$config['setting']['authkey'] = '{authkey}';
\$config['setting']['founder'] = '1';
\$config['setting']['development'] = 0;
\$config['setting']['referrer'] = 0;
\$config['setting']['https'] = 0;

// --------------------------  CONFIG UPLOAD  --------------------------- //
\$config['upload']['image']['extentions'] = array('gif', 'jpg', 'jpeg', 'png');
\$config['upload']['image']['limit'] = 5000;
\$config['upload']['attachdir'] = '{attachdir}';
\$config['upload']['audio']['extentions'] = array('mp3');
\$config['upload']['audio']['limit'] = 5000;

// --------------------------  CONFIG MEMCACHE  --------------------------- //
\$config['setting']['memcache']['server'] = '';
\$config['setting']['memcache']['port'] = 11211;
\$config['setting']['memcache']['pconnect'] = 1;
\$config['setting']['memcache']['timeout'] = 30;
\$config['setting']['memcache']['session'] = 1;

// --------------------------  CONFIG PROXY  --------------------------- //
\$config['setting']['proxy']['host'] = '';
\$config['setting']['proxy']['auth'] = '';
EOF;
return trim($cfg);
}
/*************************************方案二**************************************************************/
function actionTest()
{
    $db = $_POST['db'];
    $user = $_POST['user'];
    $link = mysql_connect($db['server'], $db['username'], $db['password']);
    if (empty($link)) {
        $error = mysql_error();
        if (strpos($error, 'Access denied for user') !== false) {
            $error = '您的数据库访问用户名或是密码错误. <br />';
        } else {
            $error = iconv('gbk', 'utf8', $error);
        }
    } else {
        mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");
        mysql_query("SET sql_mode=''");
        if (mysql_errno()) {
            $error = mysql_error();
        } else {
            $query = mysql_query("SHOW DATABASES LIKE  '{$db['name']}';");
            if (!mysql_fetch_assoc($query)) {
                if (mysql_get_server_info() > '4.1') {
                    mysql_query("CREATE DATABASE IF NOT EXISTS `{$db['name']}` DEFAULT CHARACTER SET utf8", $link);
                } else {
                    mysql_query("CREATE DATABASE IF NOT EXISTS `{$db['name']}`", $link);
                }
            }
            $query = mysql_query("SHOW DATABASES LIKE  '{$db['name']}';");
            if (!mysql_fetch_assoc($query)) {
                $error .= "数据库不存在且创建数据库失败. <br />";
            }
            if (mysql_errno()) {
                $error .= mysql_error();
            }
        }
    }
    if (empty($error)) {
        mysql_select_db($db['name']);
        $query = mysql_query("SHOW TABLES LIKE '{$db['prefix']}%';");
        if (mysql_fetch_assoc($query)) {
            $error = '您的数据库不为空，请重新建立数据库或是清空该数据库或更改表前缀！';
        }
    }
    if (empty($error)) {
        $pieces = explode(':', $db['server']);
        $db['port'] = !empty($pieces[1]) ? $pieces[1] : '3306';
        $config = $this->local_config();
        $cookiepre = $this->local_salt(4) . '_';
        $authkey = $this->local_salt(8);
        $config = str_replace(array(
            '{db-server}', '{db-username}', '{db-password}', '{db-port}', '{db-name}', '{db-tablepre}', '{cookiepre}', '{authkey}', '{attachdir}'
        ), array(
            $db['server'], $db['username'], $db['password'], $db['port'], $db['name'], $db['prefix'], $cookiepre, $authkey, 'attachment'
        ), $config);
        $verfile = IA_ROOT . '/framework/version.inc.php';
        $dbfile = IA_ROOT . '/data/db.php';


        if (file_exists($verfile)) {
            include $verfile;
            $version = IMS_VERSION;
            $release = IMS_RELEASE_DATE;
        } else {
            $version = '';
            $release = date('YmdHis');
        }
        $verdat = <<<VER
<?php
/**
 * 版本号
 *
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */

defined('IN_IA') or exit('Access Denied');

define('IMS_VERSION', '{$version}');
define('IMS_RELEASE_DATE', '{$release}');
VER;
//        $is_ok = file_put_contents($verfile, $verdat);
//        if (!$is_ok) {
//            die('<script type="text/javascript">alert("生成版本文件失败");history.back();</script>');
//        }
        $salt = $this->local_salt(8);
        $password = sha1("{$user['password']}-{$salt}-{$authkey}");
        mysql_query("INSERT INTO {$db['prefix']}users (username, password, salt, joindate) VALUES('{$user['username']}', '{$password}', '{$salt}', '" . time() . "')");
        $this->local_mkdirs(IA_ROOT . '/data');
        file_put_contents(IA_ROOT . '/data/config.php', $config);
        touch(IA_ROOT . '/data/install.lock');
        setcookie('action', 'finish');
        header('location: ?refresh');
        exit();
    }
}
