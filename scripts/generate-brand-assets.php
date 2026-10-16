<?php

// Run with: php scripts/generate-brand-assets.php (requires GD).
$public = dirname(__DIR__).'/public';
$emblemPath = $public.'/assets/images/onecore-emblem.png';
$emblem = imagecreatefrompng($emblemPath);
$logo = imagecreatefrompng($public.'/assets/images/onecore-logo-horizontal.png');

function iconImage(GdImage $emblem, int $size): GdImage
{
    $image = imagecreatetruecolor($size, $size);
    imagefill($image, 0, 0, imagecolorallocate($image, 255, 255, 255));
    $height = (int) round($size * 0.88);
    $width = (int) round($height * imagesx($emblem) / imagesy($emblem));
    imagecopyresampled($image, $emblem, (int) (($size - $width) / 2), (int) (($size - $height) / 2), 0, 0, $width, $height, imagesx($emblem), imagesy($emblem));

    return $image;
}

imagepng(iconImage($emblem, 128), $public.'/favicon.png', 9);
imagepng(iconImage($emblem, 128), $public.'/assets/images/onecore-favicon.png', 9);
imagepng(iconImage($emblem, 180), $public.'/apple-touch-icon.png', 9);

$entries = '';
$pixels = '';
$sizes = [16, 32, 48];
$offset = 6 + count($sizes) * 16;
foreach ($sizes as $size) {
    ob_start();
    imagepng(iconImage($emblem, $size), null, 9);
    $png = ob_get_clean();
    $entries .= pack('CCCCvvVV', $size, $size, 0, 0, 1, 32, strlen($png), $offset);
    $pixels .= $png;
    $offset += strlen($png);
}
file_put_contents($public.'/favicon.ico', pack('vvv', 0, 1, count($sizes)).$entries.$pixels);

$encodedEmblem = base64_encode(file_get_contents($emblemPath));
file_put_contents($public.'/favicon.svg', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128"><rect width="128" height="128" rx="16" fill="white"/><image href="data:image/png;base64,'.$encodedEmblem.'" x="18" y="8" width="92" height="112"/></svg>'.PHP_EOL);

$share = imagecreatetruecolor(1200, 630);
imagefill($share, 0, 0, imagecolorallocate($share, 255, 255, 255));
imagecopyresampled($share, $logo, 189, 168, 0, 0, 822, 240, imagesx($logo), imagesy($logo));
$navy = imagecolorallocate($share, 11, 41, 66);
$blue = imagecolorallocate($share, 23, 107, 156);
imagefilledrectangle($share, 0, 514, 1199, 629, $navy);
imagefilledrectangle($share, 0, 506, 1199, 513, $blue);
// The existing logo is the focal point; the footer identifies the public website.
$label = 'onecorevisa.com';
$font = 5;
imagestring($share, $font, (int) ((1200 - imagefontwidth($font) * strlen($label)) / 2), 563, $label, imagecolorallocate($share, 255, 255, 255));
imagepng($share, $public.'/assets/images/onecore-og.png', 9);
echo "Generated favicon PNG/SVG/ICO, Apple touch icon, and 1200x630 Open Graph image.\n";
