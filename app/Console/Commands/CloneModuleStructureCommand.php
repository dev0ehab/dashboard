<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CloneModuleStructureCommand extends Command
{
    protected $signature = 'module:clone-structure
                            {sourceModule : The name of the module to copy from}
                            {targetModule : The name of the module to copy into}
                            {newClassName : The new class name to be applied to the cloned module}';

    protected $description = 'Clone an entire module structure from one module to another and rename class names and file names accordingly';

    public function handle()
    {
        // Get module names from the input arguments
        $sourceModule = Str::studly($this->argument('sourceModule'));
        $targetModule = Str::studly($this->argument('targetModule'));
        $newClassName = Str::studly($this->argument('newClassName'));

        $sourcePath = base_path("Modules/{$sourceModule}");
        $targetPath = base_path("Modules/{$targetModule}");

        // Check if the source module exists
        if (!File::exists($sourcePath)) {
            $this->error("The source module [{$sourceModule}] does not exist.");
            return;
        }

        // Ensure the target module directory exists
        if (!File::exists($targetPath)) {
            File::makeDirectory($targetPath, 0755, true);
        }

        // Copy the source module structure to the target module
        File::copyDirectory($sourcePath, $targetPath);

        // Replace class names and file names in the copied files
        $this->replaceClassNames($sourceModule, $targetModule, $newClassName, $targetPath);

        $this->info("The module structure of [{$sourceModule}] has been cloned into [{$targetModule}], with class names changed to [{$newClassName}].");
    }

    protected function replaceClassNames($sourceModule, $targetModule, $newClassName, $path)
    {
        $files = File::allFiles($path);

        foreach ($files as $file) {
            $contents = File::get($file);

            // Replace class names in the file content
            $contents = preg_replace_callback('/\s+' . preg_quote($sourceModule, '/') . '(\w+)/', function ($matches) use ($newClassName) {
                return ' ' . $newClassName . $matches[1];
            }, $contents);

            $contents = preg_replace_callback('/class\s+' . preg_quote($sourceModule, '/') . '(\w+)/', function ($matches) use ($newClassName) {
                return 'class ' . $newClassName . $matches[1];
            }, $contents);

            // Replace the source module name with the new class name (in namespaces, etc.)
            $contents = str_replace(
                $sourceModule,
                $targetModule,
                $contents
            );

            // Rename the file based on the new class name
            $newFileName = str_replace($sourceModule, $targetModule, $file->getFilename());
            if ($file->getFilename() !== $newFileName) {
                File::move($file->getRealPath(), $file->getPath() . DIRECTORY_SEPARATOR . $newFileName);
            }

            // Write the updated contents back to the file
            File::put($file, $contents);
        }
    }



    protected function replace($from, $to, &$str)
    {
        $str = Str::of($str)->replace(
            Str::of($from)->studly()->plural(),
            Str::of($to)->studly()->plural()
        );

        $str = Str::of($str)->replace(
            Str::of($from)->studly()->singular(),
            Str::of($to)->studly()->singular()
        );

        $str = Str::of($str)->replace(
            Str::of($from)->camel()->plural()->prepend('$'),
            Str::of($to)->snake()->plural()->prepend('$')
        );

        $str = Str::of($str)->replace(
            Str::of($from)->camel()->singular()->prepend('$'),
            Str::of($to)->snake()->singular()->prepend('$')
        );

        $str = Str::of($str)->replace(
            Str::of($from)->snake()->lower()->plural(),
            Str::of($to)->snake()->lower()->plural()
        );

        $str = Str::of($str)->replace(
            Str::of($from)->snake()->lower()->singular(),
            Str::of($to)->snake()->lower()->singular()
        );

        $str = (string)$str;
    }
}
