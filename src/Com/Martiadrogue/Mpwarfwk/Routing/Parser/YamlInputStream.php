<?php
namespace Com\Martiadrogue\Parser;

/**
 *
 */
class YamlInputStream
{
    private $file;
    private $offset;

    public function __construct($file)
    {
        $this->file = $file;
        $this->offset = 0;
    }

    public function getInput()
    {
        $input = file_get_contents($this->file);
        $this->checkInput($input);
        $cleanInput = $this->cleanup($input);

        return $cleanInput;
    }

    private function checkInput($input)
    {
        if (!preg_match('//u', $input)) {
            throw new ParseException('The input stream does not appear to be valid UTF-8.');
        }
    }

    /**
     * Cleanups a YAML string to be parsed.
     *
     * @param string $input The input YAML string
     *
     * @return string A cleaned up YAML string
     */
    private function cleanup($input)
    {
        $count = 0;
        $input = str_replace(array("\r\n", "\r"), "\n", $input);
        $input = $this->stripYamlHeader($input, $count);
        $input = $this->removeLeadingComments($input, $count);
        $input = $this->removeEndsOfDocumentMarker($input, $count);

        return $input;
    }

    private function stripYamlHeader($input, $count)
    {
        $input = preg_replace('#^\%YAML[: ][\d\.]+.*\n#u', '', $input, -1, $count);
        $this->offset += $count;

        return $input;
    }

    private function removeLeadingComments($input, $count)
    {
        $trimmedValue = preg_replace('#^(\#.*?\n)+#s', '', $input, -1, $count);
        if ($count == 1) {
            return $this->updateOffset($input, $trimmedValue);
        }

        return $input;
    }

    private function removeEndsOfDocumentMarker($input, $count)
    {
        $trimmedValue = preg_replace('#^\-\-\-.*?\n#s', '', $input, -1, $count);
        if ($count == 1) {
            $input = $this->updateOffset($input, $trimmedValue);

            return preg_replace('#\.\.\.\s*$#s', '', $input);
        }

        return $input;
    }

    private function updateOffset($input, $trimmedValue)
    {
        $this->offset += substr_count($input, "\n") - substr_count($trimmedValue, "\n");

        return $trimmedValue;
    }
}
