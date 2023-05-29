<?php

namespace App\Http\modules\user\enums;

use MyCLabs\Enum\Enum;

class ResetRequestTypes extends Enum
{
    const  check = "check";
    const  validate = "validate";
    const  reset = "reset";
}
