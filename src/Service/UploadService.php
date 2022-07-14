<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\AsciiSlugger;

class UploadService
{
    private string $uploadDirectory;

    public function __construct(string $uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
    }



    /*Création de nom et telechargement des images*/
    public function uploadThumbnailRoom(UploadedFile $images, $entity)
    {
        $fileName = 'ep'.$entity->getEpisode().'-'.'thumbnail'.'.'.$images->getClientOriginalExtension();

        $path = $this->uploadDirectory . "/" . $entity->getThumbnailImageDirectory();

        $images->move($path, $fileName);

        return $fileName;
    }
    public function uploadBannerRoom(UploadedFile $images, $entity)
    {
        $fileName = 'ep'.$entity->getEpisode().'-'.'banner'.'.'.$images->getClientOriginalExtension();

        $path = $this->uploadDirectory . "/" . $entity->getBannerImageDirectory();

        $images->move($path, $fileName);

        return $fileName;
    }
    public function uploadClockRoom(UploadedFile $images, $entity)
    {
        $fileName = 'ep'.$entity->getEpisode().'-'.'clock'.'.'.$images->getClientOriginalExtension();

        $path = $this->uploadDirectory . "/" . $entity->getClockImageDirectory();

        $images->move($path, $fileName);

        return $fileName;
    }

    public function uploadThumbnailPartner(UploadedFile $images, $entity)
    {
        $newName = str_replace(' ', '', $entity->getName());
        $fileName = $newName . '_thumbnail' . '.' . $images->getClientOriginalExtension();

        $path = $this->uploadDirectory . "/" . "partners";

        $images->move($path, $fileName);

        return $fileName;
    }






    private function createFileName(UploadedFile $file): string
    {
        $slugger = new AsciiSlugger();
        $fileName = $slugger->slug($file->getClientOriginalName())->lower();
        $fileName = explode('-', $fileName);
        $fileName = array_slice($fileName, 0, -1);
        $fileName = join('-', $fileName);
        $fileName .= '.' . uniqid() . '.' . $file->guessExtension();

        return $fileName;
    }
}