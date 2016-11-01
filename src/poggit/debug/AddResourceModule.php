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

namespace poggit\debug;

use poggit\Poggit;

class AddResourceModule extends DebugModule {
    public function getName() : string {
        return Poggit::getSecret("meta.debugPrefix") . ".addResource";
    }

    public function output() {
        ?>
        <html>
        <head>
            <title>DEBUG - Add resource</title>
            <?php $this->headIncludes("N/A", "Debug page") ?>
        </head>
        <body>
        <?php $this->bodyHeader() ?>
        <div id="body">
            <form method="post" enctype="multipart/form-data"
                  action="<?= Poggit::getRootPath() ?><?= Poggit::getSecret("meta.debugPrefix") ?>.addResource.recv">
                <table>
                    <tr>
                        <td>Type</td>
                        <td><input type="text" name="type"></td>
                    </tr>
                    <tr>
                        <td>MIME-type</td>
                        <td><input type="text" name="mimeType"></td>
                    </tr>
                    <tr>
                        <td>Expiry seconds</td>
                        <td><input type="number" name="expiry" value="315360000"</td>
                    </tr>
                    <tr>
                        <td>JSON-encoded access filters</td>
                        <td><textarea name="accessFilters" cols="100" rows="20">[]</textarea></td>
                    </tr>
                    <tr>
                        <td>Upload resource file</td>
                        <td><input type="file" name="file"></td>
                    </tr>
                </table>
                <p><input type="submit" value="Submit"></p>
            </form>
        </div>
        </body>
        </html>
        <?php
    }
}
