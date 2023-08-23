<?php

namespace Scrimmy\Tjs;

class STJS_Script
{
    /**
     * A method that allows you to throw out a script with an object containing data
     *
     * @param string $object_name
     * @param array $values
     * @return string
     */
    public function toJSObject(string $object_name, array $values): string
    {
        if ( empty($object_name) ) {
            return "";
        }

        $data = array();

        if ( !empty($values) ) {
            $data = $this->decodeHTML($values);
        }

        $script = sprintf("let %s = %s;", $object_name, $this->encodeData($data));

        return $this->wrapScript($script);
    }

    /**
     * A method that allows you to convert HTML entities in a string to their corresponding characters
     *
     * @param array $values
     * @return array|string
     */
    private function decodeHTML(array $values): array|string
    {
        $script = array();

        foreach ( $values as $key => $value ) {
            if ( !is_scalar($value) )
                continue;

            $script[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8');
        }

        return !empty($script) ? $script : '';
    }

    /**
     * A method that allows you to encrypt data in JSON, or return an empty string for security
     *
     * @param string|array $data
     * @return bool|string
     */
    private function encodeData(string|array $data): bool|string
    {
        $json = json_encode($data);

        return $json ?: '';
    }

    /**
     * A method that allows you to wrap an object in HTML markup
     *
     * @param string $script
     * @return string
     */
    private function wrapScript(string $script): string
    {
        $before = "<script>\n/* <![CDATA[ */\n";
        $after = "\n/* ]]> */\n</script>";

        return $before . "\t" . $script . $after;
    }
}