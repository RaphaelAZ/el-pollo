<?php

namespace App\Sys;

class Config
{
    private int $minApiImageNumber = 1;
    private int $maxApiImageNumber = 87;

    // ---------------------------------------------------------------

    public function getMinApiImageNumber(): int
    {
        return $this->minApiImageNumber;
    }

    public function setMinApiImageNumber(int $minApiImageNumber): void
    {
        $this->minApiImageNumber = $minApiImageNumber;
    }

    public function getMaxApiImageNumber(): int
    {
        return $this->maxApiImageNumber;
    }

    public function setMaxApiImageNumber(int $maxApiImageNumber): void
    {
        $this->maxApiImageNumber = $maxApiImageNumber;
    }


}