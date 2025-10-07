<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class MigrateController extends Controller {
    public function run()
    {
        $this->call->library('Migration');
        $this->Migration->migrate();
        echo "Migrations run successfully.";
    }
}
