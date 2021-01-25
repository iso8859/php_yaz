# php_yaz pour Windows IIS

Voici comment compiler php_yaz.dll en mode NTS (non thread safe) pour executer sous IIS

php_zay.dll sera linké avec php7.dll

STEP 1 : COPMPILER PHP pour avoir php.lib qui link avec php7.dll

Pour compiler suivre cette procédure
https://wiki.php.net/internals/windows/stepbystepbuild_sdk_2

Vérifier votre version de php et vérifier que c'est bien la version NTS

c:\>php.exe -version

PHP 7.4.14 (cli) (built: Jan  5 2021 15:11:43) ( NTS Visual C++ 2017 x64 )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies

Récupérer 
https://github.com/Microsoft/php-sdk-binary-tools

Construire l'arbo
c:\>phpsdk-vc15-x64.bat
c:\>bin\phpsdk_buildtree.bat phpdev

Récupérer PHP
git clone https://github.com/php/php-src
Prendre la branche correspondante
c:\>git fetch
c:\>git checkout PHP-7.4.14

Le mettre dans php-sdk-binary-tools\phpdev\vc15\x64\php-7.4.14-src
buildconf
configure --disable-all --enable-cli --enable-$remains --disable-zts
nmake

STEP 2 : RECUPERER YAZ pour avoir yaz5.lib
https://www.indexdata.com/resources/software/yaz/
récupérer la version windows 64 bits et la mettre dans le dossier racine de la compilation
Bien cocher "source" lors de l'installation

STEP 3 : RECUPER le code source php_yaz pour le compiler
https://www.indexdata.com/resources/software/phpyaz/
Récupérer le code ici
git clone https://github.com/indexdata/phpyaz

Créer un projet Visual Studio C++ DLL
Mettre le seul fichier php_yaz.c
Include path
/I "\PHP-7.4.14\Zend" /I "\PHP-7.4.14\main" /I "\PHP-7.4.14\TSRM" /I "\PHP-7.4.14" /I "\yaz\include" /D ZEND_DEBUG=0 
PREPROCESOR DEFINITION
NDEBUG
PHPYAZ_EXPORTS
_WINDOWS
_USRDLL
HAVE_YAZ
PHP_EXPORTS
COMPILE_DL_YAZ
ZEND_WIN32
PHP_WIN32
ZEND_DEBUG=0
_CRT_SECURE_NO_WARNINGS

