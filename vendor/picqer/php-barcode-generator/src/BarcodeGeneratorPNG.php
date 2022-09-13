<?php

namespace Picqer\Barcode;

use Imagick;
use imagickdraw;
use imagickpixel;
use Picqer\Barcode\Exceptions\BarcodeException;

class BarcodeGeneratorPNG extends BarcodeGenerator
{
    protected $useImagick = true;

    public function __construct()
    {
        // Auto switch between GD and Imagick based on what is installed
        if (extension_loaded('imagick')) {
            $this->useImagick = true;
        } elseif (function_exists('imagecreate')) {
            $this->useImagick = false;
        } else {
            throw new BarcodeException('Neither gd-lib or imagick are installed!');
        }
    }

    /**
     * Force the use of Imagick image extension
     */
    public function useImagick()
    {
        $this->useImagick = true;
    }

    /**
     * Force the use of the GD image library
     */
    public function useGd()
    {
        $this->useImagick = false;
    }

    /**
     * Return a PNG image representation of barcode (requires GD or Imagick library).
     *
     * @param string $barcode code to print
     * @param string $type type of barcode:
     * @param int $widthFactor Width of a single bar element in pixels.
     * @param int $height Height of a single bar element in pixels.
     * @param array $foregroundColor RGB (0-255) foreground color for bar elements (background is transparent).
     * @return string image data or false in case of error.
     */
    public function getBarcode($code, $type, int $widthFactor = 2, int $totalHeight = 30, array $color = [0, 0, 0])
    {
        $barcodeData = $this->getBarcodeData($code, $type);

        // calculate image size
        $width = ($barcodeData->getWidth() * $widthFactor);
        $height = $totalHeight;

        if (function_exists('imagecreate')) {
            // GD library
            $imagick = false;
            $png = imagecreate($width + 45, $height + 40); // +20 (+)
            $colorBackground = imagecolorallocate($png, 255, 255, 255);
            imagecolortransparent($png, $colorBackground);
            $colorForeground = imagecolorallocate($png, $color[0], $color[1], $color[2]);
        } elseif (extension_loaded('imagick')) {
            $imagick = true;
            $colorForeground = new \imagickpixel('rgb(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ')');
            $png = new \Imagick();
            $png->newImage($width + 45, $height + 40, 'none', 'png'); // +20 (+)
            $imageMagickObject = new \imagickdraw();
            $imageMagickObject->setFillColor($colorForeground);
        } else {
            return false;
        }

        // print bars
        $positionHorizontal = 0;
        foreach ($barcodeData->getBars() as $bar) {
            $bw = round(($bar->getWidth() * $widthFactor), 3);
            $bh = round(($bar->getHeight() * $totalHeight / $barcodeData->getHeight()), 3);
            if ($bar->isBar()) {
                // $y = round(($bar->getPositionVertical() * $totalHeight / $barcodeData->getHeight()), 3);
                $y = ($totalHeight / 2) + 5;
                // draw a vertical bar
                if ($imagick && isset($imageMagickObject)) {
                    $imageMagickObject->rectangle($positionHorizontal, $y, ($positionHorizontal + $bw), ($y + $bh));
                } else {
                    imagefilledrectangle($png, $positionHorizontal, $y, ($positionHorizontal + $bw) - 1, ($y + $bh),
                        $colorForeground);
                }
            }
            $positionHorizontal += $bw;
        }

        if ($imagick && isset($imageMagickObject)) {
            $draw = new ImagickDraw();
            $draw->setFillColor('black');

            /* Font properties */
            $draw->setFont('Bookman-DemiItalic');
            $draw->setFontSize(5);

            // Write the barcode's code, change $code to write other text
            $imageMagickObject->annotateImage($draw, 0, $height + 5, 0, $code);
        } else {
            // Detect center position
            $font = 7;
            $font_width = ImageFontWidth($font);
            $font_height = ImageFontHeight($font);
            $text_width = $font_width * strlen($code);
            $position_center = ceil(($width - $text_width) / 2);
            $position_left = 0;

            // Default font
            // Write the barcode's code, change $code to write other text
            imagestring($png, 7, $position_left, $height + 16, $code, imagecolorallocate($png, 0, 0, 0));
            imagestring($png, 7, $position_left, $height - 22, "sdoin.edts #", imagecolorallocate($png, 0, 0, 0));

            // For custom font specify path to font file
            $fontPath = dirname(__FILE__) . '/Roboto-Regular.ttf';
            // imagettftext($png, 12, 0, $position_left, $height + 35, imagecolorallocate($png, 0, 0, 0), $fontPath, $code);
        }

        ob_start();
        if ($imagick && isset($imageMagickObject)) {
            $png->drawImage($imageMagickObject);
            echo $png;
        } else {
            imagepng($png);
            imagedestroy($png);
        }
        $image = ob_get_clean();

        return $image;
    }

    protected function createGdImageObject(int $width, int $height)
    {
        $image = imagecreate($width, $height);
        $colorBackground = imagecolorallocate($image, 255, 255, 255);
        imagecolortransparent($image, $colorBackground);

        return $image;
    }

    protected function createImagickImageObject(int $width, int $height, string $barcode): Imagick
    {
        $image = new Imagick();

        $draw = new ImagickDraw();
        $draw->setFillColor('black');
        $draw->setFont('Bookman-DemiItalic');
        $draw->setFontSize(5);

        $image->newImage($width, $height, 'none', 'PNG');
        $image->annotateImage($draw, 0, $height + 5, 0, $barcode);

        return $image;
    }

    protected function generateGdImage($image)
    {
        imagepng($image);
        imagedestroy($image);
    }
}
