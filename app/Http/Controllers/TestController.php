<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Permission;
use File;
use Illuminate\Routing\Route;

class TestController extends Controller
{
    public function index() {
        return "ok";
    }

    /**
     *
     */
    public function scanPermissions() {

        $directory = app_path() . DIRECTORY_SEPARATOR . 'Http/Controllers';
        $permissions = [];

        try {
            $files = File::allFiles($directory);
            foreach ($files as $file) {

                $fileContent = file_get_contents($file);
                preg_match_all('/function\s+([a-zA-Z]+)(?:\s+)?\(/', $fileContent, $matches);
                $controller = str_replace('Controller.php', '', basename($file));
                $methods = $matches[1];

                foreach ($methods as $method) {
                    $permissions[] = strtolower($controller . '_' . $method);
                }
            }

            if(count($permissions)) {
                $this->storePermissions($permissions);
            }
        }  catch (Illuminate\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }
    }

    /**
     * @param array $permissions
     */
    private function storePermissions(array $permissions) {
        foreach ($permissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();

            if(!$permission) {
                $permission = new Permission;
                $permission->name = $permissionName;
                $permission->save();
                echo $permission->name . ' +<br>';
            } else {
                echo $permission->name . ' /<br>';
            }
        }
    }
}
