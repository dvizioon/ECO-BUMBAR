<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22c176dff9bb5dd91d10836670dddb21
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'F' => 
        array (
            'Fpdf\\' => 5,
        ),
        'C' => 
        array (
            'Com\\Tecnick\\Unicode\\Data\\' => 25,
            'Com\\Tecnick\\Unicode\\' => 20,
            'Com\\Tecnick\\Pdf\\Page\\' => 21,
            'Com\\Tecnick\\Pdf\\Image\\' => 22,
            'Com\\Tecnick\\Pdf\\Graph\\' => 22,
            'Com\\Tecnick\\Pdf\\Font\\' => 21,
            'Com\\Tecnick\\Pdf\\Encrypt\\' => 24,
            'Com\\Tecnick\\Pdf\\' => 16,
            'Com\\Tecnick\\File\\' => 17,
            'Com\\Tecnick\\Color\\' => 18,
            'Com\\Tecnick\\Barcode\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Fpdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/fpdf/fpdf/src/Fpdf',
        ),
        'Com\\Tecnick\\Unicode\\Data\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-unicode-data/src',
        ),
        'Com\\Tecnick\\Unicode\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-unicode/src',
        ),
        'Com\\Tecnick\\Pdf\\Page\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-pdf-page/src',
        ),
        'Com\\Tecnick\\Pdf\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-pdf-image/src',
        ),
        'Com\\Tecnick\\Pdf\\Graph\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-pdf-graph/src',
        ),
        'Com\\Tecnick\\Pdf\\Font\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-pdf-font/src',
        ),
        'Com\\Tecnick\\Pdf\\Encrypt\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-pdf-encrypt/src',
        ),
        'Com\\Tecnick\\Pdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-pdf/src',
        ),
        'Com\\Tecnick\\File\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-file/src',
        ),
        'Com\\Tecnick\\Color\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-color/src',
        ),
        'Com\\Tecnick\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-barcode/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22c176dff9bb5dd91d10836670dddb21::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22c176dff9bb5dd91d10836670dddb21::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit22c176dff9bb5dd91d10836670dddb21::$classMap;

        }, null, ClassLoader::class);
    }
}
