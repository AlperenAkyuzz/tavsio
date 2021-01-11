<?php

session_start();

function CheckAuthentication(){
    return $_COOKIE['adminCooki'] ? true : false;
}

$config['LicenseName'] = 'developer';
$config['LicenseKey']  = 'RWMPR9BL2V5HSCQ59W9PVGCEG8FBBBEH';

$baseUrl = '/images/';
$baseDir = resolveUrl($baseUrl);

$config['Thumbnails'] = Array(
		'url'          => $baseUrl . 'uploads/_thumbs',
		'directory'    => $baseDir . 'uploads/_thumbs',
		'enabled'      => false,
		'directAccess' => false,
		'maxWidth'     => 100,
		'maxHeight'    => 100,
		'bmpSupported' => false,
		'quality'      => 80
);

$config['Images'] = Array(
		'maxWidth'  => 1024,
		'maxHeight' => 1024,
		'quality'   => 100
);

$config['RoleSessionVar'] = 'CKFinder_UserRole';

$config['AccessControl'][] = Array(
		'role'         => '*',
		'resourceType' => '*',
		'folder'       => '/',

		'folderView'   => true,
		'folderCreate' => true,
		'folderRename' => true,
		'folderDelete' => true,

		'fileView'   => true,
		'fileUpload' => true,
		'fileRename' => true,
		'fileDelete' => true
);

$config['DefaultResourceTypes'] = '';

$config['ResourceType'][] = Array(
		'name' => 'Files',				// Single quotes not allowed
		'url' => $baseUrl . 'files',
		'directory' => $baseDir . 'files',
		'maxSize' => 0,
		'allowedExtensions' => '7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,pxd,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,sitd,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,xlsx,zip',
		'deniedExtensions' => ''
);

$config['ResourceType'][] = Array(
		'name' => 'Images',
		'url' => $baseUrl . 'uploads',
		'directory' => $baseDir . 'uploads',
		'maxSize' => 0,
		'allowedExtensions' => 'bmp,gif,jpeg,jpg,png',
		'deniedExtensions' => '');

$config['ResourceType'][] = Array(
		'name' => 'Flash',
		'url' => $baseUrl . 'flash',
		'directory' => $baseDir . 'flash',
		'maxSize' => 0,
		'allowedExtensions' => 'swf,flv',
		'deniedExtensions' => '');

/*
 Due to security issues with Apache modules, it is recommended to leave the
 following setting enabled.

 How does it work? Suppose the following:

	- If "php" is on the denied extensions list, a file named foo.php cannot be
	  uploaded.
	- If "rar" (or any other) extension is allowed, one can upload a file named
	  foo.rar.
	- The file foo.php.rar has "rar" extension so, in theory, it can be also
	  uploaded.

In some conditions Apache can treat the foo.php.rar file just like any PHP
script and execute it.

If CheckDoubleExtension is enabled, each part of the file name after a dot is
checked, not only the last part. In this way, uploading foo.php.rar would be
denied, because "php" is on the denied extensions list.
*/
$config['CheckDoubleExtension'] = true;

/*
Increases the security on an IIS web server.
If enabled, CKFinder will disallow creating folders and uploading files whose names contain characters
that are not safe under an IIS web server.
*/
$config['DisallowUnsafeCharacters'] = false;

/*
If you have iconv enabled (visit http://php.net/iconv for more information),
you can use this directive to specify the encoding of file names in your
system. Acceptable values can be found at:
	http://www.gnu.org/software/libiconv/

Examples:
	$config['FilesystemEncoding'] = 'CP1250';
	$config['FilesystemEncoding'] = 'ISO-8859-2';
*/
$config['FilesystemEncoding'] = 'UTF-8';

/*
Perform additional checks for image files
if set to true, validate image size
*/
$config['SecureImageUploads'] = true;

/*
Indicates that the file size (maxSize) for images must be checked only
after scaling them. Otherwise, it is checked right after uploading.
*/
$config['CheckSizeAfterScaling'] = true;

/*
For security, HTML is allowed in the first Kb of data for files having the
following extensions only.
*/
$config['HtmlExtensions'] = array('html', 'htm', 'xml', 'js');

/*
Folders to not display in CKFinder, no matter their location.
No paths are accepted, only the folder name.
The * and ? wildcards are accepted.
".*" disallows the creation of folders starting with a dot character.
*/
$config['HideFolders'] = Array(".*", "CVS");

/*
Files to not display in CKFinder, no matter their location.
No paths are accepted, only the file name, including extension.
The * and ? wildcards are accepted.
*/
$config['HideFiles'] = Array(".*");

/*
After file is uploaded, sometimes it is required to change its permissions
so that it was possible to access it at the later time.
If possible, it is recommended to set more restrictive permissions, like 0755.
Set to 0 to disable this feature.
Note: not needed on Windows-based servers.
*/
$config['ChmodFiles'] = 0777 ;

/*
See comments above.
Used when creating folders that does not exist.
*/
$config['ChmodFolders'] = 0755 ;

/*
Force ASCII names for files and folders.
If enabled, characters with diactric marks, like å, ä, ö, ć, č, đ, š
will be automatically converted to ASCII letters.
*/
$config['ForceAscii'] = false;

/*
Send files using X-Sendfile module
Mod X-Sendfile (or similar) is avalible on Apache2, Nginx, Cherokee, Lighttpd

Enabling X-Sendfile option can potentially cause security issue.
 - server path to the file may be send to the browser with X-Sendfile header
 - if server is not configured properly files will be send with 0 length

For more complex configuration options visit our Developer's Guide
  http://docs.cksource.com/CKFinder_2.x/Developers_Guide/PHP
*/
$config['XSendfile'] = false;


include_once "plugins/imageresize/plugin.php";
include_once "plugins/fileeditor/plugin.php";
include_once "plugins/zip/plugin.php";

$config['plugin_imageresize']['smallThumb'] = '90x90';
$config['plugin_imageresize']['mediumThumb'] = '120x120';
$config['plugin_imageresize']['largeThumb'] = '180x180';
