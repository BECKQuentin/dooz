<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{


    public function getFilters(): array
    {
        return [
            new TwigFilter('thumbnailRoom', [$this, 'getThumbnailRoom']),
            new TwigFilter('bannerRoom', [$this, 'getBannerRoom']),
            new TwigFilter('clockRoom', [$this, 'getClockRoom']),
            new TwigFilter('partnerThumbnail', [$this, 'getPartnerThumbnail']),
            new TwigFilter('short', [$this, 'setShort']),

        ];
    }

//    public function verifyAdress($address) {
//        if ($address == 'malleus') {
//
//        }
//    }


    public function getThumbnailRoom($thumbnail): string
    {
        return '/' . 'upload' . '/' . 'escape' . '/' . 'thumbnail' . '/' . $thumbnail;
    }
    public function getBannerRoom($banner): string
    {
        return '/' . 'upload' . '/' . 'escape' . '/' . 'banner' . '/' . $banner;
    }
    public function getClockRoom($images): string
    {
        return '/' . 'upload' . '/' . 'escape' . '/' . 'clock' . '/' . $images;
    }
    public function getPartnerThumbnail($images): string
    {
        return '/' . 'upload' . '/' . 'partners' . '/' . $images;
    }


    public function setShort(string $str): string
    {
        return strlen($str) > 50 ? substr($str,0,50)."..." : $str;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }
}
