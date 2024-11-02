<?php

namespace App\Enums;

enum EmploymentType: string
{
    case FULL_TIME = 'Full Time';
    case PART_TIME = 'Part Time';
    case INTERNSHIP = 'Internship';
    case CONTRACT = 'Contract';
    case FREELANCE = 'Freelance';
    case REMOTE = 'Remote';
    case OTHER = 'Other';
    public function getLabel():string
    {
        return match($this) {
            self::FULL_TIME => 'Full Time',
            self::PART_TIME => 'Part Time',
            self::INTERNSHIP => 'Internship',
            self::CONTRACT => 'Contract',
            self::FREELANCE => 'Freelance',
            self::REMOTE => 'Remote',
            self::OTHER => 'Other'
        };
    }
}

?>
