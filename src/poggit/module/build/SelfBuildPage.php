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

namespace poggit\module\build;

use poggit\Poggit;
use poggit\session\SessionUtils;

class SelfBuildPage extends RepoListBuildPage {
    public function __construct() {
        if(!SessionUtils::getInstance()->isLoggedIn()) {
            throw new RecentBuildPage;
        }
        parent::__construct();
    }

    public function getTitle() : string {
        return "My Projects";
    }

    public function output() {
        ?>
        <p class="remark">Enable <em>Poggit Build</em> for more repos at <a href="<?= Poggit::getRootPath() ?>">Poggit
                homepage</a></p>
        <p class="remark">Customize your projects by editing the <code>.poggit/.poggit.yml</code> in your project.</p>
        <hr>
        <?php
        parent::output();
    }

    /**
     * @return \stdClass[]
     */
    protected function getRepos() : array {
        return $this->getReposByGhApi("user/repos?per_page=50", SessionUtils::getInstance()->getAccessToken());
    }

    protected function throwNoRepos() {
        $path = Poggit::getRootPath();
        throw new RecentBuildPage(<<<EOD
<p>You don't have any repos with Poggit CI enabled. Please visit
<a href="$path">Poggit homepage</a> to enable repos.</p>
EOD
        );
    }

    protected function throwNoProjects() {
        $path = Poggit::getRootPath();
        throw new RecentBuildPage(<<<EOD
<p>You don't have any repos with Poggit CI enabled. Please visit
<a href="$path">Poggit homepage</a> to enable repos.</p>
EOD
        );
    }
}
