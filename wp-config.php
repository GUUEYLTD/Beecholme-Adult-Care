<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wp_database');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'HQ+ZUcU6=o]v}}btIr8%__TH,c23*C3%.*-d3<|&BYi9H75LeYQ;lkrPt1a;~8ix');
define('SECURE_AUTH_KEY',  ':jIVt9Xb>(F8(`x=TU,n .#`_3-kX}4HCm)wAW{WQo)rxi>>~RC-7E3c%{f`Z^p9');
define('LOGGED_IN_KEY',    'R`!,(YS7DY<Z?-T.YZ.<JEx;onU=NI?Y&`#B[[z$?msAPqq+.6}N,$tZo z;#i}I');
define('NONCE_KEY',        '4.NH$g9uJ8{?z-<hO,z1^xP0`V^.(YN2(,zP-T3FlsKg#K%LY$W y=seF $Eeq^+');
define('AUTH_SALT',        'F83V?d;`x2=]agOrHP1D9GrjhmPfbh3IEWMzVC?WW0R(aenN?vdsV^}Zy%f0>x0;');
define('SECURE_AUTH_SALT', '#P,u=dL$nUH*hv[rfQ`f-G5 d4w[u?wlEO<wEz|$8#/awenpC`BI N2A/V`R{oWX');
define('LOGGED_IN_SALT',   '=L[ApxJf&=)c_M-=2(%dQ%.icaYu)6C*~t!-8c=jc/$[1Q|`py)~w}(vx_B:R#;i');
define('NONCE_SALT',       'lDOzFlyOUz?aAs=%X/*U<FT_zBJ_OMQeO,=@6o&KXS&h2G+8[/R<ZK*xcvB}mXj=');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

define('WP_HOME',"http://127.0.0.1");
define('WP_SITEURL',"http://127.0.0.1");
// die;

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
