<?php

/*
 * Poggit
 *
 * Copyright (C) 2016 Poggit
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace poggit\builder\lint;

class BuildResult {
    const LEVEL_OK = 0;
    const LEVEL_LINT = 1;
    const LEVEL_WARN = 2;
    const LEVEL_ERROR = 3;
    const LEVEL_BUILD_ERROR = 4;

    public static $names = [
        self::LEVEL_OK => "OK",
        self::LEVEL_LINT => "Lint",
        self::LEVEL_WARN => "Warning",
        self::LEVEL_ERROR => "Error",
        self::LEVEL_BUILD_ERROR => "Build Error",
    ];

    public static $states = [
        self::LEVEL_OK => "success",
        self::LEVEL_LINT => "success",
        self::LEVEL_WARN => "failure",
        self::LEVEL_ERROR => "failure",
        self::LEVEL_BUILD_ERROR => "error",
    ];

    /** @var int */
    public $worstLevel = BuildResult::LEVEL_OK;

    /** @var V2BuildStatus[] */
    public $statuses = [];

    public function addStatus(V2BuildStatus $status) {
        $this->statuses[] = $status;
        if($this->worstLevel < $status->level) $this->worstLevel = $status->level;
    }
}
