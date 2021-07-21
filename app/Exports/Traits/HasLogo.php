<?php

namespace App\Exports\Traits;

use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

trait HasLogo
{
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logo.jpeg'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A1');

        return $drawing;
    }
}
