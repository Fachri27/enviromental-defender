<?php 
namespace App\Services;

class SeoService {
    protected array $meta = [
        'title' => [
            'id' => 'Environmental Defender',
            'en' => 'Environmental Defender'
        ],
        'description' => [
            'id' => 'Situs ini didedikasikan untuk peningkatan keselamatan Pembela Lingkungan. Memuat database ancaman terhadap Pembela Lingkungan, dan berbagai informasi yang relevan dengan perbaikan keselamatannya.',
            'en' => 'This site, dedicated to ensuring the safety of Environmental Defenders, contains a database of threats to Environmental Defenders, and information relevant to improving their safety.'
        ],
        'image' => '/images/default-og.jpg',
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