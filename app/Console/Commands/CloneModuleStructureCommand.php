<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class CloneModuleStructureCommand extends Command
{
    protected $signature = 'module:clone-structure
                            {sourceModule : The name of the module to copy from}
                            {targetModule : The name of the module to copy into}
                            {newClassName : The new class name to be applied to the cloned module}';

    protected $description = 'Clone an entire module structure from one module to another and rename class names and file names accordingly';

    protected Filesystem $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sourceModule = Str::of($this->argument('sourceModule'))->studly();
        $targetModule = Str::of($this->argument('targetModule'))->studly();
        $newClassName = Str::of($this->argument('newClassName'))->studly();

        $sourcePath = module_path($sourceModule);
        $targetPath = module_path($targetModule);

        if (!$this->files->isDirectory($sourcePath)) {
            $this->error("The source module {$sourceModule} does not exist.");
            return;
        }

        // Copy files selectively, skipping specific directories or files
        $this->copyDirectoryWithExclusions($sourcePath, $targetPath, [
            'Config',         // Example directory to skip
            'Providers',         // Example directory to skip
            'Routes',         // Example directory to skip
            'composer.json',    // Example file to skip
            'module.json',    // Example file to skip
        ]);


        // Process files to replace class names and module references
        $this->processDirectory($targetPath, $sourceModule, $targetModule, $newClassName);

        $this->info("Module {$targetModule} has been created successfully with class name {$newClassName}.");
    }

    /**
     * Recursively process directory contents.
     */
    protected function processDirectory($path, $sourceModule, $targetModule, $newClassName)
    {
        $files = $this->files->allFiles($path);

        foreach ($files as $file) {
            $content = $this->files->get($file);
            // Replace occurrences in file content
            $content = $this->replaceContent($content, $sourceModule, $targetModule, $newClassName);

            // Rename the file if it contains the source module name
            $newFilePath = $this->replacePath($file->getPathname(), $sourceModule, $newClassName);

            // Ensure the directory exists for the new file path
            $this->files->ensureDirectoryExists(dirname($newFilePath));

            // Save the modified content to the new file path
            $this->files->put($newFilePath, $content);

            // Delete the original file if the path was changed
            if ($newFilePath !== $file->getPathname()) {
                $this->files->delete($file);
            }
        }
    }

    /**
     * Replace content in files.
     */
    protected function replaceContent($content, $sourceModule, $targetModule, $newClassName)
    {
        $sourceModule = $sourceModule->value;
        $newClassName = $newClassName->value;
        $targetModuleName = Str::of($targetModule)->snake()->lower()->plural()->value;

        $replacements = [
            // Replace class names
            $sourceModule => $newClassName,

            // Replace variable names and other references
            Str::of($sourceModule)->studly()->plural()->value =>
            Str::of($newClassName)->studly()->plural()->value,

            Str::of($sourceModule)->studly()->singular()->value =>
            Str::of($newClassName)->studly()->singular()->value,

            Str::of($sourceModule)->camel()->plural()->prepend('$')->value =>
            Str::of($newClassName)->snake()->plural()->prepend('$')->value,

            Str::of($sourceModule)->camel()->singular()->prepend('$')->value =>
            Str::of($newClassName)->snake()->singular()->prepend('$')->value,

            Str::of($sourceModule)->snake()->lower()->plural()->value =>
            $newModuleName = Str::of($newClassName)->snake()->lower()->plural()->value,

            Str::of($sourceModule)->snake()->lower()->singular()->value =>
            Str::of($newClassName)->snake()->lower()->singular()->value,

            // Replace module references
            $sourceModule => $newClassName,
            "Modules\\$newClassName\\" => "Modules\\$targetModule->value\\",
            '$module_name = ' . "'$newModuleName'" . ';' => '$module_name = ' . "'$targetModuleName'" . ';'
        ];

        foreach ($replacements as $from => $to) {
            $content = str_replace($from, $to, $content);
        }

        return $content;
    }

    /**
     * Replace source module name in file paths.
     */
    protected function replacePath($path, $sourceModule, $newClassName)
    {

        $sourceModule = $sourceModule->value;
        $newClassName = $newClassName->value;

        $replacements = [
            // Replace class names
            $sourceModule => $newClassName,

            // Replace variable names and other references
            Str::of($sourceModule)->studly()->plural()->value =>
            Str::of($newClassName)->studly()->plural()->value,

            Str::of($sourceModule)->studly()->singular()->value =>
            Str::of($newClassName)->studly()->singular()->value,

            Str::of($sourceModule)->camel()->plural()->prepend('$')->value =>
            Str::of($newClassName)->snake()->plural()->prepend('$')->value,

            Str::of($sourceModule)->camel()->singular()->prepend('$')->value =>
            Str::of($newClassName)->snake()->singular()->prepend('$')->value,

            Str::of($sourceModule)->snake()->lower()->plural()->value =>
            Str::of($newClassName)->snake()->lower()->plural()->value,

            Str::of($sourceModule)->snake()->lower()->singular()->value =>
            Str::of($newClassName)->snake()->lower()->singular()->value,

            // Replace module references
            $sourceModule => $newClassName,
        ];

        foreach ($replacements as $from => $to) {
            $path = str_replace($from, $to, $path);
        }

        return $path;
    }




    protected function copyDirectoryWithExclusions($sourcePath, $targetPath, array $exclusions = [])
    {
        $items = $this->files->allFiles($sourcePath);

        foreach ($items as $item) {
            $relativePath = $item->getRelativePathname();

            // Check if the current file or directory should be skipped
            foreach ($exclusions as $exclude) {
                if (Str::contains($relativePath, $exclude)) {
                    $this->info("Skipping: {$relativePath}");
                    continue 2; // Skip this file and continue with the next iteration
                }
            }

            // Copy the file to the new location
            $targetFilePath = $targetPath . '/' . $relativePath;
            $this->files->ensureDirectoryExists(dirname($targetFilePath));
            $this->files->copy($item->getPathname(), $targetFilePath);
        }
    }
}
