<?php

namespace App\Services;

class ChangeColorsService
{
    public function hexToHsl($hex) {
        // Remove the '#' character if present
        $hex = str_replace('#', '', $hex);

        // Convert the hex color to RGB values
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        // Normalize the RGB values to the range of 0-1
        $r /= 255;
        $g /= 255;
        $b /= 255;

        // Find the minimum and maximum values among RGB channels
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        // Calculate the lightness value
        $l = ($max + $min) / 2;

        // Check if it's a grayscale color
        if ($max === $min) {
            // Set the hue and saturation to 0 for grayscale
            $h = $s = 0;
        } else {
            // Calculate the saturation value
            if ($l < 0.5) {
                $s = ($max - $min) / ($max + $min);
            } else {
                $s = ($max - $min) / (2 - $max - $min);
            }

            // Calculate the hue value
            $delta = $max - $min;

            if ($r === $max) {
                $h = ($g - $b) / $delta;
            } elseif ($g === $max) {
                $h = 2 + ($b - $r) / $delta;
            } else {
                $h = 4 + ($r - $g) / $delta;
            }

            $h *= 60;
            if ($h < 0) {
                $h += 360;
            }
        }

        // Round the HSL values to two decimal places
        $h = round($h, 2);
        $s = round($s, 2) * 100;
        $l = round($l, 2) * 100;

        return "$h $s% $l%";
        // Return the HSL values as an associative array
//        return ['h' => $h, 's' => $s, 'l' => $l];/
    }

    public function convertHSLtoRGBorHEX($hsl, $toHex = true)
    {
        $hslmodify = str_replace('%', '', $hsl);

        $separate = explode(' ', $hslmodify);

        $h = $separate[0];
        $s = $separate[1];
        $l = $separate[2];


        $h /= 360;
        $s /=100;
        $l /=100;

        $r = $l;
        $g = $l;
        $b = $l;
        $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);
        if ($v > 0){
            $m;
            $sv;
            $sextant;
            $fract;
            $vsf;
            $mid1;
            $mid2;

            $m = $l + $l - $v;
            $sv = ($v - $m ) / $v;
            $h *= 6.0;
            $sextant = floor($h);
            $fract = $h - $sextant;
            $vsf = $v * $sv * $fract;
            $mid1 = $m + $vsf;
            $mid2 = $v - $vsf;

            switch ($sextant)
            {
                case 0:
                    $r = $v;
                    $g = $mid1;
                    $b = $m;
                    break;
                case 1:
                    $r = $mid2;
                    $g = $v;
                    $b = $m;
                    break;
                case 2:
                    $r = $m;
                    $g = $v;
                    $b = $mid1;
                    break;
                case 3:
                    $r = $m;
                    $g = $mid2;
                    $b = $v;
                    break;
                case 4:
                    $r = $mid1;
                    $g = $m;
                    $b = $v;
                    break;
                case 5:
                    $r = $v;
                    $g = $m;
                    $b = $mid2;
                    break;
            }
        }
        $r = round($r * 255, 0);
        $g = round($g * 255, 0);
        $b = round($b * 255, 0);

        if ($toHex) {
            $r = ($r < 15)? '0' . dechex($r) : dechex($r);
            $g = ($g < 15)? '0' . dechex($g) : dechex($g);
            $b = ($b < 15)? '0' . dechex($b) : dechex($b);
            return "#$r$g$b";
        } else {
            return [$r, $g, $b];
        }
    }

    public function changeTextColor($color)
    {
        $rgba = $this->convertHSLtoRGBorHEX($color, false);

        $result = (($rgba[0] * 299) + ($rgba[1] * 587) + ($rgba[2] * 114)) / 1000;

        if($result > 125) {
            return '0, 0%, 0%';
        } else {
            return '0, 0%, 100%';
        }
    }

}
