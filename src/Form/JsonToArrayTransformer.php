<?php

namespace App\Form;


use Symfony\Component\Form\DataTransformerInterface;

class JsonToArrayTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        // Transform an array to JSON when rendering the form
        return json_encode($value);
    }

    public function reverseTransform($value)
    {
        // Transform JSON to an array when submitting the form
        return json_decode($value, true);
    }
}
