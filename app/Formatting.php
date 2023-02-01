<?php

namespace App;

trait Formatting
{
    /** Remove spaces and dashes
     * @param string $phone
     * @return string
     */
    public function modifyPhone(string $phone): string
    {
        return str_replace(['-', ' '], '', $phone);
    }
}
