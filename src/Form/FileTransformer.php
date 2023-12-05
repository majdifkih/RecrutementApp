<?php
namespace App\Form;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\HttpFoundation\File\File;

class FileTransformer implements DataTransformerInterface
{
    public function transform($file)
    {
        if ($file instanceof File) {
            return $file;
        }

        return null;
    }

    public function reverseTransform($path)
    {
        if (!$path) {
            return null;
        }

        try {
            return new File($path);
        } catch (\Exception $e) {
            throw new TransformationFailedException('Could not transform the path to a File object: ' . $e->getMessage());
        }
    }
}