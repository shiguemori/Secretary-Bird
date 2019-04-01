<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ImagemService
 * @package App\Services
 */
class ImagemService
{
    public $Uploaded;
    private $Name;
    private $Width;
    private $Folder;
    private static $BaseDir;

    /**
     * ImagemService constructor.
     */
    public function __construct()
    {
        self::$BaseDir = env('SIMBOLIC_LINK', 'storage') . "/" . env('STORAGE_CLINICA', 'base');
    }

    /**
     * @param array $Image
     * @param $Name
     * @param $Width
     * @param $Folder
     */
    public function Image(array $Image, $Name, $Width, $Folder)
    {
        $this->Name = $Name;
        $this->Width = $Width;
        $this->Folder = $Folder;
        foreach ($Image as $File) {
            $this->setFileName($File);
        }
        return true;
    }

    /**
     * Verifica se o arquivo já existe no diretorio e cria um novo hash no nome
     * @param object $File
     */
    private function setFileName($File)
    {
        $SubFolder = Str::slug($this->Name);
        $Name = $SubFolder;
        $file_extesion = $File->extension();
        $FileName = "{$Name}" . ".{$file_extesion}";
        if (Storage::disk('public')->exists($this->Folder . '/' . $SubFolder . '/' . $FileName)) {
            $FileName = "{$Name}-" . substr(md5(bcrypt($Name)), 0, 5) . ".{$file_extesion}";
        }
        $this->UploadImage($File, $SubFolder . '/' . $FileName);
    }

    /**
     * Realiza o upload de imagens redimensionadas
     * @param object $File
     * @param $FileName
     */
    private function UploadImage($File, $FileName)
    {
        if (!$Upload = $File->storeAs($this->Folder, $FileName, 'public')) {
            return false;
        } else {
            $type = getimagesize($File->path());
            $type = $type['mime'];

            switch ($type):
                case 'image/jpg':
                case 'image/jpeg':
                case 'image/pjpeg':
                    $imagem = imagecreatefromjpeg($File->path());
                    break;
                case 'image/png':
                case 'image/x-png':
                    $imagem = imagecreatefrompng($File->path());
                    break;
            endswitch;

            if (isset($imagem)) {
                $x = imagesx($imagem);
                $y = imagesy($imagem);
                $ImageX = ($this->Width < $x ? $this->Width : $x);
                $ImageH = ($ImageX * $y) / $x;

                $NewImage = imagecreatetruecolor($ImageX, $ImageH);
                imagealphablending($NewImage, false);
                imagesavealpha($NewImage, true);
                imagecopyresampled($NewImage, $imagem, 0, 0, 0, 0, $ImageX, $ImageH, $x, $y);

                switch ($type):
                    case 'image/jpg':
                    case 'image/jpeg':
                    case 'image/pjpeg':
                        imagejpeg($NewImage, self::$BaseDir . '/' . $Upload);
                        break;
                    case 'image/png':
                    case 'image/x-png':
                        imagepng($NewImage, self::$BaseDir . '/' . $Upload);
                        break;
                endswitch;

                if (!$NewImage) {
                    Storage::disk('public')->delete($Upload);
                    flash('Algumas imagens não puderam ser enviadas, verifique.')->error();
                }
                $this->Uploaded[] = $Upload;
                imagedestroy($imagem);
                imagedestroy($NewImage);
            }
        }
    }

    /**
     * Método para ser chamado caso exista algum problema na sua sequenência do código
     * Assim evitamos que as imagens que eforam enviadas e tratadas fiquem no servidor ocupando espaço
     */
    public function deleteIfError()
    {
        foreach ($this->Uploaded as $upload) {
            Storage::disk('public')->delete($upload);
        }
        flash('Houve algum problema, e as imagens foram deletadas')->info();
    }
}