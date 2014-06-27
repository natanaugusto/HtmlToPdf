<?php

/**
 * PHP Version 5
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Application;

use Exception;

/**
 * The HtmlToPdfTest class provides methods to build PDF documents from a HTML file or a 
 * string with HTML structure.
 * 
 * This class use WkHTMLToPDF tools.
 * http://wkhtmltopdf.org/
 * 
 * @author Natan Augusto <natanaugusto@gmail.com>
 */
class HtmlToPdf {

    /**
     * The path to the executable 
     * @var string
     */
    protected $exec = '/usr/local/bin/wkhtmltopdf';

    /**
     * The path of a temporary directory
     * @var string
     */
    protected $tmp = '/tmp';

    /**
     * Create an PDF document based on HTML
     * @param string $html String HTML
     * @param string $target Path where de PDF document will be created
     * @return string Name of document PDF created
     * @throws Exeption
     */
    public function create($html, $target) {
        if (!is_string($html)) {
            throw new Exeption('The $html parameter must be a string!');
        }

        self::isWritable(dirname($target));

        $html = $this->createHtmlFile($html);

        $cmd = "{$this->getExec()} $html $target";

        exec($cmd);

        return basename($target);
    }

    /**
     * Return the path of executable
     * @return string
     */
    public function getExec() {
        self::isExec($this->exec);

        return $this->exec;
    }

    /**
     * Set the path of executable
     * @param type $exec
     */
    public function setExec($exec) {
        self::isExec($exec);

        $this->exec = $exec;
    }

    /**
     * Return the path of temporary directory
     * @return string
     */
    public function getTmp() {
        self::isWritable($this->tmp);

        return $this->tmp;
    }

    /**
     * Set the path of temporary directory
     * @param string $tmp
     */
    public function setTmp($tmp) {
        self::isWritable($tmp);

        $this->tmp = $tmp;
    }

    /**
     * Generate an HTML file to be the base of the PDF
     * @param string $html
     * @return string
     */
    protected function createHtmlFile($html) {
        $file = null;

        do {
            $filename = $this->getTmp() . DIRECTORY_SEPARATOR . rand() . '.html';

            if (!file_exists($filename)) {
                $file = fopen($filename, 'w');
            }
        } while (is_null($file));

        fwrite($file, $html);
        fclose($file);

        return $filename;
    }

    /**
     * Verify if a string is a path of executable
     * @param string $exec
     * @throws Exception
     */
    protected static function isExec($exec) {
        if (!is_executable($exec)) {
            throw new Exception("The path({$exec}) is not an executable!");
        }
    }

    /**
     * Verify if a string is a path of writable directory
     * @param string $path String to be verified
     * @param boolean $dir Set if path will be verified like a directory
     * @throws Exception
     */
    protected static function isWritable($path, $dir = true) {
        if ($dir === true && !is_dir($path)) {
            throw new Exception("The path({$path} is not a directory!");
        }

        if (!is_writable($path)) {
            throw new Exception("The path({$path} is not a writable directory!");
        }
    }

}
