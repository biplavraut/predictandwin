<?php

namespace App\Helper;

use Exception;

class ImageCrop
{
    protected $model;
    protected $image;

    public function __construct($model, $slug, $image)
    {
        $this->path = public_path() . '/storage/images/' . $model . '/' . $slug;
        $this->slug = $slug;
        $this->image = $image;
    }

    public function resizeCropImage($max_width, $max_height, $quality = 100)
    {
        if (!file_exists($this->path)) {
            \File::makeDirectory($this->path, $mode = 0777, true, true);
            \File::makeDirectory($this->path . '/thumbs', $mode = 0777, true, true);
        }

        // if Update or no image
        try {
            $extension = explode('/', explode(':', substr($this->image, 0, strpos($this->image, ';')))[1])[1];
        } catch (Exception $e) {
            return basename($this->image);
        }
        $imageName = $this->slug;
        $image_name = $imageName . '.' . $extension;
        \Image::make($this->image)->save($this->path . '/' . $image_name);

        $source_file = $this->path . '/' . $image_name;
        $dst_dir = $this->path . '/thumbs/' . $image_name;
        if ($extension != 'webp') {
            $this->convertImageToWebP($source_file, $this->path . "/" . $imageName . '.webp', $extension);
            unlink($this->path . "/" . $image_name);
            $image_name = $imageName . '.webp';
            $source_file = $this->path . '/' . $image_name;
        }
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];
        switch ($mime) {
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 9;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 90;
                break;
            case 'image/webp':
                $image_create = "imagecreatefromwebp";
                $image = "imagewebp";
                break;

            default:
                return false;
                break;
        }
        $dst_img = imagecreatetruecolor($max_width, $max_height);
        if ($extension == "gif" or $extension == "png") {
            imagecolortransparent($dst_img, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
            imagealphablending($dst_img, false);
            imagesavealpha($dst_img, true);
        }
        $src_img = $image_create($source_file);
        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if ($width_new > $width) {
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        } else {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if ($dst_img) imagedestroy($dst_img);
        if ($src_img) imagedestroy($src_img);
        return $image_name;
    }

    public function convertImageToWebP($source, $destination, $extension, $quality = 100)
    {
        if ($extension == 'jpeg' || $extension == 'jpg')
            $image = imagecreatefromjpeg($source);
        elseif ($extension == 'gif')
            $image = imagecreatefromgif($source);
        elseif ($extension == 'png')
            $image = imagecreatefrompng($source);
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        return imagewebp($image, $destination, $quality);
    }

    public function make_thumb($img_name, $filename, $new_w, $new_h)
    {
        $src_img = imagecreatefromwebp($img_name);

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);

        $ratio1 = $old_x / $new_w;
        $ratio2 = $old_y / $new_h;
        if ($ratio1 > $ratio2) {
            $thumb_w = $new_w;
            $thumb_h = $old_y / $ratio1;
        } else {
            $thumb_h = $new_h;
            $thumb_w = $old_x / $ratio2;
        }

        $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
        imagecolortransparent($dst_img, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
        imagealphablending($dst_img, false);
        imagesavealpha($dst_img, true);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);

        imagepng($dst_img, $filename);

        imagedestroy($dst_img);
        imagedestroy($src_img);
    }



    public function getExtension($str)
    {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
}
