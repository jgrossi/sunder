<?php

class SunderApp
{
    protected $themeDirectory;
    protected $folders;

    public function __construct($themeDirectory, array $folders = null)
    {
        $this->setThemeDirectory($themeDirectory);
        $folders = $folders ?: [];
        $this->initializeFoldersName($folders);
        $this->setup();
    }

    protected function initializeFoldersName(array $folders)
    {
        $default = [
            'assets' =>'assets',
            'js' => 'assets/js',
            'css' => 'assets/css',
            'img' => 'assets/img',
        ];

        $this->folders = array_merge($default, $folders);
    }

    /**
     * @return mixed
     */
    public function getThemeDirectory()
    {
        return $this->themeDirectory;
    }

    /**
     * @param mixed $themeDirectory
     */
    public function setThemeDirectory($themeDirectory)
    {
        $this->themeDirectory = rtrim($themeDirectory, '/');
    }

    /**
     * @return array
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * @param array $folders
     */
    public function setFolders(array $folders)
    {
        $this->initializeFoldersName($folders);
    }

    public function setup()
    {
        $baseDir = $this->getThemeDirectory();
        $folders = $this->getFolders();

        foreach ($folders as $folder) {
            if ($folder) {
                $folder = rtrim($folder, '/');
                $folder = $baseDir.DIRECTORY_SEPARATOR.$folder;
                if (!is_dir($folder)) {
                    mkdir($folder, 0755, true);
                }
            }
        }
    }

    public function run()
    {
        $path = $this->getThemeDirectory();
        $dispatcher = new Dispatcher($path);
    }
}