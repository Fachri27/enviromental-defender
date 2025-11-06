<?php 
namespace App\Services;

class SeoService {
    protected array $meta = [
        'title' => [
            'id' => 'Environmental Defender',
            'en' => 'Environmental Defender'
        ],
        'description' => [
            'id' => 'Environmental Defender — platform advokasi lingkungan di Indonesia.',
            'en' => 'Environmental Defender — a platform for environmental advocacy in Indonesia.'
        ],
        'image' => '/image/default-og.jpg',
        'type' => 'website',
    ];

    protected string $locale = 'id';

    public function setLocale(string $locale): static
    {
        $this->locale = in_array($locale, ['id','en']) ? $locale : 'id';
        return $this;
    }

    public function set(string $key, $value)
    {
        $this->meta[$key] = $value;
        return $this;
    }

    public function get(string $key)
    {
        $val = $this->meta[$key] ?? null;
        if(is_array($val)) {
            return $val[$this->locale] ?? reset($val);
        }
        return $val;
    }

    public function all()
    {
        return [
            'title' => $this->get('title'),
            'description' => $this->get('description'),
            'image' => $this->get('image'),
            'type' => $this->get('type'),
            'locale' => $this->locale,
        ];
    }
}