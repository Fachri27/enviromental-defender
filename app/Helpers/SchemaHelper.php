<?php
namespace App\Helpers;

class SchemaHelper
{
    public static function article($title, $description, $image, $author)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $title,
            'description' => $description,
            'image' => $image,
            'author' => [
                '@type' => 'Person',
                'name' => $author,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url()->current(),
            ],
        ];
    }

    public static function webpage($title, $description, $image)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'headline' => $title,
            'description' => $description,
            'image' => $image,
            'url' => url()->current(),
        ];
    }
}
