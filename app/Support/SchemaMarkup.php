<?php

namespace App\Support;

class SchemaMarkup
{
    public static function script(array $schema): string
    {
        return self::scripts([$schema]);
    }

    public static function scripts(array $schemas): string
    {
        $html = '';

        foreach ($schemas as $schema) {
            if (empty($schema)) {
                continue;
            }

            $json = json_encode(
                $schema,
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
            );

            $html .= '<script type="application/ld+json">'.$json.'</script>'."\n";
        }

        return trim($html);
    }
}
