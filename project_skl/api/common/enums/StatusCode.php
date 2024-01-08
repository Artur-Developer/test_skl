<?php

namespace api\common\enums;

class StatusCode
{
    const SUCCESS = 200;
    const BAD_REQUEST = 400;
    const NOT_FOUND = 404;
    const VALIDATION_FAILED = 422;
    const SERVER_ERROR = 500;
}