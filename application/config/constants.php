<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| kode rahasia
|--------------------------------------------------------------------------
*/
define('secret_key','6621AC59567F158090B9F54C9E1FF4C9252CF05B');
define('secret_key_salah','999');

/*
|--------------------------------------------------------------------------
| Auth Status Codes
|--------------------------------------------------------------------------
*/

define('berhasil_insert', 'Tambah Data Berhasil');
define('berhasil_update', 'Ubah Data Berhasil');
define('gagal_insert', 'Ubah Data Gagal');
define('gagl_update', 'Ubah Data Gagal');

define('email_sudah_dipakai', 'Email sudah dipakai');
define('email_tidak_tersedia', 'email tidak tersedia');
define('password_salah', 'Password salah');
define('code_verifikasi_salah', 'Code verifikasi salah');
define('berhasil_login','Sukses login');
define('berhasil_register','Sukses register');
define('gagal_kirim_email','Gagal kirim email');
define('kode_verifikasi_salah',"Kode verifikasi salah");
define('berhasil_verifikasi',"Sukses verifikasi akun");

/*
|--------------------------------------------------------------------------
| DB Status Codes
|--------------------------------------------------------------------------
*/

define('gagal_tambah_data', 'Gagal menambah data');
define('gagal_edit_data', 'Gagal mengedit data');
define('gagal_hapus_data', 'Gagal menghapus data');
define('status_delete', 1);
define('status_new_user', 2);
define('status_enable', 3);
define('status_pengerjaan', 4);
define('status_disable', 5);
define('status_finish', 6);
define('data_ditemukan', 'Data ditemukan');
define('data_tidak_ditemukan','Data tidak ditemukan');

/*
|--------------------------------------------------------------------------
| Lelang Status Codes
|--------------------------------------------------------------------------
*/

define('gagal_buat_lelang', 'Gagal membuat lelang');
define('gagal_edit_lelang', 'Gagal mengedit lelang');
define('gagal_hapus_lelang', 'Gagal menghapus lelang');
define('berhasil_buat_lelang', 'Berhasil membuat lelang');
define('berhasil_edit_lelang', 'Berhasil mengedit lelang');
define('berhasil_hapus_lelang', 'Berhasil menghapus lelang');
define('gagal_buat_pekerjaan', 'Gagal membuat pekerjaan');
define('gagal_edit_pekerjaan', 'Gagal mengedit pekerjaan');
define('gagal_hapus_pekerjaan', 'Gagal menghapus pekerjaan');
define('berhasil_buat_pekerjaan', 'Berhasil membuat pekerjaan');
define('berhasil_edit_pekerjaan', 'Berhasil mengedit pekerjaan');
define('berhasil_hapus_pekerjaan', 'Berhasil menghapus pekerjaan');
define('lelang_sudah_berakhir', 'Lelang sudah berakhir');
define('berhasil_buat_tawaran', 'Berhasil membuat tawaran');
define('gagal_buat_tawaran', 'Gagal membuat tawaran');
define('berhasil_edit_tawaran', 'Berhasil mengedit tawaran');
define('gagal_edit_tawaran', 'Gagal mengedit tawaran');

/*
|--------------------------------------------------------------------------
| Pembayaran
|--------------------------------------------------------------------------
*/
define ("PEMBAYARAN", serialize (array ("0"=>"Rekber", "1"=>"Transfer", "2"=>"COD")));
define ("STATUSLELANG", serialize (array ("1"=>"Dihapus","3"=>"Tersedia", "4"=>"Pengerjaan", "5"=>"Kedaluwarsa", "6"=>"Selesai")));