<?php

namespace App\Http\Modules\Users\Enums;

use MyCLabs\Enum\Enum;

class ResetRequestTypes extends Enum
{
    const  check = "check";
    const  validate = "validate";
    const  reset = "reset";
}
