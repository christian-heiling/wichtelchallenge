<?php

namespace App;

class Role extends \TCG\Voyager\Models\Role {

    public function toHtml() {
        return $this->display_name;
    }
}