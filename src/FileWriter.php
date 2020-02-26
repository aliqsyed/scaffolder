<?php

namespace Aliqsyed\Scaffolder;

class FileWriter
{
    /**
     * The list of files created
     */
    protected $files_created;

    /**
     * The list of files appended
     */
    protected $files_appended;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->files_created = [];
        $this->files_appended = [];
    }

    /**
     * Check and see if the directory exists and
     * if it doesn't then create it.
     *
     * @param string $dir
     * @return void
     */
    public function checkIfDirExists($dir): void
    {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
    }

    /**
     * Checks if the file exists already
     *
     * @param string $dir
     * @param string $filename
     * @return bool
     */
    public function fileExists($dir, $filename):bool
    {
        return file_exists("$dir/$filename");
    }

    /**
     * List of files created
     *
     * @return array
     */
    public function filesCreated():array
    {
        return $this->files_created;
    }

    /**
     * List of files that were appended to
     *
     * @return array
     */
    public function filesAppended(): array
    {
        return $this->files_appended;
    }

    /**
     * write content to file
     *
     * @param string $dir
     * @param string $filename
     * @param string $content
     * @return void
     */
    public function writeToFile($dir, $filename, $content) :void
    {
        $this->checkIfDirExists($dir);
        file_put_contents("$dir/$filename", $content);
        $this->files_created[] = "$dir/$filename";
    }

    /**
     * Append given content to a file, only
     * if the content is not there already
     *
     * @param string $dir
     * @param string $filename
     * @param string $content
     * @return bool
     */
    public function appendToFile($dir, $filename, $content) : bool
    {
        if ($this->fileExists($dir, $filename)) {
            if ($this->contentNotInFileAlready($dir, $filename, $content)) {
                file_put_contents("$dir/$filename", $content, FILE_APPEND);
                $this->files_appended[] = "$dir/$filename";

                return true;
            }
        }

        return false;
    }

    /**
     * Check if the content is in file already
     *
     * @param string $dir
     * @param string $filename
     * @param string $content
     * @return bool
     */
    public function contentNotInFileAlready($dir, $filename, $content) :bool
    {
        return  strpos(file_get_contents("$dir/$filename"), $content) === false;
    }
}
