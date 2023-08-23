<?php

namespace Scrimmy\Tjs;

class ScrimmyRenderJsObject
{
    /**
     * A method that allows you to throw out a script with an object containing data
     *
     * @param string $object_name
     * @param array $values
     * @return string
     */
    public function renderJSObject(string $object_name, array $values): string
    {
        if (empty($object_name)) {
            return '';
        }

        $data = [];

        if (!empty($values)) {
            $data = $this->decodeHTML($values);
        }

        $script = sprintf('let %s = %s;', $object_name, $this->encodeData($data));

        return $this->wrapScript($script);
    }

    /**
     * A method that allows you to convert HTML entities in a string to their corresponding characters
     *
     * @param array $values
     * @return array
     */
    private function decodeHTML(array $values): array
    {
        $script = [];

        foreach ($values as $key => $value) {
            if (!is_scalar($value))
                continue;

            $script[$key] = html_entity_decode((string) $value, ENT_QUOTES, 'UTF-8');
        }

        return $script;
    }

    /**
     * A method that allows you to encrypt data in JSON, or return an empty string for security
     *
     * @param array $data
     * @return string
     */
    private function encodeData(array $data): string
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
        return sprintf(/** @lang text */ '<script>/* <![CDATA[ */ %s /* ]]> */</script>', $script);
    }
}