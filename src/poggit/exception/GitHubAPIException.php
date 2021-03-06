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

namespace poggit\exception;

class GitHubAPIException extends \RuntimeException {
    private $errorMessage;

    public function __construct(\stdClass $error) {
        assert(isset($error->message, $error->documentation_url));
        $message = $error->message;
        $clone = clone $error;
        unset($clone->message, $clone->documentation_url);
        if(count(get_object_vars($clone)) > 0) {
            $message .= json_encode($clone);
        }
        parent::__construct("GitHub API error: " . $message);
        $this->errorMessage = $error->message;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }
}
