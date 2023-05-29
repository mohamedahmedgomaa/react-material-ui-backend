<?php

namespace App\Http\Base\Networks;

interface NetworkTypes
{
    const OPS = "ops";

    const LOCAL = "_local";
    const STAGE = "_staging";
    const PROD = "_production";
}
